<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Client extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'address',
        'phone',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
