<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$is_logged_in = isset($_SESSION['user_id']);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/webtech_project/navbar.css">
</head>
<header>
    <nav class="navbar">
        <div class="logo">
            <img src="/webtech_project/images/Logo-BGedit.png" alt="Logo" id="logo">
        </div>
        <ul class="nav-links">
            <li><a href="/webtech_project/home.php">Home</a></li>
            <li><a href="/webtech_project/about.php">About</a></li>
            <li><a href="/webtech_project/event.php">Events</a></li>
            <?php if ($is_logged_in): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">Account ▼</a>
                    <ul class="dropdown-menu">
                        <li><a href="/webtech_project/view_bookings.php">View Bookings</a></li>
                    </ul>
                </li>
                <li><a href="/webtech_project/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="/webtech_project/login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>