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
              $stmt = "SELECT * FROM `account_details` INNER JOIN `gate_pass_request` ON `account_details`.`id` = `gate_pass_request`.`user_id` WHERE user_id = '$q'  LIMIT 3";
              $result = mysqli_query($conn, $stmt);
              if (mysqli_num_rows($result) > 0 && mysqli_num_rows($result) < 2) {
                while ($row = mysqli_fetch_assoc($result)) {
                  // checking Hod if approved
                  if ($row["Hod"] === "true" && $row["lecturers"] === "true") {
                    $Hods = 'HOD : APPROVED <i style="color: green;" class="fas fa-check"></i>';
                    $Hodd = '<button id="bub" type="submit" name="approv">Approve</button>
                    <button id="bub" type="submit" name="declin">Declined</button>';
                    $Hodi = 'LETURER: APPROVED <i style="color: green;" class="fas fa-check"></i>';
                    $err = "";
                  } elseif ($row["Hod"] === "false" && $row["lecturers"] === "true") {
                    $Hods = 'HOD : DECLINED <i style="color: red;" class="fa-solid fa-xmark"></i>';
                    $Hodd = '<button id="bub" type="submit" name="approv" disabled="disabled">Approve</button>
                    <button id="bub" type="submit" name="declin" disabled="disabled">Declined</button>';
                    $Hodi = 'LETURER: APPROVED <i style="color: green;" class="fas fa-check"></i>';
                    $err = "HOD declined your request";
                  } elseif ($row["Hod"] === "true" && $row["lecturers"] === "false") {
                    $Hods = 'HOD : APPROVED <i style="color: green;" class="fas fa-check"></i>';
                    $Hodd = '<button id="bub" type="submit" name="approv" disabled="disabled">Approve</button>
                    <button id="bub" type="submit" name="declin" disabled="disabled">Declined</button>';
                    $Hodi = 'LETURER: DECLINED <i style="color: red;" class="fa-solid fa-xmark"></i>';
                    $err = "Lecturer declined your request";
                  } else {
                    $Hods = 'HOD : ';
                    $Hodi = 'LETURER : ';
                    $Hodd = '<button id="bub" type="submit" name="approv" disabled="disabled">Approve</button>
                    <button id="bub" type="submit" name="declin" disabled="disabled">Declined</button>';
                    $err = "HOD and LECTURERS are yet to respond";
                  }
                  echo '<p>My Name is ' . $row["name"] . ' i want an approval for leaving the school..</p>
              <br>
              <div class="dtail">
                <span>Reason for leaving: ' . $row["reason_l"] . '</span>
                <span>Destination state: ' . $row["destination_state"] . '</span>
                <span>Destination city: ' . $row["destination_city"] . '</span>
                <span>Date of exit: ' . $row["date_of_exit"] . '</span>
                <span>Date of return: ' . $row["date_of_return"] . '</span>
                <span>Time of exit: ' . $row["time_of_exit"] . '</span>
                <span>Time of return: ' . $row["time_of_return"] . '</span>
                <span>Guardian phone number: ' . $row["guardian_phone_number"] . '</span>
                <span>Date requested: ' . $row["date_created"] . '</span>
                <span class="shgrant">
                  <div class="shg"> ' . $Hods . ' </div>
                  <div class="shg">' . $Hodi . ' </div>

                </span>
                <br>
                <span>
                  <h1>Do you want to accept this request?</h1>
                </span>
                <span>
                  <h4 style="color:red;font-size:14px;">*' . $err . '</h4>
                </span>
                <span class="btn_detail">
                  <form action="' . $_SERVER['PHP_SELF'] . '?q=' . $q . '" method="post">
                    ' . $Hodd . '
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