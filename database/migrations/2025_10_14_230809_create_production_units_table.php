<?php

use App\Models\RuralProperty;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('total_area_ha');
            $table->string('latitude');
            $table->string('longitude');
            $table->foreignIdFor(RuralProperty::class);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_units');
    }
};
