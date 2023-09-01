<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titik extends Model
{
    use HasFactory;
    protected $table = "koordinats";
    protected $primaryKey = "id";
    protected $fillable = ['keterangan',
                            'latitude',
                            'longitude',];
}
