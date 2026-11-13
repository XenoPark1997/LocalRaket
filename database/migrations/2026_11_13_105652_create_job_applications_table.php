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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_posting_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('employee_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->text('cover_letter')->nullable();
            $table->string('resume_path')->nullable();
            $table->enum('status', [
                'pending',
                'reviewing',
                'shortlisted',
                'rejected',
                'hired',
                'withdrawn',
            ])->default('pending');
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamps();

            $table->unique(['job_posting_id', 'employee_id']);
            $table->index(['employee_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
