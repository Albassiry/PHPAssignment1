<?php
// update_event_form.php
require_once('database.php');

$eventId = filter_input(INPUT_GET, 'eventId', FILTER_VALIDATE_INT);

if (!$eventId) {
    header("Location: index.php");
    exit();
}

$query = 'SELECT * FROM events WHERE eventId = :eventId';
$statement = $db->prepare($query);
$statement->bindValue(':eventId', $eventId);
$statement->execute();
$event = $statement->fetch();
$statement->closeCursor();

$queryTypes = 'SELECT * FROM types ORDER BY typeID';
$statementTypes = $db->prepare($queryTypes);
$statementTypes->execute();
$types = $statementTypes->fetchAll();
$statementTypes->closeCursor();

include('header.php');
?>

<main>
    <h2>Update Event</h2>
    <form action="update_event.php" method="post" enctype="multipart/form-data" id="add_event_form">
        <input type="hidden" name="eventId" value="<?php echo $event['eventId']; ?>">
        <input type="hidden" name="currentImage" value="<?php echo htmlspecialchars($event['eventImage']); ?>">

        <label>Event Name:</label>
        <input type="text" name="eventName" value="<?php echo htmlspecialchars($event['eventName']); ?>" required><br>

        <label>Organizer:</label>
        <input type="text" name="organizer" value="<?php echo htmlspecialchars($event['organizer']); ?>" required><br>

        <label>Event Type:</label>
        <select name="typeID">
            <?php foreach ($types as $type) : ?>
                <option value="<?php echo $type['typeID']; ?>" <?php if ($type['typeID'] == $event['typeID']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($type['contactType']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Email Address:</label>
        <input type="email" name="emailAddress" value="<?php echo htmlspecialchars($event['emailAddress']); ?>" required><br>

        <label>Phone Number:</label>
        <input type="text" name="phoneNumber" value="<?php echo htmlspecialchars($event['phoneNumber']); ?>" required><br>

        <label>Event Date:</label>
        <input type="date" name="eventDate" value="<?php echo htmlspecialchars($event['eventDate']); ?>" required><br>

        <label>Event Image:</label>
        <input type="file" name="eventImage" accept="image/*"><br>

        <label>&nbsp;</label>
        <input type="submit" value="Update Event"><br>
    </form>
    <p><a href="index.php">View Event List</a></p>
</main>

<?php include('footer.php'); ?>