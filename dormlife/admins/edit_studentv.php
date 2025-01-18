<?php
require('../connection/db.php');

// Check if a student ID is provided
if (isset($_GET['id'])) {
    $studentID = intval($_GET['id']);

    // Fetch student details
    $sql = "SELECT * FROM students_v WHERE StudentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        die("Student not found.");
    }
    $stmt->close();
} else {
    die("Invalid request.");
}

// Handle form submission for updating student details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $username = htmlspecialchars($_POST['username']);
    $phone_no = htmlspecialchars($_POST['phone_no']);
    $department = htmlspecialchars($_POST['department']);
    $password = $_POST['password'];

    // If the password field is empty, retain the old password
    if (empty($password)) {
        $password = $student['Password'];
    } else {
        // Hash the new password before storing it
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    // Update student details in the database
    $updateSql = "UPDATE students_v 
                  SET Name = ?, 
                      Username = ?, 
                      Phone_no = ?, 
                      Department = ?, 
                      Password = ? 
                  WHERE StudentID = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("sssssi", $name, $username, $phone_no, $department, $password, $studentID);

    if ($stmt->execute()) {
        echo "<script>
                alert('Student details updated successfully.');
                window.location.href = '../admins_dashboard/v.php'; // Redirect to the list of students
              </script>";
    } else {
        echo "<script>
                alert('Error updating student details: " . $stmt->error . "');
              </script>";
    }

    $stmt->close();
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], input[type="password"], select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1>Edit Student Details</h1>

<form action="" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($student['Name']); ?>" required>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?= htmlspecialchars($student['Username']); ?>" required>
    
    <label for="phone_no">Phone Number:</label>
    <input type="text" id="phone_no" name="phone_no" value="<?= htmlspecialchars($student['Phone_no']); ?>" required>

    <label for="department">Department:</label>
    <select id="department" name="department" required>
        <option value="ISE" <?= $student['Department'] == 'ISE' ? 'selected' : ''; ?>>ISE</option>
        <option value="CSE" <?= $student['Department'] == 'CSE' ? 'selected' : ''; ?>>CSE</option>
        <option value="AIML" <?= $student['Department'] == 'AIML' ? 'selected' : ''; ?>>AIML</option>
        <option value="CV" <?= $student['Department'] == 'CV' ? 'selected' : ''; ?>>CV</option>
        <option value="EEE" <?= $student['Department'] == 'EEE' ? 'selected' : ''; ?>>EEE</option>
        <option value="ECE" <?= $student['Department'] == 'ECE' ? 'selected' : ''; ?>>ECE</option>
        <option value="ME" <?= $student['Department'] == 'ME' ? 'selected' : ''; ?>>ME</option>
    </select>

    <label for="password">Password:</label>
    <!-- Pre-fill the password field with the old password -->
    <input type="password" id="password" name="password" value="<?= htmlspecialchars($student['Password']); ?>" placeholder="Enter new password or leave as is">

    <button type="submit">Update Student</button>
</form>

</body>
</html>