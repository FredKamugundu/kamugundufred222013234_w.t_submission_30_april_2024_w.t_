<?php
// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted and courseid is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["courseid"])) {
    // Extract courseid from the form
    $courseid = $_POST["courseid"];
    
    // Include the database connection file
    require_once "connection/connection.php";
    
    // SQL query to delete the course record
    $sql = "DELETE FROM courses WHERE courseid = '$courseid'";
    
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Close the connection
        $conn->close();
        
        // Redirect to the courses view page after deletion
        header("location: viewcourse.php");
        exit; // Ensure that no further output is sent
    } else {
        echo "Error deleting record: you canot delete  it has foriegin key in another table  " ;
    }
} else {
    // If course ID is not set or the form is not submitted, display an error message
    echo "Course ID is required.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Course</title>
    <!-- Your CSS styles -->
</head>
<body>

<form action="deletecourse.php" method="POST">
    <!-- Hidden input field to hold the course ID -->
    <input type="number" name="courseid" value="<?php echo $courseid; ?>">
    <!-- Additional input fields or message if needed -->
    <input type="submit" value="Delete">
</form>

</body>
</html>
