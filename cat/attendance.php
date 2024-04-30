<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are set
    if(isset($_POST["attendence_id"]) && isset($_POST["userid"]) && isset($_POST["coursename"]) && isset($_POST["fullname"])) {
        // Extract data from the form
        $attendence_id = $_POST["attendence_id"];
        $userid = $_POST["userid"];
        $coursename = $_POST["coursename"];
        $fullname = $_POST["fullname"];
        
        require_once "connection/connection.php";
        // SQL query to insert data into the database
        $sql = "INSERT INTO attendance (attendence_id, userid, coursename, fullname) VALUES ('$attendence_id', '$userid', '$coursename', '$fullname')";
        
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
