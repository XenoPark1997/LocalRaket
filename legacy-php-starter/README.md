# LocalRaket

A responsive PHP/MySQL starter for LocalRaket, intended for a local Laragon setup.

## Project structure

- `index.php` — login page
- `register.php` — account registration
- `dashboard.php` — session-protected dashboard
- `logout.php` — session logout
- `config/` — database and session configuration
- `includes/` — shared authentication and CSRF helpers
- `assets/css/style.css` — responsive styles
- `database/schema.sql` — initial database and users table

## Run locally with Laragon

1. Start Apache and MySQL in Laragon.
2. Import `database/schema.sql` using HeidiSQL, phpMyAdmin, or the MySQL command line. It creates the `localraket` database and `users` table.
3. Place this project in Laragon's web root and open it through its local host, for example `http://localhost/localraket/`.
4. The default database connection is `127.0.0.1`, database `localraket`, username `root`, and an empty password. Override these values with the `LOCALRAKET_DB_HOST`, `LOCALRAKET_DB_NAME`, `LOCALRAKET_DB_USER`, and `LOCALRAKET_DB_PASSWORD` environment variables if your local MySQL setup differs.

The project requires PHP with PDO MySQL enabled. Passwords are stored using PHP's `password_hash` and limited to 72 bytes for compatibility with PHP's default bcrypt hash; registration and login forms use session-backed CSRF tokens.