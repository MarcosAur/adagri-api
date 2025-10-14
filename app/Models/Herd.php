<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Herd extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'species',
        'quantity',
        'purpose',
        'last_update_date',
        'rural_property_id',
    ];

    protected $casts = [
        'last_update_date' => 'datetime',
    ];

    public function ruralProperty()
    {
        return $this->belongsTo(RuralProperty::class);
    }

}
