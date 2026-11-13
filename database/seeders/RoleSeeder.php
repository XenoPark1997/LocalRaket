<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ([
            'employee' => ['display_name' => 'Employee', 'description' => 'A user looking for work.'],
            'employer' => ['display_name' => 'Employer', 'description' => 'A user who manages job postings.'],
            'admin' => ['display_name' => 'Administrator', 'description' => 'A user who administers LocalRaket.'],
        ] as $name => $attributes) {
            Role::query()->updateOrCreate(['name' => $name], $attributes);
        }
    }
}
