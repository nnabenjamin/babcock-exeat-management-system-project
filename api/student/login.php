<?php
session_start(); // Start sessions

require dirname(__FILE__) . '/db_connection/db_conn.php'; // Import db conn script

if (isset($_POST['matric_no']) && isset($_POST['password'])) {
  $matric_no = filter_var($_POST['matric_no'], FILTER_SANITIZE_STRING); // Matric no
  $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING); // Password

  // Validate matric no and password
  if (empty($matric_no)) {
    $error_message = '<p style="color: red;">* Matric Number Empty</p>';
  } else {
    if (empty($password)) {
      $error_message = '<p style="color: red;">* password Empty</p>';
    } else {
      $stmt = $conn->prepare("SELECT * FROM account_details WHERE matric_no = ? AND user_password = ? AND role = 'Student'");
      $stmt->bind_param("ss", $matric_no, $password);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0 && $result->num_rows === 1) {
        $user_records = $result->fetch_assoc(); // User details

        $_SESSION['user_id'] = $user_records["id"];
        $_SESSION['name'] = $user_records["name"];
        $_SESSION['matric_no'] = $user_records["matric_no"];
        $_SESSION['email'] = $user_records["email"];
        $_SESSION['role'] = $user_records["role"];

        header("Location: http://localhost/promise_project/student/form.php");
      } else {
        $error_message = '<p style="color: red;">* incorrect details or Account Does Not Exits</p>';
      }
    }
  }
  //-------------------------------------------
} else {
  $error_message = '<p class="err_m" style="color: red;">* Error getting your information</p>';
}
