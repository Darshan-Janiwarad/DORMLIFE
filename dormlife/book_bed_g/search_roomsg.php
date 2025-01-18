<?php
session_start();
include '../connection/db.php';

// Check if the user is logged in and belongs to N Block
if (!isset($_SESSION['student_username']) || $_SESSION['student_block'] !== 'G') {
    header("Location: ../students/login.php");
    exit();
}

$rooms = [];
$user_name = $_SESSION['student_username']; // Assuming the username is the student name

// Check if the department is selected
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['department']) && !empty($_POST['department'])) {
    $department_id = intval($_POST['department']); // Ensure department ID is an integer

    // Query to fetch rooms, beds, and student details, but include student info only when the bed is booked
    $sql = "
        SELECT 
            grooms.room_id, 
            grooms.room_number, 
            gbeds.bed_id, 
            gbeds.bed_number, 
            gbeds.is_booked,
            CASE WHEN gbeds.is_booked = 1 THEN stv.Name ELSE NULL END AS student_name,
            CASE WHEN gbeds.is_booked = 1 THEN stv.Department ELSE NULL END AS student_department,
            CASE WHEN gbeds.is_booked = 1 THEN stv.Year ELSE NULL END AS student_year,
            CASE WHEN gbeds.is_booked = 1 THEN stv.Address ELSE NULL END AS student_address
        FROM 
            gblock_rooms AS grooms
        JOIN 
            gblock_beds AS gbeds ON grooms.room_id = gbeds.room_id
        LEFT JOIN 
            students_g AS stv ON gbeds.student_name = stv.Username
        WHERE 
            grooms.department_id = ?
        ORDER BY 
            grooms.room_id, gbeds.bed_number;
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $department_id); // Bind department_id as an integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Organize data into rooms and beds
    while ($row = $result->fetch_assoc()) {
        if (!isset($rooms[$row['room_id']])) {
            // Initialize room data
            $rooms[$row['room_id']] = [
                'room_number' => $row['room_number'],
                'beds' => []
            ];
        }

        // Add bed data to the room
        $rooms[$row['room_id']]['beds'][] = [
            'bed_id' => $row['bed_id'],
            'bed_number' => $row['bed_number'],
            'is_booked' => $row['is_booked'],
            'student_name' => $row['student_name'],
            'student_department' => $row['student_department'],
            'student_year' => $row['student_year'],
            'student_address' => $row['student_address']
        ];
    }

    $stmt->close();

    // Check if the user has already booked a bed
    $sql_check_booking = "
        SELECT * 
        FROM gblock_beds 
        WHERE student_name = ? AND is_booked = 1
    ";
    $stmt_check_booking = $conn->prepare($sql_check_booking);
    $stmt_check_booking->bind_param("s", $user_name);
    $stmt_check_booking->execute();
    $result_check_booking = $stmt_check_booking->get_result();

    // If the user has booked a bed, disable their selection
    $has_booked = $result_check_booking->num_rows > 0;

    $stmt_check_booking->close();
    $conn->close();
} else {
    header("Location: ../students/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Rooms - G Block</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #2c3e50;
            text-align: center;
        }

        .room {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #ecf0f1;
        }

        .room h3 {
            margin: 0;
            color: #34495e;
        }

        .beds {
            margin-top: 10px;
            list-style-type: none;
            padding: 0;
        }

        .beds li {
            display: inline-block;
            margin-right: 10px;
        }

        .beds button {
            padding: 8px 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .beds button:hover {
            background-color: #2980b9;
        }

        .disabled-button {
            background-color: #95a5a6;
            cursor: not-allowed;
        }

        .student-details {
            margin-top: 10px;
            padding: 10px;
            background-color: #dfe6e9;
            border-radius: 5px;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
        }

        .back-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Available Rooms in G Block</h2>

        <?php if (!empty($rooms)): ?>
            <?php foreach ($rooms as $room_id => $room): ?>
                <div class="room">
                    <h3>Room <?= htmlspecialchars($room['room_number']); ?></h3>
                    <ul class="beds">
                        <?php foreach ($room['beds'] as $bed): ?>
                            <li>
                                <?php if ($bed['is_booked']): ?>
                                    <div class="student-details">
                                        <strong>Name:</strong> <?= htmlspecialchars($bed['student_name']); ?><br>
                                        <strong>Department:</strong> <?= htmlspecialchars($bed['student_department']); ?><br>
                                        <strong>Year:</strong> <?= htmlspecialchars($bed['student_year']); ?><br>
                                        <strong>Address:</strong> <?= htmlspecialchars($bed['student_address']);?><br>
                                        <strong>Bed_no:</strong> <?= htmlspecialchars($bed['bed_number']);?>
                                    </div>
                                <?php else: ?>
                                    <form action="book_bedg.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="bed_id" value="<?= htmlspecialchars($bed['bed_id']); ?>">
                                        <input type="hidden" name="room_id" value="<?= htmlspecialchars($room_id); ?>">
                                        <input type="hidden" name="department_id" value="<?= htmlspecialchars($department_id); ?>">
                                        <button type="submit" <?= $has_booked ? 'disabled class="disabled-button"' : ''; ?>>
                                            Bed <?= htmlspecialchars($bed['bed_number']); ?>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No available rooms or beds for the selected department.</p>
        <?php endif; ?>

        <a href="../dashboards/g.php" class="back-btn">Back to Dashboard</a>
    </div>
</body>

</html>
