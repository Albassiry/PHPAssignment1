<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Manager - Confirmation</title>
    <link rel="stylesheet" type="text/css" href="css/event.css" />
</head>
<body>
    <?php include('header.php'); ?>

    <main>
        <h2>Event Added Successfully</h2>
        <p>The event has been added to the database.</p>
        <p><a href="index.php">View Event List</a></p>
        <p><a href="add_event_form.php">Add Another Event</a></p>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>
