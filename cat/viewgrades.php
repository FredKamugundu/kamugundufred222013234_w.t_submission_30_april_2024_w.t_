<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades Report</title>
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
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
            text-decoration: none;
            color: #007bff;
        }

        .action-column {
            width: 200px;
            text-align: center;
        }

        .action-column button {
            margin-right: 5px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Grades Report</h2>
    <?php
    // Include the database connection file
    require_once "connection/connection.php";

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
        <table>
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
                        <td><?php echo $grade['markid']; ?></td>
                        <td><?php echo $grade['CATmarks_30']; ?></td>
                        <td><?php echo $grade['FinalExam_60']; ?></td>
                        <td><?php echo $grade['courseid']; ?></td>
                        <td class="action-column">
                            <button><a href="Updategrades.php">Update</a></button>
                        </td>
                        <td class="action-column">
                            <button><a href="deletegrade.php">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="message">No grades records found.</p>
    <?php endif; ?>

    <!-- Link to go back to homepage -->
    <a href="studenthome.html" class="back-link">Back to Homepage</a>
</div>

</body>
</html>
