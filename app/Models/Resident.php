<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $table='residents';
    protected $connection = 'mysql';

    protected $fillable=array('title','superHost','residentType','location','samplePhotoUrl','rating','personReviewed');

}
