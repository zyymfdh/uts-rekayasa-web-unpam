<?php
// Include the database connection file
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $guests = $_POST['guests'];
    $room_id = 1;  // Set a default room_id or retrieve it from form data if selectable

    // Insert guest data into Guests table
    $sql_guest = "INSERT INTO Guests (full_name, email) VALUES ('$name', '$email')";
    if ($conn->query($sql_guest) === TRUE) {
        $guest_id = $conn->insert_id;  // Get the last inserted guest ID

        // Insert booking data into Bookings table
        $sql_booking = "INSERT INTO Bookings (guest_id, room_id, check_in_date, check_out_date, num_of_guests)
                        VALUES ('$guest_id', '$room_id', '$checkin', '$checkout', '$guests')";

        if ($conn->query($sql_booking) === TRUE) {
            echo "Booking successful! Your booking ID is: " . $conn->insert_id;
        } else {
            echo "Error: " . $sql_booking . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql_guest . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
