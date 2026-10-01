<?php
require_once('database.php');

$event_id = filter_input(INPUT_POST, 'event_id', FILTER_VALIDATE_INT);

if ($event_id != FALSE) {
    $query = 'DELETE FROM events WHERE eventID = :event_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':event_id', $event_id);
    $statement->execute();
    $statement->closeCursor();
}

header('Location: index.php');
exit();
?>