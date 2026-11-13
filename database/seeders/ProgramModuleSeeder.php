<?php

namespace Database\Seeders;

use App\Models\ProgramModule;
use App\Models\Role;
use App\Models\UserRightModule;
use Illuminate\Database\Seeder;

class ProgramModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            ['name' => 'File Maintenance', 'slug' => 'file-maintenance', 'route_name' => 'file-maintenance', 'http_method' => 'GET', 'sort_order' => 1],
            ['name' => 'Dashboard', 'slug' => 'dashboard', 'route_name' => 'dashboard', 'http_method' => 'GET', 'sort_order' => 2],
            ['name' => 'Profile', 'slug' => 'profile', 'route_name' => 'profile', 'http_method' => 'GET', 'sort_order' => 3],
            ['name' => 'Job Application', 'slug' => 'job-application', 'route_name' => 'job-application', 'http_method' => 'GET', 'sort_order' => 4],
            ['name' => 'Job Posting', 'slug' => 'job-posting', 'route_name' => 'job-posting', 'http_method' => 'GET', 'sort_order' => 5],
            ['name' => 'Settings', 'slug' => 'settings', 'route_name' => 'settings', 'http_method' => 'GET', 'sort_order' => 6],
            ['name' => 'Logout', 'slug' => 'logout', 'route_name' => 'logout', 'http_method' => 'POST', 'sort_order' => 7],
        ];
        $roles = Role::all();

        foreach ($modules as $attributes) {
            $module = ProgramModule::query()->updateOrCreate(
                ['slug' => $attributes['slug']],
                $attributes,
            );

            foreach ($roles as $role) {
                $isAdmin = $role->name === 'admin';
                $canCreate = $isAdmin
                    || ($role->name === 'employee' && $module->slug === 'job-application')
                    || ($role->name === 'employer' && $module->slug === 'job-posting');

                UserRightModule::query()->updateOrCreate(
                    [
                        'role_id' => $role->id,
                        'program_module_id' => $module->id,
                    ],
                    [
                        'can_view' => true,
                        'program_module_name' => $module->name,
                        'can_create' => $canCreate,
                        'can_update' => $isAdmin || $module->slug === 'profile',
                        'can_delete' => $isAdmin,
                    ],
                );
            }
        }
    }
}
