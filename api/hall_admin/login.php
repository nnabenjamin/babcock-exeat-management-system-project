<?php
session_start(); // Start sessions

require dirname(__FILE__) . '/db_connection/db_conn.php'; // Import db conn script

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING); // Email
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING); // Password

    // Validate email and password
    if (empty($email)) {
        $error_message = '<p style="color: red;">* Email Empty</p>';
    } else {
        if (empty($password)) {
            $error_message = '<p style="color: red;">* password Empty</p>';
        } else {
            $stmt = $conn->prepare("SELECT * FROM account_details WHERE email = ? AND user_password = ? AND role = 'Admin'");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0 && $result->num_rows === 1) {
                $user_records = $result->fetch_assoc(); // User details

                $_SESSION['user_id'] = $user_records["id"];
                $_SESSION['name'] = $user_records["name"];
                $_SESSION['email'] = $user_records["email"];
                $_SESSION['role'] = $user_records["role"];

                header("Location: http://localhost/promise_project/hall_admin/dashboard/index.php");
            } else {
                $error_message = '<p style="color: red;">* incorrect details or Account Does Not Exits</p>';
            }
        }
    }
    //-------------------------------------------
} else {
    $error_message = '<p class="err_m" style="color: red;">* Error Getting Infomation from the form</p>';
}
