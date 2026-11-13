<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $username = config('localraket.admin.username');
        $password = config('localraket.admin.password');

        if (! is_string($username) || ! preg_match('/\A[a-zA-Z0-9_.-]{3,50}\z/', $username)) {
            throw new RuntimeException('Set LOCALRAKET_ADMIN_USERNAME to a valid 3-50 character username.');
        }

        $localDevelopmentPassword = app()->environment('local') && $password === 'admin';

        if (
            ! is_string($password)
            || (! $localDevelopmentPassword && (strlen($password) < 12 || strlen($password) > 72))
        ) {
            throw new RuntimeException('Set LOCALRAKET_ADMIN_PASSWORD to a unique password between 12 and 72 bytes.');
        }

        $adminRole = Role::query()->where('name', 'admin')->firstOrFail();
        $existingUser = User::query()->where('username', $username)->first();

        if ($existingUser) {
            if ((int) $existingUser->role_id !== (int) $adminRole->id) {
                throw new RuntimeException(
                    "The username [{$username}] already belongs to a non-admin user; choose another admin username.",
                );
            }

            if ($localDevelopmentPassword) {
                $existingUser->password = $password;
                $existingUser->save();
            }

            return;
        }

        $adminRole->users()->create([
            'username' => $username,
            'password' => $password,
        ]);
    }
}
