<?php
// Suppress warnings from spilling into HTML tag attributes
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

require_once('database.php');

$queryEvents = 'SELECT * FROM events ORDER BY eventDate ASC';
$statement = $db->prepare($queryEvents);
$statement->execute();
$events = $statement->fetchAll(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>

<?php include('header.php'); ?>

<h2>Event List</h2>

<table>
    <thead>
        <tr>
            <th>Event Name</th>
            <th>Organizer</th>
            <th>Email Address</th>
            <th>Phone Number</th>
            <th>Event Date</th>
            <th>Event Type</th>
            <th>Photo</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($events as $event) : ?>
        <?php 
            // Fallback key check for ID to prevent warnings in input attributes
            $id = $event['eventID'] ?? $event['event_id'] ?? $event['id'] ?? 0;
            $type = $event['eventType'] ?? $event['event_type'] ?? 'General';
            $image = !empty($event['eventImage']) ? $event['eventImage'] : 'placeholder.png';
        ?>
        <tr>
            <td><?php echo htmlspecialchars($event['eventName'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($event['organizer'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($event['emailAddress'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($event['phoneNumber'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($event['eventDate'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($type); ?></td>
            <td>
                <img src="images/<?php echo htmlspecialchars($image); ?>" alt="Event Photo" class="event-photo">
            </td>
            <td>
                <form action="update_event_form.php" method="post">
                    <input type="hidden" name="event_id" value="<?php echo (int)$id; ?>">
                    <input type="submit" value="Update">
                </form>
            </td>
            <td>
                <form action="delete_event.php" method="post">
                    <input type="hidden" name="event_id" value="<?php echo (int)$id; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p><a href="add_event_form.php">Add Event</a></p>

<?php include('footer.php'); ?>