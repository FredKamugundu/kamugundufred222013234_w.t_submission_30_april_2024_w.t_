<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are set
    if(isset($_POST["courseid"]) && isset($_POST["coursename"]) && isset($_POST["credits"])) {
        // Extract data from the form
        $courseid = $_POST["courseid"];
        $coursename = $_POST["coursename"];
        $credits = $_POST["credits"];
        
        // Database connection details
        require_once "connection/connection.php";
        
        // SQL query to insert data into the database
        $sql = "INSERT INTO courses (courseid , coursename, credits) VALUES ('$courseid', '$coursename', '$credits')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header("location: studenthome.html");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        // Close the connection
        $conn->close();
    } else {
        echo "All fields are required.";
    }
}
?>
