<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'weight',
        'price',
        'status',
        'delivered_at',
        'registered_by',
    ];

    public function sender()
    {
        return $this->belongsTo(Client::class, 'sender_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(Client::class, 'receiver_id', 'id');
    }

    public function sendShipment()
    {
        return $this->hasOne(ShipmentSender::class, 'shipment_id', 'id');
    }

    public function receiveShipment()
    {
        return $this->hasOne(ShipmentReceiver::class, 'shipment_id', 'id');
    }

    public function registeredBy()
    {
        return $this->belongsTo(Employee::class, 'registered_by', 'id');
    }
}
