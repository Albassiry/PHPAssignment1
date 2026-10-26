<?php include('header.php'); ?>
<h2>Login</h2>
<form action="login.php" method="post" id="login_form">
    <label>Username:</label>
    <input type="text" name="userName" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <label>&nbsp;</label>
    <input type="submit" value="Login"><br>
</form>
<?php include('footer.php'); ?>