<?php
require('../connection/db.php'); // Include database connection

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    // Delete the announcement from the database
    $sql = "DELETE FROM n_announcements WHERE id = $delete_id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Announcement deleted successfully.');
                window.location.href = 'viewancn.php';
              </script>";
    } else {
        echo "<script>
                alert('Error deleting announcement: " . mysqli_error($conn) . "');
              </script>";
    }
}

// Fetch announcements for N-block
$sql = "SELECT * FROM n_announcements ORDER BY posted_at DESC";
$result = mysqli_query($conn, $sql);
$announcements = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $announcements[] = $row;
    }
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Announcements - N Block</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        .delete-btn {
            color: red;
            font-weight: bold;
        }
        .navbar {
            background-color: rgb(49, 48, 68);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            width:139px;
            margin-left: 1300px;
            border-radius: 4px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }
    </style>
</head>
<div class="navbar">
        <a href="../admins_dashboard/n.php" class="btn">Back to Dashboard</a>
    </div>
<body>

<h1>Admin Announcements - N Block</h1>

<?php if (count($announcements) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Announcement</th>
                <th>Posted At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($announcements as $announcement): ?>
                <tr>
                    <td><?= nl2br(htmlspecialchars($announcement['announcement'])); ?></td>
                    <td><?= htmlspecialchars($announcement['posted_at']); ?></td>
                    <td>
                        <a href="?delete_id=<?= $announcement['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this announcement?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No announcements found for N Block.</p>
<?php endif; ?>

</body>
</html>
