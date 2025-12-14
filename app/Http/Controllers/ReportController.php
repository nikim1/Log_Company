<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Employee;
use App\Models\Office;
use App\Models\Client;
use Illuminate\Http\Request;

class ReportController extends Controller
{
     public function getEmployeesByCompany($companyId)
    {
        $employees = Employee::whereHas('office', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->get();

        return $employees;
    }
    
    public function allClientsByCompany($companyId)
    {
        return Client::where('company_id', $companyId)->get();
    }

public function registeredShipmentsByCompany($companyId)
{
    $officeIds = Office::where('company_id', $companyId)
        ->pluck('id');

    return Shipment::where('status', 'registered')
        ->whereIn('origin_office_id', $officeIds)
        ->get();
}

public function shipmentsRegisteredByEmployeeInCompany($employeeId, $companyId)
{
    $officeIds = Office::where('company_id', $companyId)->pluck('id');

    return Shipment::where('status', 'registered')
        ->where('registered_by', $employeeId)
        ->whereIn('origin_office_id', $officeIds)
        ->get();
}

public function shipmentsInTransitByCompany($companyId)
{
    $officeIds = Office::where('company_id', $companyId)
        ->pluck('id');

    return Shipment::where('status', 'in transit')
        ->whereIn('origin_office_id', $officeIds)
        ->get();
}

public function shipmentsBySenderInCompany($clientId, $companyId)
{
    $officeIds = Office::where('company_id', $companyId)->pluck('id');

    return Shipment::where('sender_id', $clientId)
        ->whereIn('origin_office_id', $officeIds)
        ->get();
}

public function deliveredShipmentsByReceiverInCompany($clientId, $companyId)
{
    $officeIds = Office::where('company_id', $companyId)->pluck('id');

    return Shipment::where('status', 'delivered')
        ->where('receiver_id', $clientId)
        ->whereIn('origin_office_id', $officeIds)
        ->get();
}
    
    public function getRevenueForPeriod(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-d'));
        $endDate = $request->input('end_date', date('Y-m-d'));
        
        $revenueData = Shipment::where('created_at', '>=', $startDate)
            ->where('created_at','<=', $endDate)
            ->where('status', 'delivered')
            ->selectRaw('DATE(created_at) as date, SUM(price) as total_revenue')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        $total = $revenueData->sum('total_revenue');
        
        return $total;
    }
}
