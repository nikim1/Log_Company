<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'city', 'address', 'company_id', 'phone'];

    public function company()
    {
        return $this->belongsTo(LogisticCompany::class, 'company_id', 'id');
    }
}
