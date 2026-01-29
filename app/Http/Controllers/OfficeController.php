<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function deleteOffice($id)
    {
        $office = Office::find($id);
        if ($office) {
            $office->delete();
            return back()->with('success', 'Офисът е изтрит успешно!');
        } else {
            return back()->with('error', 'Не съществува такав офис!');
        }
    }

    public function saveOffice(Request $request, $office_id = null)
    {
        $validated =  $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:10|unique:offices,phone',
        ]);

        // check for already existing office with the same city and address
        $existingOffice = Office::where('city', $validated['city'])
            ->where('address', $validated['address'])
            ->first();

        if ($existingOffice && $existingOffice->id != $office_id) {
            return redirect()->back()->with('error', 'Вече съществува офис с този град и адрес.');
        }

        Office::updateOrCreate(
            ['id' => $office_id],
            [
                'company_id' => $validated['company_id'],
                'name' => $validated['name'],
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'city' => $validated['city'],
            ]
        );

        $message = $office_id ? 'Офисът е променен успешно.' : 'Офисът е записан успешно.';
        return redirect()->back()->with('success', $message);
    }
}
