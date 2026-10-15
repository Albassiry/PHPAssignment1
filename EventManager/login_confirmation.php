<?php include('header.php'); ?>
<h2>Login Confirmation</h2>
<p>Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
<p><a href="index.php">View Events List</a></p>
<?php include('footer.php'); ?>