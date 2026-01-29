<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\ShipmentReceiver;
use App\Models\ShipmentSender;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShipmentController extends Controller
{
    const BASE_PRICE_PER_KG = 2.00;
    const OFFICE_DELIVERY_FEE = 1.50;
    const ADDRESS_DELIVERY_FEE = 3.50;
    const MINIMUM_PRICE = 5.00;

    public function deleteShipment($shipment_id)
    {
        $shipment = Shipment::find($shipment_id);
        if ($shipment) {
            $shipment->delete();
            return back()->with('success', 'Пратката е изтрита успешно!');
        } else {
            return back()->with('error', 'Не съществува такава пратка!');
        }
    }

    public function saveShipment(Request $request, $shipment_id = null)
    {
        $validated =  $request->validate([
            'receiver_id' => 'required|exists:users,id',

            'send_type' => 'required|in:office,address',
            'send_office_id' => ['nullable', 'required_if:send_type,office', 'exists:offices,id', Rule::notIn([$request->delivery_office_id])],
            'send_address' => ['nullable', 'required_if:send_type,address', 'exists:client_addresses,id', Rule::notIn([$request->delivery_address])],
            'delivery_type' => 'required|in:office,address',
            'delivery_office_id' => ['nullable', 'required_if:delivery_type,office', 'exists:offices,id', Rule::notIn([$request->send_office_id])],
            'delivery_address' => ['nullable', 'required_if:delivery_type,address', 'exists:client_addresses,id', Rule::notIn([$request->send_address])],

            'weight' => 'required|numeric|min:0.1',
        ]);

        $price = $this->calculatePrice($validated['weight'], $validated['delivery_type']);

        $shipment = Shipment::updateOrCreate(
            ['id' => $shipment_id],
            [
                'sender_id' => auth()->user()->client->id,
                'receiver_id' => $validated['receiver_id'],
                'weight' => $validated['weight'],
                'price' => $price,
                'status' => $validated['send_address'] ? 'pending' : 'at_office',
            ]
        );

        ShipmentSender::updateOrCreate(
            ['shipment_id' => $shipment->id],
            [
                'sender_type' => $validated['send_type'],
                'office_id' => $validated['send_office_id'],
                'address_id' => $validated['send_address'],
            ]
        );

        ShipmentReceiver::updateOrCreate(
            ['shipment_id' => $shipment->id],
            [
                'delivery_type' => $validated['delivery_type'],
                'office_id' => $validated['delivery_office_id'],
                'address_id' => $validated['delivery_address'],
            ]
        );

        $message = $shipment_id ? 'Пратката е променена успешно.' : 'Пратката е записана успешно.';
        return redirect()->back()->with('success', $message);
    }

    public function deliverShipment($shipment_id)
    {
        $shipment = Shipment::find($shipment_id);

        if (!$shipment) {
            return redirect()->back()->with('error', 'Такава пратка не съществува.');
        }

        $shipment->update([
            'status' => 'delivered',
            'delivered_at' => now(),
        ]);

        $position = auth()->user()->employee->position;
        if ($position == 'office') {
            $shipment->update([
                'registered_by' => auth()->user()->employee->id,
            ]);
        } else {
        }


        return redirect()->back()->with('success', 'Пратката е доставена успешно.');
    }

    public function shipmentAccepted($shipment_id)
    {
        $shipment = Shipment::find($shipment_id);

        if (!$shipment) {
            return redirect()->back()->with('error', 'Такава пратка не съществува.');
        }

        $shipment->update([
            'status' => 'in_transit',
        ]);

        return redirect()->back()->with('success', 'Пратката е на път.');
    }

    public function assignCourier(Request $request, $shipment_id)
    {
        $validated = $request->validate([
            'courier_id' => ['nullable', 'integer', 'exists:employees,id'],
        ]);

        $shipment = Shipment::find($shipment_id);
        if (!$shipment) {
            return redirect()->back()->with('error', 'Тази пратка не съществува.');
        }

        $receiveShipment = ShipmentReceiver::where('shipment_id', $shipment_id)->first();
        if ($receiveShipment->address && empty($validated['courier_id'])) {
            return redirect()->back()->with('error', 'Трябва да въведете куриер за доставка.');
        }

        $receiveShipment->update([
            'courier_id' => $validated['courier_id'],
        ]);

        $shipment->update([
            'registered_by' => auth()->user()->employee->id,
        ]);

        return back()->with('success', 'Куриерът е назначен успешно.');
    }

    private function calculatePrice($weight, $deliveryType)
    {
        $price = $weight * self::BASE_PRICE_PER_KG;

        if ($deliveryType == 'office') {
            $price += self::OFFICE_DELIVERY_FEE;
        } elseif ($deliveryType == 'address') {
            $price += self::ADDRESS_DELIVERY_FEE;
        }

        return max($price, self::MINIMUM_PRICE);
    }
}
