<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable =[

        'customer_id',
        'total',
        'shipped',
        'user_id' // Adding New Column - php artisan make:migration add_user_id_to_orders


    ];

    public function customer()
    {

        return $this->belongsTo(Customer::class);

    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);

    }

    public function payments()
    {
        return $this->hasMany(Payment::class);

    }



}
