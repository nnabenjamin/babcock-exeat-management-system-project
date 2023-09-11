<?php
include '../api/hall_admin/login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
  <link rel="stylesheet" href="../CSS/index.css">
  <title>Babcock University Admin portal</title>
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
    } else if ($_SESSION['role'] === 'lecturers') {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/lecturers/dashboard/mail.php");
    } else if ($_SESSION['role'] === 'Hod') {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/HOD/dashboard/mail.php");
    }
  } else {
  ?>
    <div class="container">
      <br>
      <a href="../index.php"><img src="../Image/babcock.jpeg" alt=""></a>
      <div class="header">
        <h2>Clerance Portal - Log in</h2>
      </div>
      <?php echo $error_message; ?>
      <br>
      <div class="containerz containerc">
        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">
          <div class="form signup">
            <div class="inputBox">
              <input type="email" name="email" required="required">
              <i class="fa-regular fa-envelope"></i>
              <span>Email</span>
            </div>
            <div class="inputBox">
              <input type="password" name="password" required="required">
              <i class="fa-solid fa-lock"></i>
              <span>password</span>
            </div>
            <div class="inputBox">
              <input type="submit" name="login-btn" value="Login Portal">
            </div>
            <p style="color:red;font-size:13px;">Sign Up Disabled By ICT</p>
          </div>
        </form>
        <div class="form signin"></div>

      </div>
    </div>
    <br>
  <?php } ?>
</body>

</html>