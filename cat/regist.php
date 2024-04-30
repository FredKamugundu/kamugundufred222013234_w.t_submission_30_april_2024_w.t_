<?php
        // Include the database connection file
       require_once "connection/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userid = $conn->real_escape_string($_POST["userid"]);;
    $fullname = $conn->real_escape_string($_POST["fullname"]);
    $age = $conn->real_escape_string($_POST["age"]);
    $gender = $conn->real_escape_string($_POST["gender"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $faculty = $conn->real_escape_string($_POST["faculty"]);
    $password = $conn->real_escape_string($_POST["password"]);

    $sql = "INSERT INTO users (userid, fullname, age, gender, email, faculty, password)
            VALUES ('$userid', '$fullname', '$age', '$gender', '$email', '$faculty', '$password')";

    if ($conn->query($sql) === TRUE) {
        
        echo"<script>alert('Registration successful!')</script>";
         header("location: login.html");

    } else {
        
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
echo "<a href='login.php'>Back</a>";
$conn->close();
?>