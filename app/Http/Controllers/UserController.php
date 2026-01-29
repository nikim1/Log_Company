<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function deleteUser($user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'Потребителят е изтрит успешно.');
        }

        return redirect()->back()->with('error', 'Потребителят не е намерен.');
    }
}
