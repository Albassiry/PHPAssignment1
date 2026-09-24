<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Manager - Database Error</title>
    <link rel="stylesheet" type="text/css" href="css/event.css" />
</head>
<body>
    <?php include('header.php'); ?>

    <main>
        <h2>Database Error</h2>
        <p>There was an error connecting to the database.</p>
        <p>Make sure the database has been imported and MySQL is running in XAMPP.</p>
        <p>Error Message: <?php echo htmlspecialchars($_SESSION['database_error'] ?? 'Unknown error'); ?></p>
        <p><a href="index.php">View Event List</a></p>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>
