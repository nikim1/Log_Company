<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public $statuses = [
        'in_transit' => 'На път',
        'pending' => 'Очакваща обработка',
        'delivered' => 'Доставена',
        'at_office' => 'В офис',
    ];

    public function index(Request $request)
    {
        $user = auth()->user();

        if (!$user->hasRole(['office', 'courier'])) {
            return redirect()->route('dashboard')->with('error', 'Нямате достъп до справки.');
        }

        $company_id = $user->employee->company_id;

        // a. Всички служители в компанията
        $employees = Employee::where('company_id', $company_id)->with('user')->get();

        // b. Всички клиенти на компанията
        $clients = Client::where('company_id', $company_id)->with('user')->get();

        // c. Всички пратки, които са били регистрирани
        $allShipments = Shipment::whereHas('registeredBy', function ($q) use ($company_id) {
            $q->where('company_id', $company_id);
        })->with(['sender', 'receiver', 'sendShipment', 'receiveShipment'])->get();

        // d. Всички пратки, регистрирани от даден служител
        $shipmentsByEmployee = [];
        if ($request->employee_id) {
            $shipmentsByEmployee = Shipment::where('registered_by', $request->employee_id)
                ->with(['sender', 'receiver', 'sendShipment', 'receiveShipment'])
                ->get();
        }

        // e. Всички пратки, изпратени, но не доставени
        $pendingDeliveries = Shipment::where('status', '!=', 'delivered')
            ->whereHas('registeredBy', function ($q) use ($company_id) {
                $q->where('company_id', $company_id);
            })
            ->with(['sender', 'receiver', 'sendShipment', 'receiveShipment'])
            ->get();

        // f. Всички пратки, изпратени от даден клиент
        $shipmentsBySender = [];
        if ($request->client_id) {
            $shipmentsBySender = Shipment::where('sender_id', $request->client_id)
                ->with(['sender', 'receiver', 'sendShipment', 'receiveShipment'])
                ->get();
        }

        // g. Всички пратки, получени от даден клиент
        $shipmentsByReceiver = [];
        if ($request->client_id) {
            $shipmentsByReceiver = Shipment::where('receiver_id', $request->client_id)
                ->with(['sender', 'receiver', 'sendShipment', 'receiveShipment'])
                ->get();
        }

        // h. Всички приходи на фирмата за определен период
        $revenue = 0;
        if ($request->start_date && $request->end_date) {
            $revenue = Shipment::whereHas('registeredBy', function ($q) use ($company_id) {
                $q->where('company_id', $company_id);
            })
                ->whereBetween('created_at', [$request->start_date, $request->end_date])
                ->sum('price');
        }

        return view('reports', compact(
            'employees',
            'clients',
            'allShipments',
            'shipmentsByEmployee',
            'pendingDeliveries',
            'shipmentsBySender',
            'shipmentsByReceiver',
            'revenue'
        ) + ['statuses' => $this->statuses])
            ->with('request', $request);
    }
}
