<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientAddress;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    function index()
    {
        $client = Client::where('user_id', auth()->user()->id)->first();
        $clientAddresses = $client ? $client->addresses : collect();

        return view('profile', compact('clientAddresses'));
    }

    function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Текущата парола е грешна']);
        }

        $user->password = Hash::make($validated['password']);
        $user->save();

        return back()->with('success', 'Паролата е променена успешно!');
    }

    function changeImage(Request $request)
    {
        $validated = $request->validate([
            'profile_image' => 'required|image|max:2048',
        ]);

        $image = $validated['profile_image'];

        $user = auth()->user();

        $emailPrefix = strstr($user->email, '@', true);
        $extension = $image->getClientOriginalExtension();
        $filename = $emailPrefix . '_' . $user->id . '.' . $extension;
        $path = $image->storeAs('profile_images', $filename, 'public');

        $user->profile_image = $path;
        $user->save();

        return back()->with('success', 'Снимката е обновена успешно!');
    }

    function editProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update($validated);

        return back()->with('success', 'Профилът е обновен успешно.');
    }

    function deleteProfile()
    {
        $user = auth()->user();
        auth()->logout();
        $user->delete();

        return redirect('/')->with('status', 'Акаунтът е изтрит успешно.');
    }

    function saveClientAddress(Request $request, $address_id = null)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        $exists = ClientAddress::where('client_id', $user->id)
            ->where('city', $validated['city'])
            ->where('address', $validated['address'])
            ->first();

        if ($exists) {
            return back()->with('error', 'Този адрес вече е добавен.');
        }

        ClientAddress::updateOrCreate(
            ['id' => $address_id],
            [
                'address' => $validated['address'],
                'city' => $validated['city'],
                'client_id' => $user->client->id,
            ]
        );

        $message = $address_id ? 'Адресът е променен успешно.' : 'Адресът е записан успешно.';

        return redirect()->back()->with('success', $message);
    }

    function deleteClientAddress($address_id)
    {
        $address = ClientAddress::find($address_id);
        if ($address) {
            $address->delete();
            return redirect()->back()->with('success', 'Адресът е премахнат успешно');
        }

        return redirect()->back()->with('error', 'Адресът не е намерен');
    }
}
