<?php
// index.php
require_once('database.php');

$query = 'SELECT e.*, t.contactType 
          FROM events e 
          JOIN types t ON e.typeID = t.typeID 
          ORDER BY e.eventDate ASC';
$statement = $db->prepare($query);
$statement->execute();
$events = $statement->fetchAll();
$statement->closeCursor();

include('header.php');
?>

<main>
    <h2>Event List</h2>
    <table>
        <tr>
            <th>Event Name</th>
            <th>Organizer</th>
            <th>Email Address</th>
            <th>Phone Number</th>
            <th>Date</th>
            <th>Event Type</th>
            <th>Photo</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($events as $event) : 
            $img_prefix = !empty($event['eventImage']) ? $event['eventImage'] : 'placeholder';
            $thumb_path = "images/" . $img_prefix . "_100.jpg";
            if (!file_exists($thumb_path)) {
                $thumb_path = "images/placeholder_100.jpg";
            }
        ?>
        <tr>
            <td><?php echo htmlspecialchars($event['eventName']); ?></td>
            <td><?php echo htmlspecialchars($event['organizer']); ?></td>
            <td><?php echo htmlspecialchars($event['emailAddress']); ?></td>
            <td><?php echo htmlspecialchars($event['phoneNumber']); ?></td>
            <td><?php echo htmlspecialchars($event['eventDate']); ?></td>
            <td><?php echo htmlspecialchars($event['contactType']); ?></td>
            <td>
                <img src="<?php echo htmlspecialchars($thumb_path); ?>" alt="Photo" width="60">
            </td>
            <td>
                <form action="update_event_form.php" method="get">
                    <input type="hidden" name="eventId" value="<?php echo $event['eventId']; ?>">
                    <input type="submit" value="Update">
                </form>
            </td>
            <td>
                <form action="delete_event.php" method="post">
                    <input type="hidden" name="eventId" value="<?php echo $event['eventId']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
            <td>
                <form action="event_details.php" method="get">
                    <input type="hidden" name="eventId" value="<?php echo $event['eventId']; ?>">
                    <input type="submit" value="View Details">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <p><a href="add_event_form.php">Add Event</a></p>
</main>

<?php include('footer.php'); ?>