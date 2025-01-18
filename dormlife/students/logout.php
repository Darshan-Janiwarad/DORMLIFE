<?php
session_start();

// Destroy the session to log out the student
session_unset();
session_destroy();

// Redirect to the student login page
header("Location: ../students/login.php");
exit();
?>
