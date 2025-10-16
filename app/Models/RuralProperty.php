<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RuralProperty extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'state_registration',
        'total_area',
        'producer_id',
    ];

    public function address(): MorphOne{
        return $this->morphOne(Address::class, 'addressable');
    }

    public function producer(): BelongsTo{
        return $this->belongsTo(Producer::class);
    }

    public function herds(): HasMany{
        return $this->hasMany(Herd::class);
    }

    public function productionUnits(): HasMany{
        return $this->hasMany(ProductionUnit::class);
    }
}
