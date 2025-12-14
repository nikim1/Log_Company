<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Company;
use App\Models\Office;
use App\Models\Client;
use App\Models\Employee;

use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    const BASE_PRICE_PER_KG = 2.00;
    const OFFICE_DELIVERY_FEE = 1.50;
    const ADDRESS_DELIVERY_FEE = 3.50;
    const MINIMUM_PRICE = 5.00;

    public function updateCompany(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:50',
            'address' => 'required|string|max:50',
            'phone'   => 'required|string|max:12',
            'email'   => 'required|email|max:50',
            'website' => 'nullable|string|max:50',
        ]);

        return Company::updateOrCreate(
            ['id' => $request->companyId],
            [
                'name'    => $request->name,
                'address' => $request->address,
                'phone'   => $request->phone,
                'email'   => $request->email,
                'website' => $request->website
            ]
        );
    }

    public function deleteCompany(Request $request)
    {
        Company::findOrFail($request->companyId)->delete();
    }

    public function updateOffice(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name'       => 'required|string|max:50',
            'city'       => 'required|string|max:50',
            'address'    => 'required|string|max:50',
            'phone'      => 'required|string|max:12',
        ]);

        return Office::updateOrCreate(
            ['id' => $request->officeId],
            [
                'company_id' => $request->company_id,
                'name'       => $request->name,
                'city'       => $request->city,
                'address'    => $request->address,
                'phone'      => $request->phone,
            ]
        );
    }

    public function deleteOffice(Request $request)
    {
        Office::findOrFail($request->officeId)->delete();
    }

    public function updateClient(Request $request)
    {
        $request->validate([
            'user_id'      => 'required|exists:user,id',
            'company_id'   => 'required|exists:companies,id',
            'phone'        => 'required|string|max:50',
            'address'      => 'required|string|max:100',
        ]);

        return Client::updateOrCreate(
            ['id' => $request->clientId],
            [
                'user_id'      => $request->user_id,
                'company_id'   => $request->company_id,
                'phone'        => $request->phone,
                'address'      => $request->address,
            ]
        );
    }

    public function deleteClient(Request $request)
    {
        Client::findOrFail($request->clientId)->delete();
    }

    public function updateEmployee(Request $request)
    {
        $request->validate([
            'office_id'  => 'required|exists:offices,id',
            'user_id'    => 'required|exists:users,id',
            'position'   => 'required|in:office,courier',
        ]);

        return Employee::updateOrCreate(
            ['id' => $request->employeeId],
            [
                'office_id'  => $request->office_id,
                'user_id'    => $request->user_id,
                'position'   => $request->position,
            ]
        );
    }

    public function deleteEmployee(Request $request)
    {
        Employee::findOrFail($request->employeeId)->delete();
    }

    public function updateShipment(Request $request)
    {
        $request->validate([
            'sender_id'             => 'required|exists:clients,id',
            'receiver_id'           => 'required|exists:clients,id',
            'origin_office_id'      => 'required|exists:offices,id',
            'destination_office_id' => 'nullable|exists:offices,id',
            'delivery_address'      => 'nullable|string|max:50',
            'weight_kg'             => 'required|numeric|min:0.1',
            'status'                => 'required|in:registered,in transit, delivered',
            'registered_by'         => 'required|exists:employees,id',
            'courier_by'            => 'required|exists:employees,id',
        ]);

        $devType = $request->delivery_address ? 'ADDRESS' : 'OFFICE';
        return Shipment::updateOrCreate(
            ['id' => $request->shipmentId],
            [
                'sender_id'             => $request->sender_id,
                'receiver_id'           => $request->receiver_id,
                'origin_office_id'      => $request->origin_office_id,
                'destination_office_id' => $request->destination_office_id,
                'delivery_address'      => $request->delivery_address,
                'weight_kg'             => $request->weight_kg,
                'price'                 => $this->calculatePrice($request->weight_kg, $devType),
                'status'                => $request->status,
                'registered_by'         => $request->registered_by,
                'courier_id'            => $request->courier_id
            ]
        );
    }

    public function deleteShipment(Request $request)
    {
        Shipment::findOrFail($request->shipmentId)->delete();
    }

    public function markAsDelivered(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'shipment_id' => 'required|exists:shipments,id',
        ]);

        $shipment = Shipment::findOrFail($request->shipment_id);
        $shipment->status = 'delivered';
        $shipment->courier_id = $request->employee_id;
        $shipment->save();
    }

    private function calculatePrice($weight, $deliveryType) {
        $price = $weight * self::BASE_PRICE_PER_KG;

        if ($deliveryType === 'OFFICE') {
            $price += self::OFFICE_DELIVERY_FEE;
        } elseif ($deliveryType === 'ADDRESS') {
            $price += self::ADDRESS_DELIVERY_FEE;
        }

        return max($price, self::MINIMUM_PRICE);
    }
}
