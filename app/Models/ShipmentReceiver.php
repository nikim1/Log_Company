<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentReceiver extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'shipment_id',
        'delivery_type',
        'office_id',
        'address_id',
        'courier_id'
    ];

    public function address()
    {
        return $this->belongsTo(ClientAddress::class, 'address_id', 'id');
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id', 'id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function courier()
    {
        return $this->belongsTo(Employee::class, 'courier_id', 'id');
    }
}
