<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\Shipping;
use App\Models\TransactionDetail;
use App\Models\Province;
use App\Models\City;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'customer_id',
        'shipping_id',
        'province_id',
        'city_id',
        'invoice',
        'weight',
        'address',
        'total',
        'status',
        'snap_token',
    ];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);    
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function province() 
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
