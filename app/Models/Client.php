<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'company_id', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function company()
    {
        return $this->belongsTo(LogisticCompany::class, 'company_id', 'id');
    }

    public function sentShipments()
    {
        return $this->hasMany(Shipment::class, 'sender_id', 'id');
    }

    public function receivedShipments()
    {
        return $this->hasMany(Shipment::class, 'receiver_id', 'id');
    }

    public function addresses()
    {
        return $this->hasMany(ClientAddress::class, 'client_id', 'id');
    }
}
