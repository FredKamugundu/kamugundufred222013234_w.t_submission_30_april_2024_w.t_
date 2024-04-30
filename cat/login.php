<?php
// Start session
session_start();

// Include the database connection file
require_once "connection/connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Escape user inputs to prevent SQL injection
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Prepare SQL statement using prepared statement to prevent SQL injection
    $query = "SELECT * FROM admin WHERE email=? AND password=?";
    
    // Prepare the SQL statement
    $stmt = $conn->prepare($query);
    
    // Bind parameters to the prepared statement
    $stmt->bind_param("ss", $email, $password);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        // Admin login successful
        $_SESSION['user_type'] = 'admin';
        $_SESSION['email'] = $email;
        
        // Redirect to admin home page
        header("Location: adminhome.html");
        exit();
    }

    // Close the prepared statement
    $stmt->close();

    // If admin login fails, check user login
    $query = "SELECT * FROM users WHERE email=? AND password=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User login successful
        $_SESSION['user_type'] = 'student';
        $_SESSION['email'] = $email;
        
        // Redirect to user home page
        header("Location: studenthome.html");
        exit();
    } else {
        // Both admin and user login failed, display error message
        echo "Invalid email or password";
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>
