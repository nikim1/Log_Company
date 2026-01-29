<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'verify' => false,
    'confirm' => false,
    'forgot' => false,
    'reset' => false,
]);

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('/prices', function () {
    return view('prices');
})->name('prices');

Route::middleware('auth')->group(function () {
    // Report routes
    Route::get('/reports', 'App\Http\Controllers\ReportController@index')->name('reports');

    // Profile routes
    Route::get('/profile', 'App\Http\Controllers\Auth\ProfileController@index')->name('profile');

    Route::post('/change-password', 'App\Http\Controllers\Auth\ProfileController@changePassword')->name('change-password');
    Route::post('/profile-image-update', 'App\Http\Controllers\Auth\ProfileController@changeImage')->name('profile-image-update');
    Route::post('/edit-profile', 'App\Http\Controllers\Auth\ProfileController@editProfile')->name('edit-profile');
    Route::post('/delete-profile', 'App\Http\Controllers\Auth\ProfileController@deleteProfile')->name('delete-profile');
    Route::post('/save-address/{address_id?}', 'App\Http\Controllers\Auth\ProfileController@saveClientAddress')->name('save-address');
    Route::post('/delete-address/{address_id}', 'App\Http\Controllers\Auth\ProfileController@deleteClientAddress')->name('delete-address');

    // Dashboard
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

    // Company
    Route::post('/delete-company/{company_id}', 'App\Http\Controllers\CompanyController@deleteCompany')->name('delete-company');
    Route::post('/save-company/{company_id?}', 'App\Http\Controllers\CompanyController@saveCompany')->name('save-company');

    // Office
    Route::post('/delete-office/{office_id}', 'App\Http\Controllers\OfficeController@deleteOffice')->name('delete-office');
    Route::post('/save-office/{office_id?}', 'App\Http\Controllers\OfficeController@saveOffice')->name('save-office');

    // Shipment
    Route::post('/delete-shipment/{shipment_id}', 'App\Http\Controllers\ShipmentController@deleteShipment')->name('delete-shipment');
    Route::post('/save-shipment/{shipment_id?}', 'App\Http\Controllers\ShipmentController@saveShipment')->name('save-shipment');
    Route::post('/assign-courier/{shipment_id}', 'App\Http\Controllers\ShipmentController@assignCourier')->name('assign-courier');
    Route::post('/deliver-shipment/{shipment_id}', 'App\Http\Controllers\ShipmentController@deliverShipment')->name('deliver-shipment');
    Route::post('/shipment-accepted/{shipment_id}', 'App\Http\Controllers\ShipmentController@shipmentAccepted')->name('shipment-accepted');

    // User
    Route::post('/delete-user/{user_id}', 'App\Http\Controllers\UserController@deleteUser')->name('delete-user');
});
