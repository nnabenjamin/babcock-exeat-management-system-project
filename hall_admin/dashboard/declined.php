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
      <section class="main-course">
        <h1>Declined clerance</h1>
        <div class="course-box">
          <div class="sform">
            <input type="text" name="seacrch-filter" id="seacrch-filter">
          </div>
          <style>
            .course {
              height: 71vh;
              overflow: hidden;
              overflow-y: scroll;
            }

            .box {
              margin-bottom: 30px;
              border: 1px solid grey;
            }

            @media (max-width:1024px) {
              .course {
                height: 80vh;
              }
            }
          </style>
          <div class="course">
            <?php
            $stmt = "SELECT * FROM `account_details` INNER JOIN `gate_pass_request` ON `account_details`.`id` = `gate_pass_request`.`user_id` WHERE approved = 'false'";
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

  <script>
    let fa_bars = document.querySelector(".fa-bars"),
      fa_xmark = document.querySelector(".fa-xmark"),
      nav = document.querySelector("nav"),
      cb = document.querySelector("#cb"),
      sc = document.querySelector("#sc");


    // open nav
    fa_bars.addEventListener("click", () => {
      nav.style.width = "280px";
      fa_bars.style.display = "none";
      fa_xmark.style.display = "block";
    });

    if (window.innerWidth <= 1024) {
      nav.style.display = "none";
      nav.style.position = "fixed";
      nav.style.zIndex = "10";
    }
    if (window.innerWidth <= 768) {
      // open nav
      fa_bars.addEventListener("click", () => {
        nav.style.display = "block";
        nav.style.width = "280px";
        fa_bars.style.display = "none";
        fa_xmark.style.display = "block";
      });

      // close nav
      fa_xmark.addEventListener("click", () => {
        nav.style.display = "none";
        fa_bars.style.display = "block";
        fa_xmark.style.display = "none";
        fa_xmark.style.right = "-10px";
      });
    }
    // close nav
    fa_xmark.addEventListener("click", () => {
      nav.style.width = "90px";
      fa_bars.style.display = "block";
      fa_xmark.style.display = "none";
    });
  </script>
</body>

</html>