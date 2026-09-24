<?php
    session_start();

    $event_name = trim(filter_input(INPUT_POST, 'event_name'));
    $organizer = trim(filter_input(INPUT_POST, 'organizer'));
    $email_address = trim(filter_input(INPUT_POST, 'email_address'));
    $phone_number = trim(filter_input(INPUT_POST, 'phone_number'));
    $event_date = filter_input(INPUT_POST, 'event_date');

    if ($event_name === '' || $organizer === '' || $email_address === '' || $phone_number === '' || $event_date === '') {
        $_SESSION['form_error'] = 'Please complete all fields.';
        header('Location: add_event_form.php');
        exit();
    }

    if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['form_error'] = 'Please enter a valid email address.';
        header('Location: add_event_form.php');
        exit();
    }

    require_once('database.php');

    $query = 'INSERT INTO events (eventName, organizer, emailAddress, phoneNumber, eventDate)
              VALUES (:eventName, :organizer, :emailAddress, :phoneNumber, :eventDate)';

    $statement = $db->prepare($query);
    $statement->bindValue(':eventName', $event_name);
    $statement->bindValue(':organizer', $organizer);
    $statement->bindValue(':emailAddress', $email_address);
    $statement->bindValue(':phoneNumber', $phone_number);
    $statement->bindValue(':eventDate', $event_date);
    $statement->execute();
    $statement->closeCursor();

    header('Location: add_event_confirmation.php');
    exit();
?>
