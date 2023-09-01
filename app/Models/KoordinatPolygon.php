<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoordinatPolygon extends Model
{
    use HasFactory;
    protected $table = 'koord_polygons';
    protected $primaryKey = 'id';
    protected $fillable = ['refPolygon_id', 'latitude', 'longitude'];

    /**
     * Get keterangan dari refPolygon.
     */
    public function refPolygon()
    {
        return $this->belongsTo(refPolygon::class, 'refPolygon_id', 'id');
    }
}
