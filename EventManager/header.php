<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Manager</title>
    <link rel="stylesheet" type="text/css" href="css/event.css">
</head>
<body>
    <header>
        <h1>Event Manager</h1>
        <nav>
            <a href="index.php">Home</a> | 
            <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true): ?>
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span> | 
                <a href="add_event_form.php">Add Event</a> | 
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login_form.php">Login</a> | 
                <a href="register_user_form.php">Register User</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>