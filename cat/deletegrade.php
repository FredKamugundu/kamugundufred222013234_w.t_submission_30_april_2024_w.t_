<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Grade</title>
    <!-- Your CSS styles -->
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <!-- Input field to enter the markid for deletion -->
    <label for="markid">Mark ID:</label><br>
    <input type="text" id="markid" name="markid" required><br><br>

    <!-- Submit button to delete the grade record -->
    <input type="submit" value="Delete">
</form>

<?php
// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted and markid is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["markid"])) {
    // Extract markid from the form
    $markid = $_POST["markid"];
    
    // Include the database connection file
    require_once "connection/connection.php";
    
    // SQL query to delete the grades record
    $sql = "DELETE FROM grades WHERE markid = '$markid'";
    
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
         header("location: viewgrades.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    // Close the connection
    $conn->close();
}
?>

</body>
</html>
