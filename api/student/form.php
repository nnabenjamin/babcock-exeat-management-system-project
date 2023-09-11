<?php
session_start(); // Start sessions

require dirname(__FILE__) . '/db_connection/db_conn.php'; // Import db conn script

if (isset($_POST['state']) && isset($_POST['city']) && isset($_POST['doe']) && isset($_POST['dor']) && isset($_POST['toe']) && isset($_POST['tor']) && isset($_POST['gn']) && isset($_POST['gpn']) && isset($_POST['reason_l'])) {

    if (isset($_SESSION['user_id']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'Student') {
            // Session variables
            $user_id = $_SESSION['user_id'];
            $user_name = $_SESSION['name'];
            $email = $_SESSION['email'];
            $role = $_SESSION['role'];
            //-------------------------------

            $state = $_POST['state']; // State
            $city = $_POST['city']; // City
            $doe = $_POST['doe']; // Doe
            $dor = $_POST['dor']; // Dor
            $toe = $_POST['toe']; // Toe
            $tor = $_POST['tor']; // Tor
            $gn = $_POST['gn']; // Gn
            $gpn = $_POST['gpn']; // Gpn
            $reason_l = $_POST['reason_l']; // reasons

            // Validate details
            if (empty($state)) {
                $error_message = '<p style="color: red;">* State Cant Be Empty</p>';
            } else {
                if (empty($city)) {
                    $error_message = '<p style="color: red;">* City Cant Be Empty</p>';
                } else {
                    if (empty($doe)) {
                        $error_message = '<p style="color: red;">* date of exit Cant Be Empty</p>';
                    } else {
                        if (empty($dor)) {
                            $error_message = '<p style="color: red;">* date of return Cant Be Empty</p>';
                        } else {
                            if (empty($toe)) {
                                $error_message = '<p style="color: red;">* Time of exit Cant Be Empty</p>';
                                exit;
                            } else {
                                if (empty($tor)) {
                                    $error_message = '<p style="color: red;">* Time of return Cant Be Empty</p>';
                                } else {
                                    if (empty($gn)) {
                                        $error_message = '<p style="color: red;">* Guardians name Cant Be Empty</p>';
                                    } else {
                                        if (empty($gpn)) {
                                            $error_message = '<p style="color: red;">* Guardians Phone Cant Be Empty</p>';
                                        } else {
                                            if (empty($reason_l)) {
                                                $error_message = '<p style="color: red;">* Reason Cant Be Empty</p>';
                                            } else {
                                                $sanitized_state = filter_var($state, FILTER_SANITIZE_STRING);
                                                $sanitized_city = filter_var($city, FILTER_SANITIZE_STRING);
                                                $sanitized_doe = filter_var($doe, FILTER_SANITIZE_STRING);
                                                $sanitized_dor = filter_var($dor, FILTER_SANITIZE_STRING);
                                                $sanitized_toe = filter_var($toe, FILTER_SANITIZE_STRING);
                                                $sanitized_tor = filter_var($tor, FILTER_SANITIZE_STRING);
                                                $sanitized_gn = filter_var($gn, FILTER_SANITIZE_STRING);
                                                $sanitized_gpn = filter_var($gpn, FILTER_SANITIZE_STRING);
                                                $sanitized_reason_l = filter_var($reason_l, FILTER_SANITIZE_STRING);
                                                if (strlen($sanitized_state) >= 1) {
                                                    if (strlen($sanitized_city) >= 1) {
                                                        if (strlen($sanitized_doe) >= 1) {
                                                            if (strlen($sanitized_dor) >= 1) {
                                                                if (strlen($sanitized_toe) >= 1) {
                                                                    if (strlen($sanitized_tor) >= 1) {
                                                                        if (strlen($sanitized_gn) >= 1) {
                                                                            if (strlen($sanitized_gpn) >= 1) {
                                                                                if (strlen($sanitized_reason_l) >= 1) {
                                                                                    $stmt = $conn->prepare("SELECT * FROM `gate_pass_request` WHERE user_id = ?");
                                                                                    $stmt->bind_param('s', $user_id);
                                                                                    $stmt->execute();
                                                                                    $post = $stmt->get_result();

                                                                                    if ($post->num_rows === 0) {
                                                                                        $bool = "";
                                                                                        $stmt = $conn->prepare("INSERT INTO gate_pass_request(user_id, approved, destination_state, destination_city, date_of_exit, date_of_return, time_of_exit, guardian_name, guardian_phone_number, time_of_return,reason_l, date_created) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, NOW())");
                                                                                        $stmt->bind_param("issssssssss", $user_id, $bool, $sanitized_state, $sanitized_city, $sanitized_doe, $sanitized_dor, $sanitized_toe, $sanitized_gn, $sanitized_gpn, $sanitized_tor, $sanitized_reason_l);
                                                                                        $stmt->execute();

                                                                                        $error_message = '<p style="color: green;">* submitted</p>';
                                                                                    } else {
                                                                                        $error_message = '<p style="color: red;">* You Have an Active Form Submitted Already check your mail i accepted AND Logout</p>';
                                                                                    }
                                                                                } else {
                                                                                    $error_message = '<p style="color: red;">* invalid reason to collect clearance</p>';
                                                                                }
                                                                            } else {
                                                                                $error_message = '<p style="color: red;">* invalid guardian phone number</p>';
                                                                            }
                                                                        } else {
                                                                            $error_message = '<p style="color: red;">* invalid guardian name</p>';
                                                                        }
                                                                    } else {
                                                                        $error_message = '<p style="color: red;">* invalid time of return</p>';
                                                                    }
                                                                } else {
                                                                    $error_message = '<p style="color: red;">* invalid time of exit</p>';
                                                                }
                                                            } else {
                                                                $error_message = '<p style="color: red;">* invalid date of return</p>';
                                                            }
                                                        } else {
                                                            $error_message = '<p style="color: red;">* invalid date of exit</p>';
                                                        }
                                                    } else {
                                                        $error_message = '<p style="color: red;">* invalid city</p>';
                                                    }
                                                } else {
                                                    $error_message = '<p style="color: red;">* invalid state</p>';
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            //-------------------------------------------
        } else if ($_SESSION['role'] === 'Admin') {
            header("Location: http://localhost/promise_project/hall_admin/dashboard/index.php");
        } else if ($_SESSION['role'] === 'Hod') {
            echo "<p>Redirecting...</p>";
            header("Location: http://localhost/promise_project/HOD/dashboard/mail.php");
        } else if ($_SESSION['role'] === 'lecturers') {
            echo "<p>Redirecting...</p>";
            header("Location: http://localhost/promise_project/lecturers/dashboard/mail.php");
        }
    } else {
        header("Location: http://localhost/promise_project/index.php");
    }
} else {
    $error_message = '<p class="err_m" style="color: red;">* invalid form</p>';
}
