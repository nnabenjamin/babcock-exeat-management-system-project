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
    } else if ($_SESSION['role'] === 'Hod') {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/HOD/dashboard/mail.php");
    } else if ($_SESSION['role'] === 'lecturers') {

      $stmt = $conn->prepare("UPDATE gate_pass_request SET lecturers = 'true' WHERE user_id = ?");
      $stmt->bind_param("i", $q);
      $stmt->execute();
      header("Location: http://localhost/promise_project/lecturers/dashboard/mail.php");
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
    } else if ($_SESSION['role'] === 'Admin') {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/hall_admin/dashboard/index.php");
    } else if ($_SESSION['role'] === 'Hod') {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/HOD/dashboard/mail.php");
    } else if ($_SESSION['role'] === 'lecturers') {
      $stmt = $conn->prepare("UPDATE gate_pass_request SET lecturers = 'false' WHERE user_id = ?");
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
                                                <head>
                                                    <title>Gate Pass Request</title>
                                                </head>
                                                <body>
                                                    <div style="padding: 10px; background: #020166; color: #fff; text-align: center; border-radius: 6px; font-size: 1.3rem;">BABCOCK EXEAT SYSTEM</div>
                                                    <p><b>Hello ' . $student_name . ', Your gate pass request submitted on ' . $request_date . ' has been Declined By the HOD of your department kindly visit our office!</b></p>
                                                </body>
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
      header("Location: http://localhost/promise_project/lecturers/dashboard/mail.php");
    } else {
      echo "<p>Redirecting...</p>";
      header("Location: http://localhost/promise_project/index.php");
    }
  }
}
