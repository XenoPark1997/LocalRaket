# LocalRaket

LocalRaket is a Laravel 13 application with username/password registration, login, and an authenticated workspace layout. The previous plain-PHP starter is preserved in `legacy-php-starter/`.

## 1. Start the Laravel app in Laragon

1. Use PHP 8.3 or newer and start Apache and MySQL from Laragon.
2. Create the database in HeidiSQL or phpMyAdmin:

   ```sql
   CREATE DATABASE localraket CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

3. Check `.env` has the correct `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` values. The defaults target Laragon's local MySQL (`127.0.0.1`, database `localraket`, user `root`, empty password).
4. Set `LOCALRAKET_ADMIN_USERNAME` (default: `admin`) and `LOCALRAKET_ADMIN_PASSWORD` in `.env`. Use a unique password between 12 and 72 bytes. The weak password `admin` is accepted only when `APP_ENV=local`; never use it outside an isolated local development environment.
5. From the project directory, run:

   ```bash
   php artisan migrate --seed
   ```

6. Serve the app with `php artisan serve`, or configure a Laragon virtual host whose document root is this project's `public/` directory. Sign in at `/login` with the admin credentials from `.env`.

The `.env` file contains local settings, the admin password, and a generated application key; keep it private and do not commit it. For a fresh install, copy `.env.example` to `.env`, set the admin password, then run `php artisan key:generate`.

## 2. Users, model, and migration

The users table keeps a unique username, password hash, remember token, and timestamps. Later migrations add roles and the system tables:

- `roles` — employee, employer, and admin roles; users reference a role.
- `areas` and `locations` — area multipolygons and location points use SRID 4326. MySQL receives spatial indexes; SQLite test runs omit those unsupported indexes.
- `job_postings` and `job_applications` — employer, location, employee, and posting foreign keys.
- `program_modules` and `user_right_modules` — seeded navigation modules and role-based view/create/update/delete rights. Each right record stores `program_module_name` alongside its module foreign key.
- `log_files` — user-attributed activity records with optional polymorphic subjects and JSON context.

The corresponding Eloquent models define the relationships and mass-assignable fields. New sign-ups receive the employee role. `DatabaseSeeder` creates the three roles, seven exact navigation items, starter role permissions, and a default admin user. The admin role has all four permissions for every module. Re-running the seeder keeps an existing admin password unchanged; it refuses to promote an unrelated account that happens to use the configured admin username.

To make a later schema change, generate a migration with:

```bash
php artisan make:migration add_a_user_field_to_users_table
```

Then put the schema change in that migration and run `php artisan migrate`.

## 3. Routes and controllers

`routes/web.php` defines named guest routes for login and registration, plus authenticated routes for Dashboard, File Maintenance, Profile, Job Application, Job Posting, Settings, and POST Logout. The auth and guest middleware protect the routes, and login/registration POST requests are throttled.

Authentication methods live in `app/Http/Controllers/Auth/`. `DashboardController` renders the dashboard, while `WorkspaceController` provides the module-page actions. The module pages are placeholders for future feature work.

## 4. Blade views and navigation

The shared responsive sidebar is `resources/views/layouts/dashboard.blade.php`. Login and registration forms are in `resources/views/auth/`; the dashboard and module pages are in `resources/views/dashboard/` and `resources/views/workspace/`. All forms include Laravel's `@csrf` token.

Run the feature tests with:

```bash
php artisan test
```
