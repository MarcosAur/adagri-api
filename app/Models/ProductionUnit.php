<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionUnit extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'total_area_ha',
        'latitude',
        'longitude',
        'rural_property_id',
    ];

    public function ruralProperty(): BelongsTo{
        return $this->belongsTo(RuralProperty::class);
    }
}
