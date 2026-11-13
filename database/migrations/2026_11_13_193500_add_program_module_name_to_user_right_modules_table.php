<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_right_modules', function (Blueprint $table) {
            $table->string('program_module_name')->nullable()->after('program_module_id');
        });

        DB::table('program_modules')
            ->select(['id', 'name'])
            ->get()
            ->each(function (object $module): void {
                DB::table('user_right_modules')
                    ->where('program_module_id', $module->id)
                    ->update(['program_module_name' => $module->name]);
            });
    }

    public function down(): void
    {
        Schema::table('user_right_modules', function (Blueprint $table) {
            $table->dropColumn('program_module_name');
        });
    }
};
