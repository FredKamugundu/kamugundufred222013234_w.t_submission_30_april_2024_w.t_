<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses Report</title>
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
    <h2>Courses Report</h2>
    <?php
    // Include the database connection file
    require_once "connection/connection.php";

    // Check if form is submitted for updating data
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
        // Retrieve updated data from the form
        $courseid = $_POST["courseid"];
        $coursename = $_POST["coursename"];
        $credits = $_POST["credits"];

        // SQL query to update course data
        $sql = "UPDATE courses SET coursename='$coursename', credits='$credits' WHERE courseid='$courseid'";

        // Execute the query
      if ($conn->query($sql) === TRUE) {
    echo "<div class='alert alert-success' role='alert'>Record updated successfully</div>";
    header("location: viewcourse.php");
} else {
    echo "<div class='alert alert-danger' role='alert'>Error updating record: " . $conn->error . "</div>";
}

    }

    // SQL query to select course data from the database
    $sql = "SELECT * FROM courses";

    // Execute the query
    $result = $conn->query($sql);

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        // Initialize an empty array to store the fetched data
        $coursesData = [];

        // Fetch each row of data and store it in the array
        while ($row = $result->fetch_assoc()) {
            $coursesData[] = $row;
        }
    } else {
        // If there are no rows, display a message
        $coursesData = null;
    }

    // Close the database connection
    $conn->close();
    ?>

    <?php if (!empty($coursesData)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Credits</th>
                    <th class="action-column" colspan="2">Action</th> <!-- Added colspan for action column -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($coursesData as $course) : ?>
                    <tr>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <td><?php echo $course['courseid']; ?></td>
                            <td><input type="text" name="coursename" value="<?php echo $course['coursename']; ?>"></td>
                            <td><input type="text" name="credits" value="<?php echo $course['credits']; ?>"></td>
                            <td class="action-column">
                                <input type="hidden" name="courseid" value="<?php echo $course['courseid']; ?>">
                                <input type="submit" name="update" value="Update">
                            </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="message">No courses records found.</p>
    <?php endif; ?>

    <!-- Link to go back to homepage -->
    <a href="homepage.php" class="back-link">Back to Homepage</a>
</div>

</body>
</html>
