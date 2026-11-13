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
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_area_id')
                ->nullable()
                ->constrained('areas')
                ->nullOnDelete();
            $table->string('name', 120);
            $table->string('code', 50)->nullable()->unique();
            $table->text('description')->nullable();
            $table->geometry('boundary', 'multipolygon', 4326);
            $table->timestamps();

            if (Schema::getConnection()->getDriverName() === 'mysql') {
                $table->spatialIndex('boundary');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};
