<?php

namespace App\Providers;

use App\Models\Producer;
use App\Models\RuralProperty;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }


    public function boot(): void
    {
        Relation::morphMap([
            'producer' => Producer::class,
            'rural_property' => RuralProperty::class,
        ]);
    }
}
