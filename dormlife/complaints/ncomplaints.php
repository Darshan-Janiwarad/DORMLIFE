<?php
session_start();
include '../connection/db.php';

// Check if the user is logged in and belongs to block V
if (!isset($_SESSION['student_username']) || $_SESSION['student_block'] !== 'N') {
    header("Location: ../students/login.php");
    exit();
}

// Initialize variables for messages
$success_message = $error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_username = $_SESSION['student_username'];
    $student_name = $_SESSION['student_name'];
    $branch = $_SESSION['student_department'];
    $complaint_text = trim($_POST['complaint_text']);

    if (empty($complaint_text)) {
        $error_message = "Complaint cannot be empty.";
    } else {
        // Insert complaint into the database
        $sql = "INSERT INTO nblock_complaints (student_username, student_name, branch, complaint_text) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $student_username, $student_name, $branch, $complaint_text);

        if ($stmt->execute()) {
            $success_message = "Complaint submitted successfully.";
            header("Location: ../dashboards/n.php");
        } else {
            $error_message = "Failed to submit the complaint. Please try again.";
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Complaint</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F4F7FC;
            margin: 0;
            padding: 20px;
        }

        .complaint-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
        }

        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        .message {
            text-align: center;
            margin-top: 10px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="complaint-container">
    <h2>Submit Your Complaint</h2>

    <?php if (!empty($success_message)) { ?>
        <p class="message success"><?php echo $success_message; ?></p>
    <?php } elseif (!empty($error_message)) { ?>
        <p class="message error"><?php echo $error_message; ?></p>
    <?php } ?>

    <form action="vcomplaints.php" method="POST">
        <textarea name="complaint_text" placeholder="Enter your complaint here..." required></textarea>
        <button type="submit">Submit Complaint</button>
    </form>
</div>

</body>
</html>
