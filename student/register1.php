<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student | Register page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../CSS/main.css">
  <link rel="stylesheet" href="../CSS/navbar.css">
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
    <h3 class="text-center form-title">Student Register</h3>
    <div class="container" id="slice">
      <div class="row" id="center">
        <div class="col-lg-6 form-wrapper">
          <form>
            <div class="container" id="slice">
              <div class="row" id="ffvat5">
                <div class="col-lg-6 form-wrapper">
                  <div class="form-group">
                    <label>Matric number</label>
                    <input type="text" id="signup_matric_no" name="matric-number" required class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" id="signup_password" name="password" required class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" id="signup_password_conf" name="passwordconf" required class="form-control form-control-lg">
                  </div>
                </div>
                <div class="col-lg-6 form-wrapper">
                  <div class="form-group">
                    <label>Student Name</label>
                    <input type="text" id="signup_name" name="student-name" required class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="number" id="signup_phone_number" name="phone-number" required class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="signup_email" name="Email" required class="form-control form-control-lg">
                  </div>
                </div>
                <div class="col-lg-12 form-group">
                  <div class="form-group">
                    <label>Home Address</label>
                    <input type="text" id="signup_address" name="home-address" required class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <button type="submit" id="signup_btn" name="signup-btn" class="btn btn-lg btn-block">
                      <img id="spinner" src="../Image/spinner.png" alt="">
                      <span id="login_txts">Sign Up</span>
                    </button>
                  </div>
                </div>
                <div class="col-lg-12 form-group">
                  <p>Already have an account? <a href="../student/login.php">Login</a></p>
                </div>
              </div>
            </div>
          </form>
        </div>
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
    <script src="../JS/student/register.js"></script>
  <?php } ?>
</body>

</html>