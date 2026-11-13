<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use RuntimeException;
use Tests\TestCase;

class AdminUserSeederTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'localraket.admin.username' => 'seeded_admin',
            'localraket.admin.password' => 'A-secure-admin-password-123',
        ]);
    }

    public function test_database_seeder_creates_admin_with_access_to_every_module(): void
    {
        $this->seed(DatabaseSeeder::class);

        $admin = User::query()->where('username', 'seeded_admin')->firstOrFail();

        $this->assertSame('admin', $admin->role->name);
        $this->assertTrue(Hash::check('A-secure-admin-password-123', $admin->password));
        $this->assertSame([
            'File Maintenance',
            'Dashboard',
            'Profile',
            'Job Application',
            'Job Posting',
            'Settings',
            'Logout',
        ], $admin->role->programModules()->orderBy('sort_order')->pluck('name')->all());

        foreach ($admin->role->userRightModules()->with('programModule')->get() as $right) {
            $this->assertSame($right->programModule->name, $right->program_module_name);
        }

        foreach (['can_view', 'can_create', 'can_update', 'can_delete'] as $permission) {
            $this->assertSame(
                7,
                $admin->role->programModules()->wherePivot($permission, true)->count(),
            );
        }
    }

    public function test_rerunning_admin_seeder_preserves_the_existing_password(): void
    {
        $this->seed(DatabaseSeeder::class);
        $admin = User::query()->where('username', 'seeded_admin')->firstOrFail();
        $passwordHash = $admin->password;

        $this->seed(AdminUserSeeder::class);

        $this->assertSame($passwordHash, $admin->fresh()->password);
    }

    public function test_seeded_admin_can_sign_in_with_username(): void
    {
        $this->seed(DatabaseSeeder::class);
        $admin = User::query()->where('username', 'seeded_admin')->firstOrFail();

        $this->post('/login', [
            'username' => 'seeded_admin',
            'password' => 'A-secure-admin-password-123',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($admin);
    }

    public function test_seeded_admin_can_open_every_module_route(): void
    {
        $this->seed(DatabaseSeeder::class);
        $admin = User::query()->where('username', 'seeded_admin')->firstOrFail();
        $this->actingAs($admin);

        foreach ([
            'file-maintenance',
            'dashboard',
            'profile',
            'job-application',
            'job-posting',
            'settings',
        ] as $routeName) {
            $this->get(route($routeName))->assertOk();
        }

        $this->post(route('logout'))->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_registration_creates_an_employee_account_with_a_username(): void
    {
        $this->seed(RoleSeeder::class);

        $this->post('/register', [
            'username' => 'new_employee',
            'password' => 'A-secure-user-password-123',
            'password_confirmation' => 'A-secure-user-password-123',
        ])->assertRedirect(route('dashboard'));

        $user = User::query()->where('username', 'new_employee')->firstOrFail();
        $this->assertSame('employee', $user->role->name);
        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_seeder_does_not_promote_a_different_existing_user(): void
    {
        $this->seed(RoleSeeder::class);
        $employee = Role::query()->where('name', 'employee')->firstOrFail();
        $employee->users()->create([
            'username' => 'seeded_admin',
            'password' => 'A-secure-user-password-123',
        ]);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('already belongs to a non-admin user');

        $this->seed(AdminUserSeeder::class);
    }

    public function test_admin_seeder_requires_a_configured_password(): void
    {
        config(['localraket.admin.password' => '']);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Set LOCALRAKET_ADMIN_PASSWORD');

        $this->seed(AdminUserSeeder::class);
    }

    public function test_local_admin_password_is_applied_only_in_local_environment(): void
    {
        $this->app->detectEnvironment(fn () => 'local');
        config(['localraket.admin.password' => 'admin']);
        $this->seed(RoleSeeder::class);

        $adminRole = Role::query()->where('name', 'admin')->firstOrFail();
        $admin = $adminRole->users()->create([
            'username' => 'seeded_admin',
            'password' => 'A-secure-admin-password-123',
        ]);

        $this->seed(AdminUserSeeder::class);

        $this->assertTrue(Hash::check('admin', $admin->fresh()->password));
    }

    public function test_admin_password_admin_is_rejected_outside_local_environment(): void
    {
        config(['localraket.admin.password' => 'admin']);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('between 12 and 72 bytes');

        $this->seed(AdminUserSeeder::class);
    }
}
