<?php
session_start();
include '../connection/db.php';

// Check if the user is logged in
if (!isset($_SESSION['student_username']) || $_SESSION['student_block'] !== 'V') {
    header("Location: ../students/login.php");
    exit();
}

if (!isset($_SESSION['student_department'])) {
    $stmt = $conn->prepare("SELECT department FROM students_v WHERE username = ?");
    $stmt->bind_param("s", $_SESSION['student_username']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $student = $result->fetch_assoc();
        $_SESSION['student_department'] = $student['department'];
    } else {
        $_SESSION['student_department'] = "Unknown";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>V Block Hostel - Student Dashboard</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2c3e50;
            color: white;
            padding: 15px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar h1 {
            font-size: 28px;
            font-weight: bold;
            color: #ecf0f1;
            margin: 0;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .navbar ul li {
            margin: 0 15px;
        }

        .navbar ul li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 18px;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar ul li a:hover {
            background-color: #3498db;
            color: white;
            transform: scale(1.1);
        }

        .navbar .toggle {
            display: none;
            font-size: 28px;
            cursor: pointer;
            color: #ecf0f1;
        }

        .content {
            max-width: 900px;
            margin: 80px auto 50px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        .content h2 {
            font-size: 32px;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 20px;
            color: #555;
            line-height: 1.8;
        }

        .about-section {
            display: none;
            text-align: left;
            padding: 20px;
            margin: 20px 0;
            background: #ecf0f1;
            border: 1px solid #ddd;
            border-radius: 8px;
            animation: slideDown 0.6s ease-in-out;
        }

        .about-section.show {
            display: block;
            animation: fadeIn 0.6s ease-in-out;
        }

        .dropdown {
            margin-top: 20px;
            padding: 10px;
            background-color: #ecf0f1;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dropdown select {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .dropdown button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dropdown button:hover {
            background-color: #2980b9;
        }

        .logout-btn {
            display: inline-block;
            padding: 12px 20px;
            background-color: #e74c3c;
            color: white;
            font-size: 18px;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar ul {
                display: none;
                flex-direction: column;
                background-color: #2c3e50;
                position: absolute;
                top: 70px;
                right: 0;
                width: 100%;
            }

            .navbar ul.active {
                display: flex;
            }

            .navbar .toggle {
                display: block;
            }
        }

        @media (min-width: 769px) {
            .navbar .toggle {
                display: none;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                max-height: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                max-height: 100vh;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>V Block Hostel</h1>
        <span class="toggle" onclick="toggleMenu()">☰</span>
        <ul>
            <li><a href="javascript:void(0)" onclick="toggleAbout()">About</a></li>
            <li><a href="../complaints/vcomplaints.php">Raise an Issue</a></li>
            <li><a href="vcomp.php">Notifications</a></li>
            <li><a href="../students/logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h2>Welcome <strong><?= htmlspecialchars($_SESSION['student_username']); ?></strong> (<?= htmlspecialchars($_SESSION['student_department']); ?>)</h2>
        <p>
            Discover a safe and vibrant living space at the V Block Hostel. Designed for both comfort and convenience,
            our hostel offers the ideal environment for students.
        </p>
        <p>
            Located close to key academic buildings, V Block provides state-of-the-art facilities, excellent dining
            options, and a thriving student community.
        </p>

        <!-- About Section -->
        <div id="about-section" class="about-section">
            <h3>Sir M. Visvesavaraya Block</h3>
            <p>
                The Visvesavaraya hostel was started in the year 1968 to accommodate boys of Basaveshwar Engineering College Bagalkot. The hostel has grown many folds and is equipped with all facilities since from its inception. The total number of rooms in the hostel is 128 with a total capacity of 384.
            </p>
        </div>

        <!-- Department Dropdown -->
        <div class="dropdown">
            <form action="../book_bed_v/search_rooms.php" method="POST">
                <select id="department-dropdown" name="department" required>
                    <option value="">Select Department</option>
                    <option value="1">ISE</option>
                    <option value="2">CSE</option>
                    <option value="3">AIML</option>
                    <option value="4">EEE</option>
                    <option value="5">ECE</option>
                    <option value="6">IP</option>
                    <option value="7">BT</option>
                    <option value="8">ME</option>
                    <option value="9">CV</option>
                </select>
                <button type="submit">Search Rooms</button>
            </form>
        </div>

    </div>

    <script>
        // Toggle About section visibility
        function toggleAbout() {
            var aboutSection = document.getElementById("about-section");
            aboutSection.classList.toggle("show");
        }

        // Toggle Navbar for mobile
        function toggleMenu() {
            var navbar = document.querySelector('.navbar ul');
            navbar.classList.toggle('active');
        }
    </script>
</body>

</html>