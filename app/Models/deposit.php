<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class deposit extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'username',
        'payment_ref',
        'amount',
        'iwallet',
        'fwallet',
        'date',
        'created_at',
    ];
//    function parentData()
//    {
//        return $this->belongsTo(bill_payment::class, 'username','username');
//    }
//    function parentData1()
//    {
//        return $this->belongsTo(safe_lock::class, 'username','username');
//    }

}
