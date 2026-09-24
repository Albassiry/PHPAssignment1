<!DOCTYPE html>
<html>
<head>
    <title>Event Manager - Add Event</title>
    <link rel="stylesheet" type="text/css" href="css/event.css" />
</head>
<body>
    <?php include('header.php'); ?>

    <main>
        <h2>Add Event</h2>

        <form action="add_event.php" method="post" id="add_event_form">
            <div id="data">
                <label>Event Name:</label>
                <input type="text" name="event_name" required /><br />

                <label>Organizer:</label>
                <input type="text" name="organizer" required /><br />

                <label>Email Address:</label>
                <input type="email" name="email_address" required /><br />

                <label>Phone Number:</label>
                <input type="text" name="phone_number" required /><br />

                <label>Event Date:</label>
                <input type="date" name="event_date" required /><br />
            </div>

            <div id="buttons">
                <label>&nbsp;</label>
                <input type="submit" value="Save Event" /><br />
            </div>
        </form>

        <p><a href="index.php">View Event List</a></p>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>
