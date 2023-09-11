<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Babcock University Online Management Exeat System</title>
    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Line awesome -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="./assets/css/app.css">
</head>

<body>
    <?php
    if (isset($_SESSION['user_id']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'Student') {
            echo "<p>Redirecting...</p>";
            header("Location: http://localhost/promise_project/student/form.php");
        } else if ($_SESSION['role'] === 'Admin') {
            echo "<p>Redirecting...</p>";
            header("Location: http://localhost/promise_project/hall_admin/dashboard/index.php");
        } else if ($_SESSION['role'] === 'HOD') {
            echo "<p>Redirecting...</p>";
            header("Location: http://localhost/promise_project/HOD/dashboard/mail.php");
        } else if ($_SESSION['role'] === 'lecturers') {
            echo "<p>Redirecting...</p>";
            header("Location: http://localhost/promise_project/lecturers/dashboard/mail.php");
        }
    } else {
    ?>
        <!-- Navbar -->
        <div class="navbar">
            <div class="container">
                <a href="#" class="brand"><img src="http://localhost/promise_project/Image/babcock.jpeg" alt="babcock"> Babcock</a>
                <ul class="nav-links">
                    <li class="active"><a href="./index.php">Home</a></li>
                    <li><a href="./student/register.php">Student</a></li>
                    <li><a href="./lecturers/login.php">Lecturers</a></li>
                    <li><a href="./HOD/login.php">HOD</a></li>
                    <li><a href="./hall_admin/login.php">Hall Admin</a></li>
                </ul>
                <div class="hamburger">
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <!-- //Nvbar -->

        <!-- Hero -->
        <div id="hero">
            <div class="container">
                <h1 class="heading-xl"><span id="hero-titles"></span></h1>
                <a href="#services" class="scroll-to-down"><i class="las la-arrow-up"></i></a>
            </div>
        </div>
        <!-- //Hero -->

        <!-- typed js -->
        <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

        <!-- AOS -->

        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script src="./assets/js/app.js"></script>
    <?php } ?>
</body>

</html>