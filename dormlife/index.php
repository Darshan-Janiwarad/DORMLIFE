<?php
session_start();
include 'connection/db.php';

// Check if a student is logged in
if (isset($_SESSION['csn_usn'])) {
    if (isset($_SESSION['student_block'])) {
        $block = $_SESSION['student_block'];
        // Redirect to the respective student's block dashboard
        header("Location: dashboards/$block.php");
    }
}

// Check if an admin is logged in
if (isset($_SESSION['admin_username'])) {
    if (isset($_SESSION['admin_block'])) {
        $block = strtoupper($_SESSION['admin_block']); // Convert block to uppercase for consistency
        // Redirect to the respective admin's block dashboard
        header("Location: admins_dashboard/{$block}.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dorm Life</title>
    <link href="https://fonts.googleapis.com/css2?family=Agu+Display&family=Oleo+Script:wght@400;700&display=swap" rel="stylesheet">
    <!-- Include Font Awesome link in your <head> section -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            color: #333;
            box-sizing: border-box;
            overflow-x: hidden;
        }

        body::-webkit-scrollbar {
            display: none;
        }

        header {
            color: white;
            padding: 10px 20px;
            background-color: #2d3b4c;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header .logo {
            display: flex;
            align-items: center;
        }

        header .logo h1 {
            font-size: 3rem;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            color: #ffcc00;
            /* Golden color */
        }

        nav {
            background: #2d3b4c;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 10px;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .nav-logo {
            margin-right: auto;
        }

        .navbar-logo {
            height: 50px;
            width: auto;
            margin: 5px 15px 5px 5px;
        }

        nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin: 0 15px;
            position: relative;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            padding: 15px 20px;
            display: inline-block;
            font-weight: 700;
            /* Bold text */
            transition: background 0.3s;
        }

        nav ul li a:hover {
            background: rgba(46, 92, 172, 0.96);
            border-radius: 5px;
            border-top: 2px solid whitesmoke;
            border-right: 2px solid grey;

        }

        .hero {
            background: url('uploads/image4.jpg') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
            height: 600px;
            display: flex;
            justify-content: left;
            align-items: center;
            color: white;
            position: relative;
            text-align: left;
            padding-left: 30px;
        }

        .hero h2 {
            font-size: 3rem;
            margin: 0;
            color: #ffcc00;
            /* Golden color for font */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            font-family: 'Poppins', sans-serif;
            animation: fadeIn 2s ease-in-out;
        }

        .hero .main-text {
            position: absolute;
            top: 40%;
            left: 5%;
            transform: translate(0, -50%);
            font-size: 4.5rem;
            font-weight: 700;
            color: #ffcc00;
            /* Golden color for text */
            text-transform: uppercase;
            letter-spacing: 4px;
            font-family: 'Montserrat', sans-serif;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.6);

        }

        .hero .sub-text {
            position: absolute;
            top: 55%;
            left: 5%;
            transform: translate(0, -50%);
            font-size: 2rem;
            font-weight: 370px;
            color: #ffcc66;
            /* Lighter golden shade */
            font-family: sans-serif;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-title {
            text-align: left;
            margin-bottom: 20px;
            font-size: 2.5rem;
            color: #ffcc00;
            /* Golden color */
            font-family: 'Montserrat', sans-serif;
            margin-left: 90vh;
        }

        .hostel-title {
            text-align: left;
            margin-bottom: 20px;
            font-size: 2.5rem;
            color: #ffcc00;
            /* Golden color */
            font-family: 'Montserrat', sans-serif;
            margin-left: 93.1vh;
        }

        .blocks-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .block-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: left;
            padding: 20px;
            transition: transform 0.3s;
        }

        .block-card:hover {
            transform: scale(1.05);
        }

        .block-card img {
            width: 100%;
            height: 200px;
            border-radius: 10px;
            object-fit: cover;

        }

        .block-card h3 {
            margin: 15px 0;
            color: #ffcc00;
            /* Golden color */
            font-family: 'Montserrat', sans-serif;
        }

        .block-details {
            text-align: left;
            margin: 20px auto;
            max-width: 800px;
        }

        footer {
            background: #2d3b4c;
            color: white;
            text-align: center;
            padding: 20px;
        }

        footer p {
            margin: 0px;

        }

        /* New font styles for Dorm Life logo */
        .agu-display-dormlife {
            font-family: "Agu Display", serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
            font-variation-settings: "MORF" 0;
            color: #ffcc00;
            /* Golden color */
        }

        .oleo-script-dormlife {
            font-family: "Oleo Script", serif;
            font-weight: 900;
            font-style: normal;
            color: #ffcc00;
            /* Golden color */
            margin-left: 20px;
        }

        @media (max-width: 768px) {
            .hero h2 {
                font-size: 2rem;
            }

            .blocks-container {
                flex-direction: column;
                align-items: center;
            }

            .block-card {
                width: 110%;
                margin-bottom: 20px;
            }

        }

        p {
            font-family: sans-serif;
            margin-left: 38px;
            margin-right: 38px;
            font-size: 17px;
        }
    </style>
</head>

<body>
    <nav>
        <div class="navbar-container">
            <div class="logo">
                <h3 class="oleo-script-dormlife"><strong>DORM LIFE</strong></h3>
            </div>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#blocks">Hostel Blocks</a></li>
                <li><a href="students/login.php">Sign In</a></li>
            </ul>
        </div>
    </nav>
    <section id="home" class="hero">
        <div class="main-text">
            Dorm Life
        </div>
        <div class="sub-text">
            Connect with Comfort...
        </div>
    </section>
    <section id="about">
        <h2 class="section-title">About the Hostel</h2>
        <p>The hostels of B.V.V Sangha are managed by a committee set up by the Sangha in the name of Student Welfare and hostel Committee (SWC) consisting of 12 members. This committee is headed by Shri. Kumar Hiremath, Chairman and the other members are Shri. Virupakshappa S. Koti, Shri Chandrashekar B. Badali, Shri Vishwanath V. Palled, Shri Shashidhar V. Goudar, Shri Kumar S. Jigalur, Shri Sangamesh M. Guddad, Shri Basavaraj C. Kengapur, Shri Channayya P. Balulmath, Shri Prabhu B. Nara, Shri Anand S. Sasanur and Shri Manohar M. Navalagi.</p>
        <br>
        <p>Basaveshwar Engineering College hostels are managed by Chief Warden and supported by Deputy chief wardens and Wardens. Dr. B. R. Hiremath, Principal is the Chief Warden, Dr. P. L. Timmanagoudar, Dr. C. M. Veerendrakumar are Deputy chief wardens and other wardens are Shri B. R. Endigeri, Shri. B. M. Vyas, Dr. Mahabaleshwar S. K., Dr. A. V. Sutagundar, Shri Vivekanand B. S., Dr. Shobha Patil, Smt. Sunita Tambakad and Smt. Sudha S. K.</p>
    </section>
    <section id="blocks">
        <h2 class="hostel-title">Hostel Blocks</h2>
        <div class="blocks-container">
            <div class="block-card" onclick="showBlockDetails('N')">
                <img src="uploads/image1.jpg" alt="N Block">
                <h3>N Block</h3>
            </div>
            <div class="block-card" onclick="showBlockDetails('V')">
                <img src="uploads/image2.jpg" alt="V Block">
                <h3>V Block</h3>
            </div>
            <div class="block-card" onclick="showBlockDetails('G')">
                <img src="uploads/image3.jpg" alt="G Block">
                <h3>G Block</h3>
            </div>
        </div>
        <div id="block-details" class="block-details"></div>
    </section>
    
        <p>&copy; 2025 Dorm Life. All rights reserved.</p>
        <p>
            <i class="fas fa-map-marker-alt"></i> Location: Bagalkote,Karnataka
        </p>
    

    <script>
        function showBlockDetails(block) {
            const blockDetails = document.getElementById('block-details');
            let content = '';

            switch (block) {
                case 'N':
                    content =
                        `<h3>N Block</h3>
                        <p>Netaji Block	Boys Hostel (First year students).</p>`;
                    break;
                case 'V':
                    content =
                        `<h3>V Block</h3>
                        <p>Sir M. Visvesavaraya Block	Boys Hostel (Senior students).</p>`;
                    break;
                case 'G':
                    content =
                        `<h3>G Block</h3>
                        <p>Malaprabha hostel	Girls.</p>`;
                    break;
                default:
            }

            blockDetails.innerHTML = content;
            blockDetails.scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>
</body>

</html>