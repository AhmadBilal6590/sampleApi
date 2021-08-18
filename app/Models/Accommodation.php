<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $table='accommodations';

    protected $fillable=array('res_id','guests','bedrooms','beds','baths');

}
