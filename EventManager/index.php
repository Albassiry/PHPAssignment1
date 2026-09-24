<?php
    require('database.php');

    $queryEvents = 'SELECT * FROM events ORDER BY eventDate, eventName';
    $statement = $db->prepare($queryEvents);
    $statement->execute();
    $events = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Manager - Home</title>
    <link rel="stylesheet" type="text/css" href="css/event.css" />
</head>
<body>
    <?php include('header.php'); ?>

    <main>
        <h2>Event List</h2>

        <table>
            <tr>
                <th>Event Name</th>
                <th>Organizer</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Event Date</th>
            </tr>

            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?php echo htmlspecialchars($event['eventName']); ?></td>
                    <td><?php echo htmlspecialchars($event['organizer']); ?></td>
                    <td><?php echo htmlspecialchars($event['emailAddress']); ?></td>
                    <td><?php echo htmlspecialchars($event['phoneNumber']); ?></td>
                    <td><?php echo htmlspecialchars($event['eventDate']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <p><a href="add_event_form.php">Add Event</a></p>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>
