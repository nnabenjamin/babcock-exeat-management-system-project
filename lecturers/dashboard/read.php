<?php
include "../dashboard/api/read.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/fontawesome-free-6.1.1-web/fontawesome-free-6.1.1-web/css/all.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />

  <!--=============== BOXICONS ===============-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

  <!--=============== CSS ===============-->
  <link rel="stylesheet" href="../dashboard/css/index1.css">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <nav>
      <ul>
        <li><a href="#" class="logo">
            <img src="./images/babcock.jpeg" alt="">
            <span class="nav-item">DashBoard</span>
          </a></li>
        <li><a href="http://localhost/promise_project/lecturers/dashboard/mail.php">
            <i class="fas fa-inbox"></i>
            <span class="nav-item">inbox</span>
          </a></li>
        <li><a href="http://localhost/promise_project/api/logout.php" class="logout">
            <i class="fas fa-sign-out-alt"></i>
            <span class="nav-item">Logout</span>
          </a></li>
      </ul>
    </nav>
    <section class="main">
      <div class="main-top">
        <h1>Course Lecturer</h1>
        <i class="fas fa-bars bp"></i>
        <i class="fas fa-xmark bp"></i>
      </div>
      <section class="main-course">
        <h1>Read Messages <i class="fas fa-inbox"></i></h1>
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
            <div class="cont">
              <div class="the">
                <h1>LETTER OF APPROVAL</h1>
              </div>
              <br>
              <?php
              $stmt = "SELECT * FROM `account_details` INNER JOIN `gate_pass_request` ON `account_details`.`id` = `gate_pass_request`.`user_id` WHERE user_id = '$q' ";
              $result = mysqli_query($conn, $stmt);
              if (mysqli_num_rows($result) > 0 && mysqli_num_rows($result) < 2) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<p>My Name is ' . $row["name"] . ' i want an approval for leaving the school and i would like to take permission for leaving the school..... Reasons : <h3>' . $row["reason_l"] . '</h3></p>
              <br>
              <div class="dtail">
                <br>
                <span>
                  <h1>Do you want to accept this request?</h1>
                </span>
                <span class="btn_detail">
                  <form action="' . $_SERVER['PHP_SELF'] . '?q=' . $q . '" method="post">
                    <button type="submit" name="approv">Approve</button>
                    <button type="submit" name="declin">Declined</button>
                  </form>
                </span>

              </div>';
                }
              }
              ?>
            </div>
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