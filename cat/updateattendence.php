<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report</title>
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 70%; /* Reduced the size of the table */
            margin: 0 auto; /* Centered the table */
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        p.message {
            font-style: italic;
            text-align: center;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        .action-column {
            width: 100px; /* Set the width for the action column */
        }

        .action-column input[type="submit"] {
            margin-right: 5px; /* Add some margin between buttons */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Attendance Report</h2>
    <?php
    // Include the database connection file
    require_once "connection/connection.php";

    // Check if form is submitted for updating data
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
        // Retrieve updated data from the form
        $attendence_id = $_POST['attendence_id'];
        $userid = $_POST["userid"];
        $coursename = $_POST["coursename"];
        $fullname = $_POST["fullname"];

        // SQL query to update attendance data
        $sql = "UPDATE attendance SET coursename='$coursename', fullname='$fullname' WHERE attendence_id='$attendence_id'";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>Record updated successfully</div>";
            header("location: viewattendence.php"); // Redirect back to the attendance report page after updating
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error updating record: " . $conn->error . "</div>";
        }
    }

    // SQL query to select attendance data from the database
    $sql = "SELECT * FROM attendance";

    // Execute the query
    $result = $conn->query($sql);

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        // Initialize an empty array to store the fetched data
        $attendenceData = [];

        // Fetch each row of data and store it in the array
        while ($row = $result->fetch_assoc()) {
            $attendenceData[] = $row;
        }
    } else {
        // If there are no rows, display a message
        $attendanceData = null;
    }

    // Close the database connection
    $conn->close();
    ?>

    <?php if (!empty($attendenceData)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Attendance ID</th>
                    <th>User ID</th>
                    <th>Course Name</th>
                    <th>Full Name</th>
                    <th class="action-column" colspan="2">Action</th> <!-- Added colspan for action column -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendenceData as $attendence) : ?>
                    <tr>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <td><?php echo $attendence['attendence_id']; ?></td>
                            <td><?php echo $attendence['userid']; ?></td>
                            <td><input type="text" name="coursename" value="<?php echo $attendence['coursename']; ?>"></td>
                            <td><input type="text" name="fullname" value="<?php echo $attendence['fullname']; ?>"></td>
                            <td class="action-column">
                                <input type="hidden" name="attendence_id" value="<?php echo $attendence['attendence_id']; ?>">
                                <input type="hidden" name="userid" value="<?php echo $attendence['userid']; ?>">
                                <input type="submit" name="update" value="Update">
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="message">No attendance records found.</p>
    <?php endif; ?>

    <!-- Link to go back to homepage -->
    <a href="homepage.php" class="back-link">Back to Homepage</a>
</div>

</body>
</html>
