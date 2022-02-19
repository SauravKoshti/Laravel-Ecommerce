<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gst extends Model
{
    use HasFactory;  
    public $timestamps = true;
    protected $primaryKey = 'gst_id'; 
}
