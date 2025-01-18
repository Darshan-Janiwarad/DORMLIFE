<?php
session_start();

// Destroy all session data
session_unset(); 

// Destroy the session itself
session_destroy();

// Redirect to the login page
header("Location: ../students/login.php");
exit();
?>
