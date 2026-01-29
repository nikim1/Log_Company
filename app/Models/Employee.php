<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['position', 'user_id', 'office_id', 'company_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(LogisticCompany::class, 'company_id', 'id');
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class, 'registered_by', 'id');
    }
}
