<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table="bookings";
    protected $connection = 'mysql';

    protected $fillable=array('user_email','room_id','no_days','time');


}
