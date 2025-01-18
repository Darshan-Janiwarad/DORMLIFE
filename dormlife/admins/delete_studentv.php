<?php
session_start();
include '../connection/db.php';

// Ensure that the admin is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../admins/admin_login.php"); // Redirect to login page if not logged in
    exit();
}

// Get the student ID from the URL parameter
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Start a transaction to ensure both queries execute together
    $conn->begin_transaction();

    try {
        // Retrieve the student's name from the students_v table
        $get_student_query = "SELECT Username FROM students_v WHERE StudentID = ?";
        $stmt = $conn->prepare($get_student_query);
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $student_name = $row['Username'];


            $update_booking_query = "UPDATE vblock_beds SET is_booked = 0, student_name = NULL WHERE student_name = ?";
            $stmt = $conn->prepare($update_booking_query);

            if ($stmt === false) {
                die("Error in prepare statement: " . $conn->error);
            }

            // Bind the parameter (student_name) to the query
            $stmt->bind_param("s", $student_name);

            // Execute the statement and check for success
            if ($stmt->execute()) {
                echo "<script>alert('Updated beds successfully');</script>";
            } else {
                echo "Error updating beds: " . $stmt->error;
            }

            // Delete the student record from the students_v table
            $delete_student_query = "DELETE FROM students_v WHERE StudentID = ?";
            $stmt = $conn->prepare($delete_student_query);
            $stmt->bind_param("i", $student_id);
            if ($stmt->execute()) {
                echo "<script>alert('Deleted student successfuly');</script>";
            }

            // Commit the transaction
            // Update the room booking in the vblock_beds table

            $conn->commit();

            // Redirect to the admin page after successful deletion
            header("Location: ../admins_dashboard/v.php"); // Modify this to redirect to the appropriate page
            exit();
        } else {
            // If the student is not found
            echo "Student not found.";
        }
    } catch (Exception $e) {
        // If an error occurs, roll back the transaction
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Student ID not provided.";
}

$conn->close();