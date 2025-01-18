<?php
session_start();
include '../connection/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escape special characters to prevent SQL injection
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $block = strtoupper($conn->real_escape_string($_POST['block']));

    // Default error message
    $error_message = "Invalid username or password!";

    // Check if block selection is valid
    if (in_array($block, ['V', 'G', 'N'])) {
        // Prepare query based on selected block
        $query = "SELECT * FROM students_$block WHERE Username = '$username'";

        // Execute query and handle results
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify password (make sure it's hashed in the database)
            if (password_verify($password, $user['Password'])) {
                // Set session variables
                $_SESSION['csn_usn'] = $user['csn_usn'];
                $_SESSION['student_username'] = $username;
                $_SESSION['student_block'] = $block;
                $_SESSION['student_name'] = $user['Name'];
                $_SESSION['student_department'] = $user['Department'];

                // Redirect to block-specific dashboard
                if ($block === 'V') {
                    header("Location: ../dashboards/v.php");
                } elseif ($block === 'G') {
                    header("Location: ../dashboards/g.php");
                } elseif ($block === 'N') {
                    header("Location: ../dashboards/n.php");
                }
                exit();
            } else {
                $error_message = "Incorrect password!";
            }
        } else {
            $error_message = "No user found with this username!";
        }
    } else {
        $error_message = "Invalid block selection!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Body Styling */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            /*background-image: url('../image5.jpg');  Replace with your image path */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            color: #2C3E50;
        }

        .login-container {
            position: relative;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
            color: #2980B9;
            font-weight: 700;
            text-transform: uppercase;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            color: #34495E;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input{
            width: 90%;
            padding: 14px;
            font-size: 16px;
            border: 2px solid #BDC3C7;
            border-radius: 10px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }
        .form-group-select select{
            width: 98%;
            padding: 14px;
            font-size: 16px;
            border: 2px solid #BDC3C7;
            border-radius: 10px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #2980B9;
            outline: none;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(41, 128, 185, 0.5);
        }

        .error-message {
            color: #e74c3c;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }

        button {
            width: 280px;
            padding: 16px;
            margin:12px;
            margin-left: 55px;
            background-color: #2980B9;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        button:hover {
            background-color: #1F618D;
            transform: translateY(-5px);
        }

        .login-container p {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-top: 20px;
        }

        .login-container p a {
            color: #2980B9;
            text-decoration: none;
            font-weight: bold;
        }

        .login-container p a:hover {
            text-decoration: underline;
        }

        @media (max-width: 500px) {
            .login-container {
                padding: 30px;
                width: 90%;
            }

            h2 {
                font-size: 26px;
            }

            button {
                padding: 14px;
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Student Login</h2>

        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group-select">
                <label for="block">Block</label>
                <select id="block" name="block" required>
                    <option value="">Select block</option>
                    <option value="V">V</option>
                    <option value="G">G</option>
                    <option value="N">N</option>
                </select>
            </div>

            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?= $error_message; ?></p>
            <?php endif; ?>

            <button type="submit">Login</button>
        </form>

        <p>Admin? <a href="../admins/admin_login.php">Sign-in Admin</a></p>
    </div>

</body>

</html>