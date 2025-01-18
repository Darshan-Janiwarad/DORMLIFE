<?php
session_start();
include '../connection/db.php';

// Check if the user is logged in
if (!isset($_SESSION['student_username'])) {
    header("Location: ../students/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bed_id = intval($_POST['bed_id']);
    $room_id = intval($_POST['room_id']);
    $department_id = intval($_POST['department_id']);

    // Check if the bed is still available
    $sql_check = "SELECT * FROM nblock_beds WHERE bed_id = ? AND is_booked = 0";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $bed_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Book the bed
        $sql_book = "UPDATE nblock_beds SET is_booked = 1, student_name = ? WHERE bed_id = ?";
        $stmt_book = $conn->prepare($sql_book);
        $booked_by = $_SESSION['student_username']; // The student's name (assuming their username is their name)
        $stmt_book->bind_param("si", $booked_by, $bed_id);
        if ($stmt_book->execute()) {
            echo "<script>alert('Bed successfully booked!'); window.location.href = '../dashboards/n.php';</script>";
        } else {
            echo "<script>alert('Error booking the bed. Please try again.'); window.history.back();</script>";
        }
        $stmt_book->close();
    } else {
        echo "<script>alert('This bed is no longer available. Please choose another.'); window.history.back();</script>";
    }

    $stmt_check->close();
} else {
    header("Location: ../students/dashboard.php");
    exit();
}

$conn->close();
?>
