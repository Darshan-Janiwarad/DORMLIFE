<?php
session_start();
include '../connection/db.php';

// Ensure that the admin is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../admins/admin_login.php"); // Redirect to login page if not logged in
    exit();
}

$error_message = ""; // Initialize error message variable
$success_message = ""; // Initialize success message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and fetch input values
    $name = htmlspecialchars($_POST['name']);
    $phone_no = htmlspecialchars($_POST['phone_no']);
    $department = htmlspecialchars($_POST['department']);
    $year = htmlspecialchars($_POST['year']);
    $address = htmlspecialchars($_POST['address']);
    $csn_usn = htmlspecialchars($_POST['csn_usn']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']); // Plain text password to hash
    $registered_by = $_SESSION['admin_username']; // Admin who created the student

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if the username already exists
    $check_query = "SELECT * FROM students_n WHERE Username=?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $username_exists = $result->num_rows > 0;

    // Check if the CSN/USN already exists
    $check_query1 = "SELECT * FROM students_n WHERE csn_usn=?";
    $stmt1 = $conn->prepare($check_query1);
    $stmt1->bind_param("s", $csn_usn);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $csn_usn_exists = $result1->num_rows > 0;

    // Handle conflicts
    if ($username_exists) {
        $error_message = "Username already exists. Please choose another.";
    } elseif ($csn_usn_exists) {
        $error_message = "CSN/USN already exists. Please choose another.";
    } else {
        // Prepare the INSERT query using prepared statements
        $insert_query = "INSERT INTO students_n (Name, Phone_no, Department, Year, Address, csn_usn, Username, Password, RegisteredBy) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("sisssssss", $name, $phone_no, $department, $year, $address, $csn_usn, $username, $hashed_password, $registered_by);

        if ($stmt->execute()) {
            // Set success message
            $success_message = "Student registered successfully.";
            header("Location: ../admins_dashboard/n.php");
            exit();
        } else {
            $error_message = "Error: " . $stmt->error;
        }
    }

    // Close statements
    $stmt->close();
    $stmt1->close();
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student for Block N</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
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
        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }
        input[type="text"], input[type="password"], input[type="number"], textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Register Student for Block N</h2>

        <!-- Display error or success message -->
        <?php if ($error_message): ?>
            <p class="error-message"><?= $error_message; ?></p>
        <?php endif; ?>
        <?php if ($success_message): ?>
            <p class="success-message"><?= $success_message; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="phone_no">Phone Number</label>
            <input type="text" id="phone_no" name="phone_no" required>

            <label for="department">Department</label>
            <select id="department" name="department" required>
                <option value="">Select Department</option>
                <option value="ISE">ISE</option>
                <option value="CSE">CSE</option>
                <option value="AIML">AIML</option>
                <option value="CV">CV</option>
                <option value="EEE">EEE</option>
                <option value="ECE">ECE</option>
                <option value="ME">ME</option>
            </select>

            <label for="year">Year</label>
            <select id="year" name="year" required>
                <option value="">Select Year</option>
                <option value="1">1st Year</option>
                <option value="2">2nd Year</option>
                <option value="3">3rd Year</option>
                <option value="4">4th Year</option>
            </select>

            <label for="address">Address</label>
            <textarea id="address" name="address" required></textarea>

            <label for="csn_usn">CSN/USN</label>
            <input type="text" id="csn_usn" name="csn_usn" required>
            

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Register Student</button>
        </form>
    </div>

</body>
</html>
