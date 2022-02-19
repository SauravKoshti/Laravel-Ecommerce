<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $primaryKey = ['order_id'];
    protected $fillable = [
        'order_user_id',
        'order_product_id',
        'order_product_qty',
        'order_amount',
        'order_city',
        'order_state',
        'order_pin',
        'order_country',
        'order_status',
    ];
}
