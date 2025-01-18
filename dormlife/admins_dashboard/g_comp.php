<?php
session_start();
include '../connection/db.php';

// Ensure that the admin is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../admins/admin_login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch complaints from vblock_complaints table
$query_complaints = "SELECT * FROM gblock_complaints";
$result_complaints = $conn->query($query_complaints);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Complaints - Block G</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(193, 192, 214);
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: rgb(49, 48, 68);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .navbar h1 {
            margin: 0;
            font-size: 24px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            font-size: 16px;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: rgb(5, 56, 87);
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 10px 15px;
            background-color: rgb(5, 137, 219);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: rgb(59, 53, 165);
        }

        .delete-btn {
            background-color: #f44336;
        }

        .delete-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>Block G Complaints</h1>
        <a href="g.php" class="btn">Back to Dashboard</a>
    </div>

    <div class="container">
        <h2>Complaints List</h2>
        <?php if ($result_complaints->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Complaint ID</th>
                        <th>Student Name</th>
                        <th>Complaint</th>
                        <th>Date Submitted</th>
                        <th>Department</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_complaints->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['complaint_id']; ?></td>
                            <td><?php echo $row['student_name']; ?></td>
                            <td><?php echo $row['complaint_text']; ?></td>
                            <td><?php echo $row['complaint_date']; ?></td>
                            <td><?php echo $row['branch']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No complaints found for Block G.</p>
        <?php endif; ?>
    </div>
</body>

</html>
<?php
$conn->close();
?>
