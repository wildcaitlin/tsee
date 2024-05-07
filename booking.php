<?php

ini_set('display_errors', 1);
error_reporting(-1);

include("config.php");

$name = $_POST["name"];
$datetime = $_POST["datetime"];
$email = $_POST["email"];

// Select the existing data based on datetime
$result = mysqli_query($conn, "SELECT bookingid, date, time FROM bookings WHERE datetime='$datetime'");

// Check for errors
if (!$result) {
    die("Error in SQL query: " . mysqli_error($conn));
}

// Fetch the result
$row = mysqli_fetch_assoc($result);

// Check if a row was found
if ($row) {
    $code = $row['bookingid'];
    $date = date('d/m/y', strtotime($row['date']));
    $time = date('H:i', strtotime($row['time']));

    

    // Update the data
    $sqlUpdate = "UPDATE bookings SET name='$name', email='$email' WHERE datetime='$datetime'";

    if (mysqli_query($conn, $sqlUpdate)) {
        echo "<h3>Data updated in the database successfully.</h3>";
        echo nl2br("\n$name\n $date\n $time\n $email\n");

        // Send email
        $message = "Hi, $name!\nYour open day code for $date at $time is:\n $code!";
        if (mail($email, "Your open day code!", $message)) {
            echo "Email successfully sent to $email...";
        } else {
            echo "Email sending failed...";
        }
    } else {
        echo "Error updating data: " . mysqli_error($conn);
    }
} else {
    echo "No booking found for the given datetime.";
}

// Free the result set
mysqli_free_result($result);

// Close connection
mysqli_close($conn);
?>
