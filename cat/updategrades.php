<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades Report</title>
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
    <h2>Grades Report</h2>
    <?php
    // Include the database connection file
    require_once "connection/connection.php";

    // Check if form is submitted for updating data
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
        // Retrieve updated data from the form
        $markid = $_POST["markid"];
        $catMarks = $_POST["cat_marks"];
        $finalExam = $_POST["final_exam"];
        $courseId = $_POST["course_id"];

        // SQL query to update grades data
        $sql = "UPDATE grades SET CATmarks_30='$catMarks', FinalExam_60='$finalExam', courseid='$courseId' WHERE markid='$markid'";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>Record updated successfully</div>";
            header("location: viewgrades.php");
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error updating record: " . $conn->error . "</div>";
        }
    }

    // SQL query to select grades data from the database
    $sql = "SELECT * FROM grades";

    // Execute the query
    $result = $conn->query($sql);

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        // Initialize an empty array to store the fetched data
        $gradesData = [];

        // Fetch each row of data and store it in the array
        while ($row = $result->fetch_assoc()) {
            $gradesData[] = $row;
        }
    } else {
        // If there are no rows, display a message
        $gradesData = null;
    }

    // Close the database connection
    $conn->close();
    ?>

    <?php if (!empty($gradesData)) : ?>
        <table class="table">
            <thead>
                <tr>
                    <th>markid</th>
                    <th>CATmarks_30</th>
                    <th>FinalExam_60</th>
                    <th>courseid</th>
                    <th class="action-column" colspan="2">Action</th> <!-- Added colspan for action column -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gradesData as $grade) : ?>
                    <tr>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <td><?php echo $grade['markid']; ?></td>
                            <td><input type="text" name="cat_marks" value="<?php echo $grade['CATmarks_30']; ?>"></td>
                            <td><input type="text" name="final_exam" value="<?php echo $grade['FinalExam_60']; ?>"></td>
                            <td><input type="text" name="course_id" value="<?php echo $grade['courseid']; ?>"></td>
                            <td class="action-column">
                                <input type="hidden" name="markid" value="<?php echo $grade['markid']; ?>">
                                <input type="submit" name="update" class="btn btn-sm btn-primary" value="Update">
                            </td>
                        </form>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="message">No grades records found.</p>
    <?php endif; ?>

    <!-- Link to go back to homepage -->
    <a href="homepage.php" class="back-link">Back to Homepage</a>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2