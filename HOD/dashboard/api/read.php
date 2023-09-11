<?php
session_start();
include "db_conn.php";
$q = $_GET['q'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../dashboard/api/PHPMailer/Exception.php';
require '../dashboard/api/PHPMailer/PHPMailer.php';
require '../dashboard/api/PHPMailer/SMTP.php';

if (isset($_POST['approv'])) {
  if (isset($_SESSION['user_id']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'Student') {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/student/form.php");
    } else if ($_SESSION['role'] === 'Admin') {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/hall_admin/dashboard/index.php");
    } else if ($_SESSION['role'] === 'lecturers') {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/lecturers/dashboard/mail.php");
    } else if ($_SESSION['role'] === 'Hod') {

      $stmt = $conn->prepare("UPDATE gate_pass_request SET Hod = 'true' WHERE user_id = ?");
      $stmt->bind_param("i", $q);
      $stmt->execute();
      header("Location: http://localhost/promise_project/HOD/dashboard/mail.php");
    }
  } else {
    echo "<p>Redirecting...</p>";
    header("Location: http://localhost/promise_project/index.php");
  }
} elseif (isset($_POST['declin'])) {
  if (isset($_SESSION['user_id']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'Student') {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/student/form.php");
    } else if ($_SESSION['role'] === 'lecturers') {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/lecturers/dashboard/mail.php");
    } else if ($_SESSION['role'] === 'Admin') {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/hall_admin/dashboard/index.php");
    } else if ($_SESSION['role'] === 'Hod') {
      $stmt = $conn->prepare("UPDATE gate_pass_request SET Hod = 'false' WHERE user_id = ?");
      $stmt->bind_param("i", $q);
      $stmt->execute();

      $stmt2 = $conn->prepare("SELECT * FROM `account_details` INNER JOIN `gate_pass_request` ON `account_details`.`id` = `gate_pass_request`.`user_id` WHERE user_id = ?");
      $stmt2->bind_param("i", $q);
      $stmt2->execute();
      $result = $stmt2->get_result();
      $user_details = $result->fetch_assoc();

      $student_name = $user_details["name"];
      $student_email = $user_details["email"];
      $request_date = $user_details["date_created"];


      $mail = new PHPMailer(TRUE);

      try {
        $mail->setFrom('babcockexeat@gmail.com', 'Babcock exeat'); // From email (The email that will be used to send the mail)
        $mail->addAddress($student_email, $student_name); // To email (The email that the mail is going to be sent to)
        $mail->Subject = 'Gate Pass Request';
        $mail->Body = '
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
</head>

<body>
  <style>
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-flow: column;
      padding: 10px;
    }

    .main {
      max-width: 700px;
      padding: 5px;
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-flow: column;
    }

    .the {
      max-width: 600px;
      border-bottom: 10px double blue;
      border-radius: 10px;
      font-size: 1.5rem;
    }

    .log {
      width: 80%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .log p {
      font-size: 30px;
      font-weight: bolder;
    }

    .log img {
      width: 100px;
    }


    @media (max-width:700px) {
      .the {
        font-size: 1rem;
      }
    }
  </style>
  <div class="container">
    <div class="log">
      <img src="http://localhost/promise_project/Image/babcock.jpeg" alt="">
      <p>P.O BOX 100</p>
    </div>
    <br />
    <br />
    <br />
    <br />
    <section class="main">
      <div class="the">
        <h1>BABCOCK EXEAT SYSTEM</h1>
      </div>
    <br />
      <br />
      <p><b>Hello ' . $student_name . ', Your gate pass request submitted on ' . $request_date . ' has been Declined By the HOD of your department kindly visit our office!</b>!
      </p>
    </section>
  </div>

</body>

</html>
                                            ';
        $mail->isSMTP();
        $mail->isHTML(true);
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = 'ssl';
        $mail->Username = 'babcockexeat@gmail.com';
        $mail->Password = 'eopyobspnnqfmuga';
        $mail->Port = 465;

        /* Enable SMTP debug output. */
        $mail->SMTPDebug = 0;

        $mail->send();
      } catch (Exception $e) {
        // Do nothing
      } catch (\Exception $e) {
        // Do nothing
      }
      header("Location: http://localhost/promise_project/HOD/dashboard/mail.php");
    } else {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/index.php");
    }
  }
}
