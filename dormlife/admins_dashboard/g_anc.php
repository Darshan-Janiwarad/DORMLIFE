<?php
require('../connection/db.php');

// Default styles
$style = "";

// Handle form submission to save announcement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['announcement'])) {
    $announcement = mysqli_real_escape_string($conn, $_POST['announcement']);
    $recipient = $_POST['recipient']; // Get recipient input

    // Insert announcement into the database
    $sql = "INSERT INTO g_announcements (announcement, recipient) VALUES ('$announcement', '$recipient')";
    
    if (mysqli_query($conn, $sql)) {
        // Redirect to g.php with a success message using a JavaScript alert
        echo "<script>
                alert('Announcement posted successfully.');
                window.location.href = 'g.php';
              </script>";
    } else {
        // Redirect to g.php with an error message using a JavaScript alert
        echo "<script>
                alert('Error: " . mysqli_error($conn) . "');
                window.location.href = 'g.php';
              </script>";
    }
}

// Close database connection
mysqli_close($conn);
?>

<?php
require('../connection/db.php');

// Default styles
$style = "";

// Handle form submission to save announcement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['announcement'])) {
    $announcement = mysqli_real_escape_string($conn, $_POST['announcement']);
    $recipient = $_POST['recipient']; // Get recipient input

    // Insert announcement into the database
    $sql = "INSERT INTO n_announcements (announcement, recipient) VALUES ('$announcement', '$recipient')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to n.php with a success message using a JavaScript alert
        echo "<script>
                alert('Announcement posted successfully.');
                window.location.href = 'n.php';
              </script>";
    } else {
        // Redirect to n.php with an error message using a JavaScript alert
        echo "<script>
                alert('Error: " . mysqli_error($conn) . "');
                window.location.href = 'n.php';
              </script>";
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
    <title>Admin Announcements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: rgb(193, 192, 214)
        }

        textarea {
            width: 50%;
            height: 140px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-left: 45px;
            
        }

        select,
        input,
        button {
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
        h1{
            text-align: center;
        }
        form{
            text-align: center;
        }
        select{
            border-radius: 3px;
        }
        .USN{
            border-radius: 4px solid black;
            
        }
    </style>
</head>

<body>

    <h1>Admin Announcement</h1>

    <!-- Announcement form -->
    <form action="" method="POST">
        
        <textarea id="announcement" name="announcement" rows="4" cols="50" required></textarea><br><br>

        <label for="recipient">Send To:</label><br>
        <select id="recipient" name="recipient" required>
            <option value="all">All Students</option>
            <option value="specific">Specific Student</option>
        </select><br>

        <!-- Input for specific user ID -->
        <div id="specific-user" style="display: none;" class="USN">
            <label for="csn_csn">Enter Student CSN/USN:</label><br>
            <input type="text" id="csn_usn" name="csn_usn" placeholder="Enter Student CSN/USN"><br>
        </div>

        <button type="submit">Post Announcement</button>
    </form>

    <script>
        // JavaScript to toggle user ID input visibility
        document.getElementById('recipient').addEventListener('change', function() {
            const specificUserDiv = document.getElementById('specific-user');
            if (this.value === 'specific') {
                specificUserDiv.style.display = 'block';
                document.getElementById('csn_usn').setAttribute('name', 'recipient');
            } else {
                specificUserDiv.style.display = 'none';
                document.getElementById('csn_usn').setAttribute('name', '');
            }
        });
    </script>

</body>

</html>