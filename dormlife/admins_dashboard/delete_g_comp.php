<?php
session_start();
include '../connection/db.php';

// Ensure that the admin is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../admins/admin_login.php"); // Redirect to login page if not logged in
    exit();
}

// Check if the complaint ID is set in the URL
if (isset($_GET['id'])) {
    $complaint_id = intval($_GET['id']); // Ensure the ID is an integer

    // Prepare the delete query
    $delete_query = "DELETE FROM gblock_complaints WHERE complaint_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $complaint_id);

    if ($stmt->execute()) {
        // Redirect back to the complaints list with a success message
        header("Location: g_comp.php?message=Complaint deleted successfully");
        exit();
    } else {
        // Redirect back with an error message
        header("Location: g_comp.php?error=Failed to delete complaint");
        exit();
    }
} else {
    // Redirect back if no ID is provided
    header("Location: g_comp.php?error=No complaint ID specified");
    exit();
}
?>