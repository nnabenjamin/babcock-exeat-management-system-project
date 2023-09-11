<?php
include '../api/student/form.php';
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
  <title>Babcock University Student | Form page</title>
</head>

<body>
  <div class="container">
    <br>
    <a href="../index.php"><img src="../Image/babcock.jpeg" alt=""></a>
    <div class="header">
      <h2>Student Travel Information
      </h2>
    </div>
    <?php echo $error_message;  ?>
    <div class="containerz" style="background: #223243;">
      <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">
        <div class="form signup">
          <div class="inputBox">
            <input type="text" name="state" required="required">
            <i class="fa-solid fa-location-dot"></i>
            <span>State</span>
          </div>
          <div class="inputBox">
            <input type="text" name="city" required="required">
            <i class="fa-solid fa-location-dot"></i>
            <span>City</span>
          </div>
          <div class="inputBox">
            <input type="text" name="doe" required="required" value="<?php echo Date("d-m-Y") ?>">
            <i class="fa-solid fa-calendar-days"></i>
            <span>Date of exit</span>
          </div>
          <div class="inputBox">
            <input type="text" name="dor" required="required">
            <i class="fa-solid fa-calendar-days"></i>
            <span>Date of return</span>
          </div>
          <div class="inputBox">
            <input type="text" name="toe" value="<?php echo Date("H:i:s a") ?>" required="required">
            <i class="fa-regular fa-clock"></i>
            <span>Time of exit</span>
          </div>
          <div class="inputBox">
            <input type="text" name="tor" required="required">
            <i class="fa-regular fa-clock"></i>
            <span>Time of return</span>
          </div>
          <div class="inputBox">
            <input type="text" name="gn" required="required">
            <i class="fa-solid fa-calendar-days"></i>
            <span>Guardians name</span>
          </div>
          <div class="inputBox">
            <input type="number" name="gpn" required="required">
            <i class="fa-solid fa-phone"></i>
            <span>Guardians Phone</span>
          </div>
          <div class="inputBox">
            <input type="text" name="reason_l" required="required">
            <i class="fa-solid fa-comment"></i>
            <span>Reason For The Clerance</span>
          </div>
          <div class="inputBox">
            <input type="submit" name="signup-btn" value="Submit Form">
          </div>
          <p>Not interested anymore ? <a href="../api/logout.php" class="login"> Log out</a></p>
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