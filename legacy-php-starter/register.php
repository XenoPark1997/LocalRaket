<?php

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/config/db.php';

if (!empty($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    $confirmPassword = (string) ($_POST['confirm_password'] ?? '');

    if (!valid_csrf_token(isset($_POST['csrf_token']) ? (string) $_POST['csrf_token'] : null)) {
        $error = 'Your session expired. Please try again.';
    } elseif (!preg_match('/\A[\p{L}\p{N}_.-]{3,50}\z/u', $username)) {
        $error = 'Use 3–50 letters, numbers, periods, underscores, or hyphens for your username.';
    } elseif (strlen($password) < 8 || strlen($password) > 72) {
        $error = 'Your password must be between 8 and 72 bytes.';
    } elseif ($password !== $confirmPassword) {
        $error = 'The passwords do not match.';
    } else {
        try {
            $statement = db()->prepare(
                'INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)'
            );
            $statement->execute([
                'username' => $username,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ]);

            header('Location: index.php?registered=1');
            exit;
        } catch (PDOException $exception) {
            if ($exception->getCode() === '23000') {
                $error = 'That username is already in use.';
            } else {
                error_log('LocalRaket database error: ' . $exception->getMessage());
                $error = 'Unable to connect to the database. Check the setup instructions in README.md.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create account | LocalRaket</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-page">
    <main class="auth-layout">
        <section class="auth-intro">
            <a class="brand brand-light" href="index.php"><span class="brand-mark">L</span> LocalRaket</a>
            <div class="intro-copy">
                <p class="eyebrow">MAKE YOUR NEXT MOVE</p>
                <h1>Open the door to what’s next.</h1>
                <p>Create an account and get your job search organized from day one.</p>
            </div>
            <p class="intro-footer">Your career journey, all in one place.</p>
        </section>

        <section class="auth-panel">
            <div class="auth-card">
                <a class="brand brand-dark" href="index.php"><span class="brand-mark">L</span> LocalRaket</a>
                <p class="eyebrow">GET STARTED</p>
                <h2>Create your account</h2>
                <p class="form-intro">A few details and you’re on your way.</p>

                <?php if ($error !== ''): ?>
                    <div class="notice notice-error" role="alert"><?= e($error) ?></div>
                <?php endif; ?>

                <form method="post" action="register.php" class="auth-form">
                    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                    <label for="username">Username</label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        value="<?= e($username) ?>"
                        autocomplete="username"
                        minlength="3"
                        maxlength="50"
                        required
                    >

                    <label for="password">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="new-password"
                        minlength="8"
                        maxlength="72"
                        required
                    >

                    <label for="confirm-password">Confirm password</label>
                    <input
                        id="confirm-password"
                        name="confirm_password"
                        type="password"
                        autocomplete="new-password"
                        minlength="8"
                        maxlength="72"
                        required
                    >

                    <button class="button button-primary" type="submit">Create account</button>
                </form>

                <p class="auth-switch">Already have an account? <a href="index.php">Login</a></p>
            </div>
        </section>
    </main>
</body>
</html>
