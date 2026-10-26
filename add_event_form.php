<?php 
require_once('database.php');

$queryTypes = 'SELECT * FROM event_types ORDER BY typeId';
$statement = $db->prepare($queryTypes);
$statement->execute();
$types = $statement->fetchAll();
$statement->closeCursor();

include('header.php'); 
?>

<main>
    <h2>Add Event</h2>
    <form action="add_event.php" method="post" id="add_event_form">
        <label>Event Name:</label>
        <input type="text" name="eventName" required><br>

        <label>Organizer Name:</label>
        <input type="text" name="organizer" required><br>

        <label>Organizer Email:</label>
        <input type="email" name="emailAddress" required><br>

        <label>Phone Number:</label>
        <input type="text" name="phoneNumber" required><br>

        <label>Event Date:</label>
        <input type="date" name="eventDate" required><br>

        <label>Event Type:</label>
        <select name="typeId">
            <?php foreach ($types as $type) : ?>
                <option value="<?php echo $type['typeId']; ?>">
                    <?php echo htmlspecialchars($type['typeName']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>&nbsp;</label>
        <input type="submit" value="Add Event"><br>
    </form>
    <p><a href="index.php">View Event List</a></p>
</main>

<?php include('footer.php'); ?>