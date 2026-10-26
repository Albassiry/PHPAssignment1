<?php 
include('header.php'); 
?>
<h2>Register User</h2>
<form action="register_user.php" method="post" id="register_user_form">
    <label>User Name:</label>
    <input type="text" name="userName" required><br>

    <label>Email Address:</label>
    <input type="email" name="emailAddress" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <label>Confirm Password:</label>
    <input type="password" name="confirmPassword" required><br>

    <label>&nbsp;</label>
    <input type="submit" value="Register User"><br>
</form>
<?php include('footer.php'); ?>