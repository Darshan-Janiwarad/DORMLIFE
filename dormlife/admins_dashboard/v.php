<?php
session_start();
include '../connection/db.php';

// Ensure that the admin is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../admins/admin_login.php"); // Redirect to login page if not logged in
    exit();
}

// Initialize variables
$search_csn_usn = "";
$search_results = "";

// Handle search functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $search_csn_usn = htmlspecialchars($_POST['search_csn_usn']);

    // Fetch students based on the CSN/USN
    $search_query = "SELECT * FROM students_v WHERE csn_usn LIKE ?";
    $stmt = $conn->prepare($search_query);
    $search_value = "%$search_csn_usn%";
    $stmt->bind_param("s", $search_value);
    $stmt->execute();
    $search_results = $stmt->get_result();
} else {
    // Fetch all students from block V
    $query_v = "SELECT * FROM students_v";
    $search_results = $conn->query($query_v);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Block V</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: rgb(193, 192, 214);
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: rgb(49, 48, 68);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            height: 52px;
        }

        .navbar h1 {
            margin: 0;
            font-size: 24px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            font-size: 16px;
        }

        /* Profile Dropdown Menu */
        .dropdown {
            font-size: 1rem;
            border: 0px;
            outline: 0px;
            padding: 10px 12px;
            border-radius: 10px;
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            background-color: rgb(17, 175, 233);
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .dropbtn:hover {
            background-color: rgb(168, 83, 210);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 140px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
        }

        .dropdown-content a {
            color: black;
            padding: 10px 12px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dashboard-container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.64);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .search-box {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-box input[type="text"] {
            width: 300px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-box button {
            padding: 10px 20px;
            margin-left: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-box button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: transparent;
        }

        th,
        td {
            padding: 12px;
            
            text-align: center;
            border:2px solid rgb(102, 116, 125);
            
        }

        th {
            background-color: rgb(5, 56, 87);
            color: #fff;
        }

        td {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 10px 15px;
            background-color: rgb(4, 75, 120);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-d{
            padding: 10px 15px;
            background-color: rgb(224, 48, 48);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-e {
            padding: 10px 15px;
            background-color: rgb(27, 169, 43);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: rgb(28, 53, 74);
        }

        .register-btn {
            margin-bottom: 20px;
            display: inline-block;
            background-color: rgb(201, 58, 33);
        }

        .logout {
            padding: 10px 15px;
            background-color: rgb(169, 31, 31);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .logout:hover {
            background-color: rgb(74, 28, 28);
        }

        .del {
            padding: 10px 15px;
            background-color: rgb(255, 3, 3);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .del:hover {
            background-color: rgb(152, 15, 15);
        }


        .sidebar {
            position: fixed;
            top: 0;
            right: -250px;
            /* Initially hidden */
            width: 250px;
            height: 100%;
            background-color: rgba(44, 62, 80, 0);
            color: white;
            transition: right 0.3s ease;
            z-index: 1000;
        }

        .sidebar .menu-toggle {
            position: fixed;
            top: 10px;
            right: 20px;
            background-color: rgba(52, 152, 219, 0);
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 30px;
            z-index: 1001;
        }



        .sidebar .dropdown-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            top: 75px;
        }

        .sidebar .dropdown-content a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
            background-color: #34495e;
            transition: background-color 0.3s ease;
        }

        .sidebar .dropdown-content a:hover {
            background-color: rgb(5, 137, 219);
        }

        .sidebar .logout {
            background-color: #e74c3c;
        }

        .sidebar .logout:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>Admin Dashboard</h1>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
        <div class="dropdown-content">
            <a href="v_anc.php" class="btn">Send Announcements</a>
            <a href="../admins/viewancv.php" class="btn">View Announcements</a>
            <a href="v_comp.php" class="btn">View Complaints</a>
            <a href="view_room_bookingv.php" class="btn">View Bookings</a>
            <a href="../admins/admin_logout.php" class="logout">Logout</a>
        </div>
    </div>

    <div class="dashboard-container">
        <h2>Welcome <?php echo $_SESSION['admin_name']; ?></h2>

        <!-- Search Box -->
        <div class="search-box">
            <form method="POST" action="">
                <input type="text" name="search_csn_usn" placeholder="Search by CSN/USN" value="<?php echo $search_csn_usn; ?>" required>
                <button type="submit" name="search">Search</button>
            </form>
        </div>

        <a href="../register_student/register_v.php" class="btn">Register Student for Block V</a>
        <h3>List of Students in Block V</h3>

        <?php if ($search_results->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>StudentID</th>
                        <th>Phone_no</th>
                        <th>CSN/USN</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Username</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $search_results->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['StudentID']; ?></td>
                            <td><?php echo $row['Phone_no']; ?></td>
                            <td><?php echo $row['csn_usn']; ?></td>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['Year']; ?></td>
                            <td><?php echo $row['Username']; ?></td>
                            <td><?php echo $row['Department']; ?></td>
                            <td>
                                <a href="../admins/edit_studentv.php?id=<?php echo $row['StudentID']; ?>" class="btn-e">Edit</a>
                                <a href="../admins/delete_studentv.php?id=<?php echo $row['StudentID']; ?>&name=<?php echo urlencode($row['Name']); ?>"
                                    class="btn-d"
                                    onclick="return confirm('Are you sure you want to delete <?php echo addslashes($row['Username']); ?> (ID: <?php echo $row['StudentID']; ?>)?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>

                </tbody>
            </table>
        <?php else: ?>
            <p>No students found for the given CSN/USN.</p>
        <?php endif; ?>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const isVisible = sidebar.style.right === '0px';
            sidebar.style.right = isVisible ? '-250px' : '0px';
        }
    </script>
</body>

</html>
<?php
$conn->close();
?>