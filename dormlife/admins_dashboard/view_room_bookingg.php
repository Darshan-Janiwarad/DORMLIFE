<?php
session_start();
include '../connection/db.php';

// Ensure that the admin is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../admins/admin_login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch room details along with bed and student assignment information
$query_rooms_beds = "
    SELECT 
    grooms.room_number, 
    gbeds.bed_number,
    gbeds.student_name, 
    stv.Department
FROM 
    gblock_rooms AS grooms
JOIN 
    gblock_beds AS gbeds ON gbeds.room_id = grooms.room_id
JOIN 
    students_g AS stv ON gbeds.student_name = stv.Username;

";
$result_rooms_beds = $conn->query($query_rooms_beds);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room and Bed Details</title>
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

        .dashboard-container {
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
            background-color: #053857;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color:rgb(37, 111, 171);
        }

        .logout {
            padding: 10px 15px;
            background-color:rgb(224, 7, 7);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .logout:hover {
            background-color:rgb(145, 0, 0);
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>Room and Bed Details</h1>
        <div>
            <a href="../admins_dashboard/g.php" class="btn">Back to Dashboard</a>
            <a href="../admins/admin_logout.php" class="logout">Logout</a>
        </div>
    </div>

    <div class="dashboard-container">
        <h2>Room and Bed Information</h2>
        <?php if ($result_rooms_beds->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Room ID</th>
                        <th>Bed Number</th>
                        <th>Student Name</th>
                        <th>Student Department</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_rooms_beds->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['room_number']; ?></td>
                            <td><?php echo $row['bed_number']; ?></td> <!-- Display bed number -->
                            <td><?php echo $row['student_name'] ? $row['student_name'] : 'No Student Assigned'; ?></td>
                            <td><?php echo $row['Department']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No room and bed information available.</p>
        <?php endif; ?>
    </div>
</body>

</html>
<?php
$conn->close();
?>n