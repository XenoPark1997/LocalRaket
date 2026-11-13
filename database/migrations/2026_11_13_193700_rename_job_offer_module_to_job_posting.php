<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $moduleId = DB::table('program_modules')->where('slug', 'job-offer')->value('id');

        if ($moduleId === null) {
            return;
        }

        DB::table('program_modules')
            ->where('id', $moduleId)
            ->update([
                'name' => 'Job Posting',
                'slug' => 'job-posting',
                'route_name' => 'job-posting',
            ]);

        DB::table('user_right_modules')
            ->where('program_module_id', $moduleId)
            ->update(['program_module_name' => 'Job Posting']);
    }

    public function down(): void
    {
        $moduleId = DB::table('program_modules')->where('slug', 'job-posting')->value('id');

        if ($moduleId === null) {
            return;
        }

        DB::table('program_modules')
            ->where('id', $moduleId)
            ->update([
                'name' => 'Job Offer',
                'slug' => 'job-offer',
                'route_name' => 'job-offer',
            ]);

        DB::table('user_right_modules')
            ->where('program_module_id', $moduleId)
            ->update(['program_module_name' => 'Job Offer']);
    }
};
