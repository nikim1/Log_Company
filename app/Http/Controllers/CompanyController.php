<?php

namespace App\Http\Controllers;

use App\Models\LogisticCompany;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function deleteCompany($id)
    {
        $company = LogisticCompany::find($id);
        if ($company) {
            $company->delete();
            return back()->with('success', 'Компанията е изтрита успешно!');
        } else {
            return back()->with('error', 'Не съществува такава компания!');
        }
    }

    public function saveCompany(Request $request, $company_id = null)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:companies,name',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:companies,email',
            'phone' => 'required|string|size:10|unique:companies,phone',
        ]);

        // check for already existing company with the same city and address
        $existingCompany = LogisticCompany::where('city', $validated['city'])
            ->where('address', $validated['address'])
            ->first();

        if ($existingCompany && $existingCompany->id != $company_id) {
            return redirect()->back()->with('error', 'Вече съществува компания с този град и адрес.');
        }

        LogisticCompany::updateOrCreate(
            ['id' => $company_id],
            [
                'name' => $validated['name'],
                'city' => 'required|string|max:255',
                'address' => $validated['address'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
            ]
        );

        $message = $company_id ? 'Комапнията е променена успешно.' : 'Компанията е записана успешно.';
        return redirect()->back()->with('success', $message);
    }
}
