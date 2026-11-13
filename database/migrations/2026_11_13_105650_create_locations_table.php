<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('name', 120);
            $table->string('address_line')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state_or_province', 100)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->char('country_code', 2)->default('PH');
            $table->geometry('coordinates', 'point', 4326);
            $table->timestamps();

            if (Schema::getConnection()->getDriverName() === 'mysql') {
                $table->spatialIndex('coordinates');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
