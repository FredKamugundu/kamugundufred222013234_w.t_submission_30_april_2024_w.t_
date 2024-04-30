<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Attendance</title>
    <!-- Your CSS styles -->
</head>
<body>

<?php
// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize $attendence_id with an empty value
$attendence_id = '';

// Check if the form is submitted and the attendance_id is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["attendence_id"])) {
    // Extract attendance_id from the form
    $attendence_id = $_POST["attendence_id"];
    
    // Include the database connection file
    require_once "connection/connection.php";
    
    // SQL query to delete the attendance record
    $sql = "DELETE FROM attendance WHERE attendence_id = '$attendence_id'";
    
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Close the connection
        $conn->close();
        
        // Redirect to the attendance view page after deletion
        header("location: viewattendence.php");
        exit; // Ensure that no further output is sent
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // If attendance ID is not set or the form is not submitted, display an error message
    echo "Attendance ID is required.";
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <!-- Hidden input field to hold the attendance ID -->
    <input type="number" name="attendence_id" value="<?php echo $attendence_id; ?>">
    <!-- Additional input fields or message if needed -->
    <input type="submit" value="Delete">
</form>

</body>
</html>
