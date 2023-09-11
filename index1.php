<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en-Us">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="author" content="Elems-Ikwegbu Promise">
  <meta name="description" content="This is an online exeat system">
  <title>Homepage</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/online-exeat-styles.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
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
    }
  } else {
  ?>
    <div class="vertical-navbar">
      <div class="inner-vertical-navbar">
        <div class="vertical-navbar-exit-area">
          <span class="js-menu-toggle">
            <i class="fa fa-window-close"></i>
          </span>
        </div>
      </div>
      <div class="vertical-navbar-background"></div>
    </div>
    <header class="horizontal-navbar nav-sticky py-4">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-4">
            <h1 class="site-logo">
              <a href="index.php" id="hdt6">
                <img src="Image/babcock.jpeg" style="width: 30px;"><span style="margin-left: 6px;">Babcock</span>
              </a>
            </h1>
          </div>
          <div class="col-8">
            <nav class="navbar-lnks text-right">
              <ul class="menu-items navbar-arrange mr-auto d-lg-block d-none">
                <li><a href="./index.php" class="active">Home</a></li>
                <li><a href="./student/register.php">Student</a></li>
                <li><a href="./hall_admin/register.php">Hall Admin</a></li>
                <li><a href="./HOD/register.php">HOD</a></li>
                <li><a href="./lecturers/register.php">lecturers</a></li>
                <!-- <li><a href="./about.php">About</a></li> -->
              </ul>
            </nav>
            <a href="#" style="display:block; float: right;" class="ham-bar js-menu-toggle d-lg-none">
              <i class="h3">
                <i class="fa fa-navicon"></i>
              </i>
            </a>
          </div>
        </div>
      </div>
    </header>
    <main>
      <article>
        <section class="banner-body">
          <div class="banner-cover" style="background-image: url('image/image_1.jpg');">
            <div class="container">
              <div class="row">
                <div class="col-12 banner-text text-center align-self-center">
                  <div class="row justify-content-center">
                    <div class="col-lg-8">
                      <h1 style="color: #fff;">Welcome to the babcock online exeat system</h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      <?php } ?>
</body>

</html>