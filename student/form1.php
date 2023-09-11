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
  <link rel="stylesheet" href="../CSS/form.css">
  <title>Student | Form page</title>
</head>

<body style="background-image: url(../Image/abstract.jpg);">
  <?php
  if (isset($_SESSION['user_id']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'Student') {
      echo '
            <div class="travelinfo"><h1>Travel Information<h1></div>
            <div class="place">
                <form action="inbox.php">
                    <div id="destination">
                        <h2 class="dest">Destination</h2>
                        <input class="state" id="form_state" type="text" name="state"><br>
                        <label class="firstlabel">State</label>
                        <input class="city" id="form_city" type="text" name="city">;
                        <label class="lastlabel">city/town</label>
                    </div>
                  
                    <div id="destination">
                        <h2 class="dest">Date</h2>
                        <input class="state" id="form_date_of_exit" type="date" name="date1"><br>
                        <label class="firstlabel">Date of exit</label>
                        <input class="city" style="margin-top: -3px;" id="form_date_of_return" type="date" name="date2">;
                        <label class="lastlabel" style="margin-left: 54px;">Date of return</label>
                    </div>
                      
                    <div id="destination">
                        <h2 class="dest">Time</h2>
                        <input class="state" id="form_time_of_exit" type="time" name="time1"><br>
                        <label class="firstlabel">Time of exit</label>
                        <input class="city" style="margin-top: -3px;" id="form_time_of_return" type="time" name="time2">;
                        <label class="lastlabel" style="margin-left: 80px;">Time of return</label>
                    </div>
      
                    <div id="destination">
                        <h2 class="dest">Guardian</h2>
                        <input class="state" id="form_guardian_name" type="name" name="name"><br>
                        <label class="firstlabel">Guardian\'s name</label>
                        <input class="city" id="form_guardian_number" type="number" name="pnumber">;
                        <label class="lastlabel">Guardian\'s phone number</label>
                    </div>
                    
                    <div style="padding-left: 25px; padding-bottom: 15px;">
                      <button type="button" id="submit_form_btn" class="btn btn-dark">
                        <img id="spinner" src="../Image/spinner.png" alt="">
                        <span id="login_txts">submit</span>
                      </button>
                    </div>
                    <div style="padding-top: 10px; padding-left: 25px; padding-bottom: 15px;">
                      <button type="button" id="logout_btn" class="btn btn-dark">
                        <img id="spinner_2" src="../Image/spinner.png" alt="">
                        <span id="login_txts_2">logout</span>
                      </button>
                    </div>
                </form>
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
            <script src="../JS/student/form.js"></script>
          ';
    } else if ($_SESSION['role'] === 'Admin') {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/hall_admin/dashboard/index.php");
    }
  } else {
    echo "<p>Redirecting...</p>";
    header("Location: http://localhost/promise_project/index.php");
  }
  ?>
</body>

</html>