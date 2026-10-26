<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('database.php');

$userName = filter_input(INPUT_POST, 'userName');
$password = filter_input(INPUT_POST, 'password');

if ($userName == NULL || $password == NULL) {
    $error = "Please provide both username and password.";
    include('user_error.php');
    exit();
}

$query = 'SELECT * FROM registrations WHERE userName = :userName';
$statement = $db->prepare($query);
$statement->bindValue(':userName', $userName);
$statement->execute();
$user = $statement->fetch();
$statement->closeCursor();

if ($user && password_verify($password, $user['password'])) {
    // Reset failed login attempts on success
    $query = 'UPDATE registrations SET failedAttempts = 0, lastFailedLogin = NULL WHERE userID = :userID';
    $statement = $db->prepare($query);
    $statement->bindValue(':userID', $user['userID']);
    $statement->execute();
    $statement->closeCursor();

    $_SESSION['is_logged_in'] = true;
    $_SESSION['user_id'] = $user['userID'];
    $_SESSION['username'] = $user['userName'];

    include('login_confirmation.php');
} else {
    if ($user) {
        // Increment failed attempts
        $failedAttempts = ($user['failedAttempts'] ?? 0) + 1;
        $query = 'UPDATE registrations SET failedAttempts = :failedAttempts, lastFailedLogin = NOW() WHERE userID = :userID';
        $statement = $db->prepare($query);
        $statement->bindValue(':failedAttempts', $failedAttempts);
        $statement->bindValue(':userID', $user['userID']);
        $statement->execute();
        $statement->closeCursor();
    }
    $error = "Invalid credentials. Please try again.";
    include('user_error.php');
    exit();
}
?>