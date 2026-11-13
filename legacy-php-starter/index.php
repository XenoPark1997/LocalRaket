<?php

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/config/db.php';

if (!empty($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
$username = '';
$registered = isset($_GET['registered']) && $_GET['registered'] === '1';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if (!valid_csrf_token(isset($_POST['csrf_token']) ? (string) $_POST['csrf_token'] : null)) {
        $error = 'Your session expired. Please try again.';
    } elseif ($username === '' || $password === '') {
        $error = 'Enter your username and password.';
    } elseif (strlen($password) > 72) {
        $error = 'Incorrect username or password.';
    } else {
        try {
            $statement = db()->prepare(
                'SELECT id, username, password_hash FROM users WHERE username = :username LIMIT 1'
            );
            $statement->execute(['username' => $username]);
            $user = $statement->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = (int) $user['id'];
                $_SESSION['username'] = $user['username'];
                unset($_SESSION['csrf_token']);

                header('Location: dashboard.php');
                exit;
            }

            $error = 'Incorrect username or password.';
        } catch (PDOException $exception) {
            error_log('LocalRaket database error: ' . $exception->getMessage());
            $error = 'Unable to connect to the database. Check the setup instructions in README.md.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in | LocalRaket</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-page">
    <main class="auth-layout">
        <section class="auth-intro">
            <a class="brand brand-light" href="index.php"><span class="brand-mark">L</span> LocalRaket</a>
            <div class="intro-copy">
                <p class="eyebrow">YOUR NEXT MOVE STARTS HERE</p>
                <h1>Find your next opportunity.</h1>
                <p>Sign in to keep your applications and career details in one place.</p>
            </div>
            <p class="intro-footer">A simpler way to move your career forward.</p>
        </section>

        <section class="auth-panel">
            <div class="auth-card">
                <a class="brand brand-dark" href="index.php"><span class="brand-mark">L</span> LocalRaket</a>
                <p class="eyebrow">WELCOME BACK</p>
                <h2>Sign in to your account</h2>
                <p class="form-intro">Enter your details below to continue.</p>

                <?php if ($registered): ?>
                    <div class="notice notice-success" role="status">Your account is ready. Sign in to continue.</div>
                <?php endif; ?>
                <?php if ($error !== ''): ?>
                    <div class="notice notice-error" role="alert"><?= e($error) ?></div>
                <?php endif; ?>

                <form method="post" action="index.php" class="auth-form">
                    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                    <label for="username">Username</label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        value="<?= e($username) ?>"
                        autocomplete="username"
                        maxlength="50"
                        required
                    >

                    <label for="password">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="current-password"
                        required
                    >

                    <button class="button button-primary" type="submit">Login</button>
                </form>

                <p class="auth-switch">New to LocalRaket? <a href="register.php">Sign up</a></p>
            </div>
        </section>
    </main>
</body>
</html>
