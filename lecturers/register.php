<?php
include '../api/lecturers/register.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />

  <link rel="stylesheet" href="../CSS/index.css">
  <title>Babcock University Clerance Approval</title>
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
    } else if ($_SESSION['role'] === 'Hod') {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/HOD/dashboard/mail.php");
    } else if ($_SESSION['role'] === 'lecturers') {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/lecturers/dashboard/mail.php");
    }
  } else {
    echo '<div class="container">
      <br>
      <a href="../index.php"><img src="../Image/babcock.jpeg" alt=""></a>
      <div class="header">
        <h2>Clerance Lecturer Portal - Sign Up</h2>
      </div>
      <?php echo $error_message; ?>
      <div class="containerz">
        <form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">
          <div class="form signup">
            <div class="inputBox">
              <input type="text" name="name" required="required">
              <i class="fa-regular fa-user"></i>
              <span>HOD Name</span>
            </div>
            <div class="inputBox">
              <input type="number" name="phone_number" required="required">
              <i class="fa-solid fa-phone"></i>
              <span>Phone Number</span>
            </div>
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
              <input type="password" name="passwordconf" required="required">
              <i class="fa-solid fa-lock"></i>
              <span>confirm password</span>
            </div>
            <div class="inputBox">
              <input type="submit" name="signup_btn" value="Create Form">
            </div>
            <p>Already A member ? <a href="./login.php" class="login"> Log in</a></p>
          </div>
        </form>
      </div>
    </div>
    <br>';
  } ?>
  <script>
    let err_m = document.querySelector(".err_m");
    setTimeout(() => {
      err_m.innerHTML = "";
    }, 3000);
  </script>
</body>

</html>