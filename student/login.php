<?php
include '../api/student/login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
  <link rel="stylesheet" href="../CSS/index.css">
  <title>Babcock University Clerance portal</title>
</head>

<body>
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
            <input type="text" name="matric_no" required="required">
            <span>Matric Number</span>
          </div>
          <div class="inputBox">
            <input type="password" name="password" required="required">
            <i class="fa-solid fa-lock"></i>
            <span>password</span>
          </div>
          <div class="inputBox">
            <input type="submit" name="submit" value="Login Portal">
          </div>
          <p>Not Yet A member ? <a href="./register.php" class="login"> sign up</a></p>
        </div>
      </form>
      <div class="form signin"></div>

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