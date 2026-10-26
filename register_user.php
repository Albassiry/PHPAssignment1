<?php
require_once('database.php');

$userName = filter_input(INPUT_POST, 'userName');
$emailAddress = filter_input(INPUT_POST, 'emailAddress', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');
$confirmPassword = filter_input(INPUT_POST, 'confirmPassword');

if ($userName == NULL || $emailAddress == FALSE || $password == NULL || $confirmPassword == NULL) {
    $error = "Invalid registration data. Check all fields and try again.";
    include('user_error.php');
    exit();
} elseif ($password !== $confirmPassword) {
    $error = "Passwords do not match. Please try again.";
    include('user_error.php');
    exit();
} else {
    // Check if username already exists
    $query = 'SELECT userID FROM registrations WHERE userName = :userName';
    $statement = $db->prepare($query);
    $statement->bindValue(':userName', $userName);
    $statement->execute();
    $existingUser = $statement->fetch();
    $statement->closeCursor();

    if ($existingUser) {
        $error = "Username is already taken. Please choose another.";
        include('user_error.php');
        exit();
    }

    // Hash password and insert record
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = 'INSERT INTO registrations (userName, password, emailAddress)
              VALUES (:userName, :password, :emailAddress)';
    $statement = $db->prepare($query);
    $statement->bindValue(':userName', $userName);
    $statement->bindValue(':password', $hashPassword);
    $statement->bindValue(':emailAddress', $emailAddress);
    $statement->execute();
    $statement->closeCursor();

    include('register_user_confirmation.php');
}
?>