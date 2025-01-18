<?php
session_start();
require('../connection/db.php');

// Check if the user is logged in
if (!isset($_SESSION['csn_usn'])) {
    header("Location: ../students/login.php");
    exit();
}

// Assume user ID is stored in session
$csn_usn = $_SESSION['csn_usn'];

// Fetch user-specific announcements
$user_announcements = [];
if ($stmt = $conn->prepare("SELECT * FROM g_announcements WHERE recipient = ? ORDER BY posted_at DESC")) {
    $stmt->bind_param("s", $csn_usn);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $user_announcements[] = $row;
    }
    $stmt->close();
}

// Fetch general announcements
$general_announcements = [];
if ($stmt = $conn->prepare("SELECT * FROM g_announcements WHERE recipient = 'all' ORDER BY posted_at DESC")) {
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $general_announcements[] = $row;
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
    <title>Notifications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }
        h1, h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        td {
            background-color: #ffffff;
        }
        .message {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #e9ecef;
            color: #495057;
        }
    </style>
</head>
<body>

<h1>Admin Announcements</h1>

<!-- User-Specific Announcements -->
<h2>Your Announcements</h2>
<?php if (!empty($user_announcements)): ?>
    <table>
        <thead>
            <tr>
                <th>Announcement</th>
                <th>Posted At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user_announcements as $announcement): ?>
                <tr>
                    <td><?= nl2br(htmlspecialchars($announcement['announcement'])); ?></td>
                    <td><?= htmlspecialchars($announcement['posted_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="message">No specific announcements for you.</div>
<?php endif; ?>

<!-- General Announcements -->
<h2>General Announcements</h2>
<?php if (!empty($general_announcements)): ?>
    <table>
        <thead>
            <tr>
                <th>Announcement</th>
                <th>Posted At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($general_announcements as $announcement): ?>
                <tr>
                    <td><?= nl2br(htmlspecialchars($announcement['announcement'])); ?></td>
                    <td><?= htmlspecialchars($announcement['posted_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="message">No general announcements available.</div>
<?php endif; ?>

</body>
</html>
