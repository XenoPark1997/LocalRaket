<?php

require_once __DIR__ . '/includes/auth.php';
require_login();

$username = (string) ($_SESSION['username'] ?? 'there');
$avatarInitial = preg_match('/^./u', $username, $matches) === 1
    ? strtoupper($matches[0])
    : 'L';
$sections = [
    'file-maintenance' => 'File Maintenance',
    'profile' => 'Profile',
    'job-application' => 'Job Application',
    'job-posting' => 'Job Posting',
    'settings' => 'Settings',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | LocalRaket</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="app-page">
    <div class="app-shell">
        <aside class="sidebar">
            <a class="brand brand-dark" href="dashboard.php"><span class="brand-mark">L</span> LocalRaket</a>
            <p class="nav-caption">WORKSPACE</p>
            <nav class="main-nav" aria-label="Main navigation">
                <a class="nav-link" href="#file-maintenance">File Maintenance</a>
                <a class="nav-link active" href="dashboard.php" aria-current="page">Dashboard</a>
                <a class="nav-link" href="#profile">Profile</a>
                <a class="nav-link" href="#job-application">Job Application</a>
                <a class="nav-link" href="#job-posting">Job Posting</a>
                <a class="nav-link" href="#settings">Settings</a>
                <form method="post" action="logout.php">
                    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                    <button class="nav-link logout-link" type="submit">Logout</button>
                </form>
            </nav>
            <div class="sidebar-bottom">
                <div class="sidebar-user">
                    <span class="avatar"><?= e($avatarInitial) ?></span>
                    <span class="sidebar-username"><?= e($username) ?></span>
                </div>
            </div>
        </aside>

        <main class="dashboard-main">
            <header class="topbar">
                <span class="topbar-label">Your workspace</span>
                <span class="topbar-greeting">Welcome, <?= e($username) ?></span>
            </header>

            <div class="dashboard-content">
                <section class="welcome-banner">
                    <p class="eyebrow">YOUR CAREER, IN MOTION</p>
                    <h1>Good to have you here, <?= e($username) ?>.</h1>
                    <p>Your LocalRaket workspace is ready. Choose a section to get started.</p>
                </section>

                <div class="section-heading">
                    <div>
                        <p class="eyebrow">WORKSPACE</p>
                        <h2>Explore your workspace</h2>
                    </div>
                </div>

                <div class="feature-grid">
                    <?php foreach ($sections as $id => $label): ?>
                        <section class="feature-card" id="<?= e($id) ?>">
                            <span class="feature-indicator" aria-hidden="true"></span>
                            <h3><?= e($label) ?></h3>
                            <p>This section is ready for your LocalRaket features.</p>
                        </section>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
