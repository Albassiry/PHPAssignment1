<?php
// event_details.php
require_once('database.php');

$eventId = filter_input(INPUT_GET, 'eventId', FILTER_VALIDATE_INT);

if (!$eventId) {
    header("Location: index.php");
    exit();
}

$query = 'SELECT e.*, t.contactType 
          FROM events e 
          JOIN types t ON e.typeID = t.typeID 
          WHERE e.eventId = :eventId';
$statement = $db->prepare($query);
$statement->bindValue(':eventId', $eventId);
$statement->execute();
$event = $statement->fetch();
$statement->closeCursor();

if (!$event) {
    header("Location: index.php");
    exit();
}

$base_image = !empty($event['eventImage']) ? $event['eventImage'] : 'placeholder';
$image_path = "images/" . $base_image . "_400.jpg";
if (!file_exists($image_path)) {
    $image_path = "images/placeholder_400.jpg";
}

include('header.php');
?>

<main>
    <h2>Event Details</h2>
    <div class="details-container">
        <div class="details-image">
            <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($event['eventName']); ?>">
        </div>
        <div class="details-info">
            <h3><?php echo htmlspecialchars($event['eventName']); ?></h3>
            <p><strong>Organizer:</strong> <?php echo htmlspecialchars($event['organizer']); ?></p>
            <p><strong>Type:</strong> <?php echo htmlspecialchars($event['contactType']); ?></p>
            <p><strong>Date:</strong> <?php echo htmlspecialchars($event['eventDate']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($event['emailAddress']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($event['phoneNumber']); ?></p>
        </div>
    </div>
    <p>
        <a href="update_event_form.php?eventId=<?php echo $event['eventId']; ?>">Edit Event</a> | 
        <a href="index.php">View Event List</a>
    </p>
</main>

<?php include('footer.php'); ?>