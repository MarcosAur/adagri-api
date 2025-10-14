<?php

use App\Models\Producer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('rural_properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('state_registration');
            $table->double('total_area');
            $table->foreignIdFor(Producer::class);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rural_properties');
    }
};
