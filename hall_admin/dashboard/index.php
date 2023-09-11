<?php
include "../dashboard/api/index.php";
include "../dashboard/api/db_conn.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/fontawesome-free-6.1.1-web/fontawesome-free-6.1.1-web/css/all.css" />
  <!--=============== BOXICONS ===============-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

  <!--=============== CSS ===============-->
  <link rel="stylesheet" href="./assets/css/modal.css">
  <link rel="stylesheet" href="../dashboard/css/index1.css">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <?php
    include "../dashboard/requirement/nav.php";
    ?>
    <section class="main">
      <div class="main-top">
        <h1>Hall Admin</h1>
        <i class="fas fa-bars bp"></i>
        <i class="fas fa-xmark bp"></i>
      </div>
      <div class="main-skills">
        <div class="card">
          <i class="fas fa-inbox"></i>
          <h3>Inbox</h3>
          <p>incoming messages</p>
          <a style="background: none;" href="http://localhost/promise_project/hall_admin/dashboard/mail.php"><button>Inbox</button></a>
        </div>
        <div class="card">
          <i style="color: green;" class="fas fa-check"></i>
          <h3>Approved</h3>
          <p>List of approved clerance</p>
          <a style="background: none;" href="http://localhost/promise_project/hall_admin/dashboard/approved.php"><button>approved list</button></a>
        </div>
        <div class="card">
          <i style="color: red;" class="fas fa-ban"></i>
          <h3>Declined</h3>
          <p>List of Declined clerance</p>
          <a style="background: none;" href="http://localhost/promise_project/hall_admin/dashboard/declined.php"><button>Declined list</button></a>
        </div>
      </div>
      <section class="main-course">
        <h1>Latest Messages</h1>
        <div class="course-box">
          <ul>
            <li id="cb" class="active">inbox</li>
            <li id="cb1">approved</li>
            <li id="cb2">declinde</li>
          </ul>
          <div id="sc" class="course">
            <?php
            $stmt = "SELECT * FROM `account_details` INNER JOIN `gate_pass_request` ON `account_details`.`id` = `gate_pass_request`.`user_id` WHERE approved = ''  LIMIT 3";
            $result = mysqli_query($conn, $stmt);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="box">
              <h3>' . $row["name"] . '</h3>
              <p>' . $row["reason_l"] . '</p>
              <a href="read.php?q=' . $row["user_id"] . '"><button>Read</button></a>
              <i class="fa-solid fa-user html"></i>
            </div>';
              }
            } else {
              echo '<img style="width: 130px; margin-right:5px;" src="../dashboard/images/no_data.png" alt=""> <br /> <p>no new messages</p>';
            }
            ?>
          </div>
          <div id="sc1" class="course">
            <?php
            $stmt = "SELECT * FROM `account_details` INNER JOIN `gate_pass_request` ON `account_details`.`id` = `gate_pass_request`.`user_id` WHERE approved = 'true'  LIMIT 3";
            $result = mysqli_query($conn, $stmt);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="box">
              <h3>' . $row["name"] . '</h3>
              <p style="font-weight: bolder;font-size:15px;">Approved <img src="./images/tickpng.png" alt="tickpng">
              <i class="fa-solid fa-user html"></i>
            </div>';
              }
            } else {
              echo '<img style="width: 130px; margin-right:5px;" src="../dashboard/images/no_data.png" alt=""> <br /> <p>no new messages</p>';
            }
            ?>
          </div>
          <div id="sc2" class="course">
            <?php
            $stmt = "SELECT * FROM `account_details` INNER JOIN `gate_pass_request` ON `account_details`.`id` = `gate_pass_request`.`user_id` WHERE approved = 'false'  LIMIT 3";
            $result = mysqli_query($conn, $stmt);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="box">
              <h3>' . $row["name"] . '</h3>
              <p style="font-weight: bolder;font-size:15px;">Declined <img src="./images/cancel1.png" alt="tickpng">
              <i class="fa-solid fa-user html"></i>
            </div>';
              }
            } else {
              echo '<img style="width: 130px; margin-right:5px;" src="../dashboard/images/no_data.png" alt=""> <br /> <p>no new messages</p>';
            }
            ?>
          </div>
        </div>
      </section>
    </section>
  </div>

  <?php
  include "../dashboard/requirement/script.php";
  ?>
</body>

</html>