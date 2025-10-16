<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producer extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "name",
        "document",
        "phone",
        "email",
        "register_date"
    ];

    protected $casts = [
        'register_date' => 'datetime',
    ];

    public function address(): MorphOne{
        return $this->morphOne(Address::class, 'addressable');
    }

    public function ruralProperty(): HasMany{
        return $this->hasMany(RuralProperty::class,'');
    }
}