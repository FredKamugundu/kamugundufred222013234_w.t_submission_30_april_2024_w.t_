<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are set
    if(isset($_POST["markid"]) && isset($_POST["CATmarks_30"]) && isset($_POST["FinalExam_60"]) && isset($_POST["courseid"])) {
        // Extract data from the form
        $markid = $_POST["markid"];
        $CATmarks_30 = $_POST[" CATmarks_30"];
        $FinalExam_60 = $_POST["FinalExam_60"];
        $courseid = $_POST["courseid"];
        
        // Include the database connection file
       require_once "connection/connection.php";
        
        // SQL query to insert data into the database
        $sql = "INSERT INTO grades (markid,CATmarks_30, FinalExam_60, courseid) VALUES ('$markid', '$CATmarks_30', '$FinalExam_60', '$courseid')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header("location: adminhome.html");
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
