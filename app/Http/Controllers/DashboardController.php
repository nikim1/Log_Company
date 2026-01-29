<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientAddress;
use App\Models\Employee;
use App\Models\LogisticCompany;
use App\Models\Office;
use App\Models\User;
use App\Models\Shipment;

class DashboardController extends Controller
{
    public $statuses = [
        'in_transit' => 'На път',
        'pending' => 'Очакваща обработка',
        'delivered' => 'Доставена',
        'at_office' => 'В офис',
    ];

    public function index()
    {
        $user = auth()->user();

        // Admin Dashboard
        if ($user->hasRole('admin')) {
            return view('dashboard', [
                'companies' => LogisticCompany::all(),
                'offices' => Office::with('company')->get(),
                'users' => User::with('role')->where('id', '!=', $user->id)->orderBy('role_id')->orderBy('created_at', 'desc')->get(),
                'shipments' => Shipment::with(['registeredBy.user', 'sendShipment.office', 'sendShipment.address', 'receiveShipment.office', 'receiveShipment.address', 'receiveShipment.courier.user'])->latest()->get(),
                'statuses' => $this->statuses,
            ]);
        }

        // Client Dashboard
        if ($user->hasRole('client')) {
            $client = $user->client;

            $sentShipments = Shipment::where('sender_id', $client->id)
                ->with(['receiveShipment', 'sendShipment'])
                ->latest()
                ->get();

            $receivedShipments = Shipment::where('receiver_id', $client->id)->where('status', 'delivered')
                ->with(['receiveShipment', 'receiveShipment',  'sendShipment', 'sendShipment'])
                ->latest()
                ->get();

            $clients = Client::where('user_id', '!=', auth()->id())->get();
            $offices = Office::where('company_id', $client->company_id)->get();
            $addresses = ClientAddress::where('client_id', $client->id)->get();

            return view('dashboard', compact('sentShipments', 'receivedShipments', 'clients', 'offices', 'addresses') +
                ['statuses' => $this->statuses]);
        }

        $employee = $user->employee;
        // Office Worker Dashboard
        if ($user->hasRole('office')) {
            $pendingShipments = Shipment::where('status', '!=', 'delivered')
                ->where(function ($q) use ($employee) {
                    $q->whereHas('sender', fn($q) => $q->where('company_id', $employee->company_id));
                })
                ->with(['sendShipment', 'receiveShipment'])
                ->latest()
                ->get();

            $deliveredShipments = Shipment::where('status', 'delivered')
                ->where(function ($q) use ($employee) {
                    $q->whereHas('sender', fn($q) => $q->where('company_id', $employee->company_id));
                })
                ->with(['sendShipment', 'receiveShipment'])
                ->latest()
                ->get();

            $couriers = Employee::where('position', 'courier')->where('company_id', $employee->company_id)->get();

            return view('dashboard', compact('pendingShipments', 'deliveredShipments', 'couriers'));
        }

        // Courier
        if ($user->hasRole('courier')) {
            $assignedShipments = Shipment::whereHas('receiveShipment', function ($query) use ($employee) {
                $query->where('courier_id', $employee->id);
            })
                ->where('status', '!=', 'delivered')
                ->latest()
                ->get();

            $deliveredShipments = Shipment::whereHas('receiveShipment', function ($query) use ($employee) {
                $query->where('courier_id', $employee->id);
            })
                ->where('status', 'delivered')
                ->whereNotNull('delivered_at')
                ->latest()
                ->get();

            return view('dashboard', compact('assignedShipments', 'deliveredShipments'));
        }

        return view('dashboard');
    }
}
