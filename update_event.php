<?php
// update_event.php
require_once('database.php');
require_once('image_util.php');

$eventId = filter_input(INPUT_POST, 'eventId', FILTER_VALIDATE_INT);
$eventName = filter_input(INPUT_POST, 'eventName');
$organizer = filter_input(INPUT_POST, 'organizer');
$typeID = filter_input(INPUT_POST, 'typeID', FILTER_VALIDATE_INT);
$emailAddress = filter_input(INPUT_POST, 'emailAddress', FILTER_VALIDATE_EMAIL);
$phoneNumber = filter_input(INPUT_POST, 'phoneNumber');
$eventDate = filter_input(INPUT_POST, 'eventDate');
$currentImage = filter_input(INPUT_POST, 'currentImage');

if (!$eventId || !$eventName || !$organizer || !$typeID || !$emailAddress || !$phoneNumber || !$eventDate) {
    $error = "Invalid event data. Check all fields and try again.";
    include('update_error.php');
    exit();
}

$newImage = process_image('eventImage');
$imageToSave = $newImage ? $newImage : $currentImage;

$query = 'UPDATE events 
          SET eventName = :eventName,
              organizer = :organizer,
              typeID = :typeID,
              emailAddress = :emailAddress,
              phoneNumber = :phoneNumber,
              eventDate = :eventDate,
              eventImage = :eventImage
          WHERE eventId = :eventId';

$statement = $db->prepare($query);
$statement->bindValue(':eventName', $eventName);
$statement->bindValue(':organizer', $organizer);
$statement->bindValue(':typeID', $typeID);
$statement->bindValue(':emailAddress', $emailAddress);
$statement->bindValue(':phoneNumber', $phoneNumber);
$statement->bindValue(':eventDate', $eventDate);
$statement->bindValue(':eventImage', $imageToSave);
$statement->bindValue(':eventId', $eventId);

$success = $statement->execute();
$statement->closeCursor();

if ($success) {
    header("Location: index.php");
} else {
    $error = "An error occurred while updating the event.";
    include('update_error.php');
}
?>