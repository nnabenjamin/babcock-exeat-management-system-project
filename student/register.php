<?php
include '../api/student/register.php';
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
  <title>Babcock University Clerance portal</title>
</head>

<body>
  <div class="container">
    <br>
    <a href="../index.php"><img src="../Image/babcock.jpeg" alt=""></a>
    <div class="header">
      <h2>Clerance Portal - Sign Up</h2>
    </div>
    <?php echo $error_message; ?>
    <div class="containerz">
      <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">
        <div class="form signup">
          <div class="inputBox">
            <input type="text" name="student_name" required="required">
            <i class="fa-regular fa-user"></i>
            <span>Full Name</span>
          </div>
          <div class="inputBox">
            <input type="text" name="matric_number" required="required">
            <span>Matric Number</span>
          </div>
          <div class="inputBox">
            <input type="number" name="phone_number" required="required">
            <i class="fa-solid fa-phone"></i>
            <span>Phone Number</span>
          </div>
          <div class="inputBox">
            <input type="email" name="Email" required="required">
            <i class="fa-regular fa-envelope"></i>
            <span>Email</span>
          </div>
          <div class="inputBox">
            <input type="text" name="home_address" required="required">
            <i class="fa-solid fa-house"></i>
            <span>Home Address</span>
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
  <br>
  <script>
    let err_m = document.querySelector(".err_m");
    setTimeout(() => {
      err_m.innerHTML = "";
    }, 3000);
  </script>
</body>

</html>