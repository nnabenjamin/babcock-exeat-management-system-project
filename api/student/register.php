<?php
session_start(); // Start sessions

require dirname(__FILE__) . '/db_connection/db_conn.php'; // Import db conn script

// check if user is logged in before
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
        echo "<p>Redirecting...</p>";
        header("Location: http://localhost/promise_project/lecturers/dashboard/mail.php");
    }
}


if (isset($_POST['matric_number']) && isset($_POST['student_name']) && isset($_POST['password']) && isset($_POST['passwordconf']) && isset($_POST['phone_number']) && isset($_POST['Email']) && isset($_POST['home_address'])) {
    $matric_no = $_POST['matric_number']; // Matric no
    $name = $_POST['student_name']; // Name
    $password = $_POST['password']; // Password
    $phone_number = $_POST['phone_number']; // Phone number
    $email = $_POST['Email']; // Email
    $address = $_POST['home_address']; // Address

    // Validate matric no and password
    if (empty($matric_no)) {
        $error_message = '<p style="color: red;">* Matric Number Cant Be Empty</p>';
    } else {
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
                        if (empty($address)) {
                            $error_message = '<p style="color: red;">* address number Cant Be Empty</p>';
                        } else {
                            //sanitize items
                            $sanitize_email = filter_var($email, FILTER_SANITIZE_STRING);
                            $sanitize_address = filter_var($address, FILTER_SANITIZE_STRING);
                            $sanitize_phone_number = filter_var($phone_number, FILTER_SANITIZE_STRING);
                            $sanitize_password = filter_var($password, FILTER_SANITIZE_STRING);
                            $sanitize_name = filter_var($name, FILTER_SANITIZE_STRING);
                            $sanitize_matric_no = filter_var($matric_no, FILTER_SANITIZE_STRING);
                            if (strlen($sanitize_matric_no) === 7) {
                                if (strlen($sanitize_name) > 0) {
                                    if (strlen($sanitize_password) > 5) {
                                        if (strlen($sanitize_phone_number) < 15  && strlen($sanitize_phone_number) !== 0) {
                                            if (strlen($sanitize_address) >= 0) {
                                                if (strlen($sanitize_email) > 5 && filter_var($sanitize_email, FILTER_SANITIZE_EMAIL)) {
                                                    //check if the mail exits before
                                                    $stmt_x = $conn->prepare("SELECT * FROM account_details WHERE email = ? OR matric_no = ?");
                                                    $stmt_x->bind_param("ss", $sanitize_email, $sanitize_matric_no);
                                                    $stmt_x->execute();
                                                    $result = $stmt_x->get_result();
                                                    if ($result->num_rows === 0) {
                                                        $stmt = $conn->prepare("INSERT INTO account_details(name, email, phone_number, matric_no, home_address, user_password, role) VALUES(?, ?, ?, ?, ?, ?, 'Student')");
                                                        $stmt->bind_param("ssssss", $sanitize_name, $sanitize_email, $sanitize_phone_number, $sanitize_matric_no, $sanitize_address, $sanitize_password);
                                                        $stmt->execute();
                                                        $last_id = $conn->insert_id;
                                                        $_SESSION['user_id'] = $last_id;
                                                        $_SESSION['name'] = $sanitize_name;
                                                        $_SESSION['matric_no'] = $sanitize_matric_no;
                                                        $_SESSION['email'] = $sanitize_email;
                                                        $_SESSION['role'] = "Student";
                                                        header("Location: http://localhost/promise_project/student/form.php");
                                                    } else {
                                                        $error_message = '<p style="color: red;">* Account Exits</p>';
                                                    }
                                                } else {
                                                    $error_message = '<p style="color: red;">* Invalid Email or Email too short</p>';
                                                }
                                            } else {
                                                $error_message = '<p style="color: red;">* Invalid address</p>';
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
                            } else {
                                $error_message = '<p style="color: red;">* Invalid matric number</p>';
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    $error_message = '<p class="err_m" style="color: red;">* Error trying to submit the form</p>';
}
