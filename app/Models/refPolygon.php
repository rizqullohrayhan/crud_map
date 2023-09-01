<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class refPolygon extends Model
{
    use HasFactory;
    protected $table = 'ref_polygons';
    protected $primaryKey = 'id';
    protected $fillable = ['keterangan'];

    /**
     * Get koordinat dari koordinatPolygon.
     */
    public function koordinatPolygon()
    {
        return $this->hasMany(KoordinatPolygon::class, 'refPolygon_id', 'id');
    }
}
