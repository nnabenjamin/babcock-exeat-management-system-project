<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../CSS/main.css">
  <link rel="stylesheet" href="../CSS/navbar.css">
  <title>Admin | Login page</title>
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
    <ul>
      <li><a href="../index.php" class="active">Home</a></li>
      <li><a href="../student/register.php">Student</a></li>
      <li><a href="../hall_admin/register.php">Hall Admin</a></li>
    </ul>
    <div class="container" id="slice">
      <div class="row">
        <div class="col-md-4 offset-md-4 form-wrapper">
          <h3 class="text-center form-title">Admin Login</h3>
          <form action="form.php">
            <div class="form-group">
              <label>Email</label>
              <input type="email" id="login_email" name="email" required class="form-control form-control-lg">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" id="login_password" name="password" required class="form-control form-control-lg">
            </div>
            <div class="form-group">
              <button type="submit" id="login_btn" name="login-btn" class="btn btn-lg btn-block">
                <img id="spinner" src="../Image/spinner.png" alt="">
                <span id="login_txts">Login</span>
              </button>
            </div>
            <p>Don't have an account? <a href="../hall_admin/register.php">Signup</a></p>
          </form>
        </div>
      </div>

      <!-- The Modal -->
      <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
          <div class="modal-header" id="m_head">
            <span class="close">&times;</span>
            <h2 id="head_txt">Modal Header</h2>
          </div>
          <div class="modal-body" id="box_txt"></div>
          <div class="modal-footer" id="m_foot"></div>
        </div>
      </div>

      <script src="../JS/utility.js"></script>
      <script src="../JS/hall_admin/login.js"></script>
    <?php } ?>
</body>

</html>