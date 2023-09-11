<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['role'])) {
  if ($_SESSION['role'] === 'Student') {
    echo "<p>Redirecting...</p>";
    header("Location: http://localhost/promise_project/student/form.php");
  } else if ($_SESSION['role'] === 'lecturers') {
    echo "<p>Redirecting...</p>";
    header("Location: http://localhost/promise_project/lecturers/dashboard/mail.php");
  } else if ($_SESSION['role'] === 'Hod') {
    echo "<p>Redirecting...</p>";
    header("Location: http://localhost/promise_project/HOD/dashboard/index.php");
  }
} else {
  echo "<p>Redirecting...</p>";
  header("Location: http://localhost/promise_project/index.php");
}
