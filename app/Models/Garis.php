<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garis extends Model
{
    use HasFactory;
    protected $table = "garis";
    protected $primaryKey = "id";
    protected $fillable = ['keterangan',
                            'lat_awal',
                            'long_awal',
                            'lat_akhir',
                            'long_akhir',
                        ];
}
