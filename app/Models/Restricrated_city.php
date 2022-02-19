<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restricrated_city extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $primaryKey = 'city_id';
}
