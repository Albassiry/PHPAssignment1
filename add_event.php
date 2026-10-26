<?php
require_once('database.php');

$eventName    = filter_input(INPUT_POST, 'eventName');
$organizer    = filter_input(INPUT_POST, 'organizer');
$emailAddress = filter_input(INPUT_POST, 'emailAddress');
$phoneNumber  = filter_input(INPUT_POST, 'phoneNumber');
$eventDate    = filter_input(INPUT_POST, 'eventDate');
$typeId       = filter_input(INPUT_POST, 'typeId', FILTER_VALIDATE_INT);

if (!empty($eventName) && !empty($organizer) && !empty($emailAddress) && !empty($eventDate) && $typeId !== false) {
    
    // 1. Insert into database
    $query = 'INSERT INTO events (eventName, organizer, emailAddress, phoneNumber, eventDate, typeId, eventImage)
              VALUES (:eventName, :organizer, :emailAddress, :phoneNumber, :eventDate, :typeId, "placeholder.jpg")';
    $statement = $db->prepare($query);
    $statement->bindValue(':eventName', $eventName);
    $statement->bindValue(':organizer', $organizer);
    $statement->bindValue(':emailAddress', $emailAddress);
    $statement->bindValue(':phoneNumber', $phoneNumber);
    $statement->bindValue(':eventDate', $eventDate);
    $statement->bindValue(':typeId', $typeId);
    $statement->execute();
    $statement->closeCursor();

    // 2. Dispatch Email via PHPMailer
    require_once('PHPMailer/PHPMailerAutoload.php');
    $mail = new PHPMailer();

    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'your_email@gmail.com';  // Replace with your SMTP address
    $mail->Password   = 'your_app_password';     // Replace with your App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipient & Body
    $mail->setFrom('your_email@gmail.com', 'Event Manager System');
    $mail->addAddress($emailAddress, $organizer);
    $mail->isHTML(true);
    $mail->Subject = 'Event Creation Confirmation: ' . $eventName;
    $mail->Body    = "<h3>Hello " . htmlspecialchars($organizer) . ",</h3>" .
                     "<p>Your event <strong>" . htmlspecialchars($eventName) . "</strong> scheduled for " . 
                     htmlspecialchars($eventDate) . " has been successfully added!</p>";

    // Suppress local connection throws if SMTP is unconfigured during testing
    @$mail->send();

    // 3. Redirect to Confirmation Page
    header('Location: add_event_confirmation.php');
    exit();
} else {
    $error = "Invalid event data. Check all fields and try again.";
    include('database_error.php');
}
?>