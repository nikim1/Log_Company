<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Shipment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'delivery_address',
        'weight',
        'price',
        'status',
    ];

    public function sender()
    {
        return $this->belongsTo(Client::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Client::class, 'receiver_id');
    }

    public function origin_ofice()
    {
        return $this->belongsTo(Office::class, 'origin_office_id');
    }

    public function receiver_ofice()
    {
        return $this->belongsTo(Office::class, 'destination_office_id');
    }

    public function courier()
    {
        return $this->belongsTo(Employee::class, 'courier_id');
    }

    public function registered_by()
    {
        return $this->belongsTo(Employee::class, 'registered_by');
    }

}
