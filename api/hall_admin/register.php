<?php
session_start(); // Start sessions

require dirname(__FILE__) . '/db_connection/db_conn.php'; // Import db conn script

if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['phone_number']) && isset($_POST['email'])) {
    $name = $_POST['name']; // Name
    $password = $_POST['password']; // Password
    $phone_number = $_POST['phone_number']; // Phone number
    $email = $_POST['email']; // Email

    // Validate all user details
    if (empty($name)) {
        $error_message = '<p style="color: red;">* Full Name Cant Be Empty</p>';
    } else {
        if (empty($password)) {
            $error_message = '<p style="color: red;">* password Cant Be Empty</p>';
        } else {
            if (empty($phone_number)) {
                $error_message = '<p style="color: red;">* phone number Cant Be Empty</p>';
            } else {
                if (empty($email)) {
                    $error_message = '<p style="color: red;">* email number Cant Be Empty</p>';
                } else {
                    $sanitized_name = filter_var($name, FILTER_SANITIZE_STRING);
                    $sanitized_password = filter_var($password, FILTER_SANITIZE_STRING);
                    $sanitized_phone_number = filter_var($phone_number, FILTER_SANITIZE_STRING);
                    $sanitized_email = filter_var($email, FILTER_SANITIZE_STRING);

                    if (strlen($sanitized_name) > 0) {
                        if (strlen($sanitized_password) >= 5 && strlen($sanitized_password) <= 10) {
                            if (strlen($sanitized_phone_number) < 15 || strlen($sanitized_phone_number) !== 0) {
                                if (filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
                                    $stmt_x = $conn->prepare("SELECT * FROM account_details WHERE email = ?");
                                    $stmt_x->bind_param("s", $sanitized_email);
                                    $stmt_x->execute();
                                    $result = $stmt_x->get_result();

                                    if ($result->num_rows === 0) {
                                        $stmt = $conn->prepare("INSERT INTO account_details(name, email, phone_number, matric_no, home_address, user_password, role) VALUES(?, ?, ?, NULL, NULL, ?, 'Admin')");
                                        $stmt->bind_param("ssss", $sanitized_name, $sanitized_email, $sanitized_phone_number, $sanitized_password);
                                        $stmt->execute();
                                        $last_id = $conn->insert_id;

                                        $_SESSION['user_id'] = $last_id;
                                        $_SESSION['name'] = $sanitized_name;
                                        $_SESSION['email'] = $sanitized_email;
                                        $_SESSION['role'] = "Admin";

                                        header("Location: http://localhost/promise_project/hall_admin/dashboard/index.php");
                                    } else {
                                        $error_message = '<p style="color: red;">* Account Exits</p>';
                                    }
                                } else {
                                    $error_message = '<p style="color: red;">* Invalid Email or Email too short</p>';
                                }
                            } else {
                                $error_message = '<p style="color: red;">* Invalid phone number</p>';
                            }
                        } else {
                            $error_message = '<p style="color: red;">* Invalid password or password too short</p>';
                        }
                    } else {
                        $error_message = '<p style="color: red;">* Invalid Name</p>';
                    }
                }
            }
        }
    }
    //-------------------------------------------------
} else {
    $error_message = '<p class="err_m" style="color: red;">* Error trying to submit the form</p>';
}
