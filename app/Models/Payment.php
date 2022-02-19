<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $primaryKey = 'payment_id';
    protected $fillable = [
        'user_id',
        'order_id',
        'payment_amount',
        'payment_status',
        'payment_bank',
        'payment_branch',
        'payment_card_no',
        'payment_method_name',
    ];
}
