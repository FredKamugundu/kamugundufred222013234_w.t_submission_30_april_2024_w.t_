<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course View</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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

        .action-column button {
            margin-right: 5px; /* Add some margin between buttons */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Course View</h2>
    <?php
    // Include the database connection file
    require_once "connection/connection.php";

    // SQL query to select course data from the database
    $sql = "SELECT * FROM courses";

    // Execute the query
    $result = $conn->query($sql);

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        // Initialize an empty array to store the fetched data
        $courseData = [];

        // Fetch each row of data and store it in the array
        while ($row = $result->fetch_assoc()) {
            $courseData[] = $row;
        }
    } else {
        // If there are no rows, display a message
        $courseData = null;
    }

    // Close the database connection
    $conn->close();
    ?>

    <?php if (!empty($courseData)) : ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>credits</th>
                    <th class="action-column" colspan="2">Action</th> <!-- Added colspan for action column -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courseData as $course) : ?>
                    <tr>
                        <td><?php echo $course['courseid']; ?></td>
                        <td><?php echo $course['coursename']; ?></td>
                        <td><?php echo $course['credits']; ?></td>
                        <td class="action-column">
                            <button class="btn btn-sm btn-primary"><a href="Updatecourses.php">Update</button>
                        </td>
                        <td class="action-column">
                            <button class="btn btn-sm btn-danger"><a href="deletecourse.php">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="message">No courses found.</p>
    <?php endif; ?>

    <!-- Link to go back to homepage -->
    <a href="adminhome.html" class="back-link">Back to Homepage</a>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
