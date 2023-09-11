<?php
session_start(); // Start sessions

require dirname(__FILE__) . '/db_connection/db_conn.php'; // Import db conn script

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './PHPMailer/Exception.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';

if (isset($_POST['user_id']) && isset($_POST['request_id'])) {
    if (isset($_SESSION['user_id']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'Student') {
            session_destroy(); // Destroy all session variables

            $myObj = new stdClass();
            $myObj->status = "role_error";
            $JSON = json_encode($myObj);
            http_response_code(401);
            echo $JSON;
            exit;
        } else if ($_SESSION['role'] === 'Admin') {
            // Session variables
            $user_id = $_SESSION['user_id'];
            $user_name = $_SESSION['name'];
            $email = $_SESSION['email'];
            $role = $_SESSION['role'];
            //-------------------------------

            $user_id_from_form = $_POST['user_id']; // User id
            $request_id_from_form = $_POST['request_id']; // Request id

            // Validate details
            if (empty($user_id_from_form)) {
                $myObj = new stdClass();
                $myObj->status = "invalid_user_id";
                $JSON = json_encode($myObj);
                http_response_code(401);
                echo $JSON;
                exit;
            } else {
                if (empty($request_id_from_form)) {
                    $myObj = new stdClass();
                    $myObj->status = "invalid_request_id";
                    $JSON = json_encode($myObj);
                    http_response_code(401);
                    echo $JSON;
                    exit;
                } else {
                    $sanitized_user_id = filter_var($user_id_from_form, FILTER_SANITIZE_NUMBER_INT);
                    $sanitized_request_id = filter_var($request_id_from_form, FILTER_SANITIZE_NUMBER_INT);

                    if ($sanitized_user_id >= 1) {
                        if ($sanitized_request_id >= 1) {
                            $appl = '';
                            $stmt = $conn->prepare("SELECT * FROM account_details WHERE id = ? AND role = 'Student'");
                            $stmt->bind_param("i", $sanitized_user_id);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0 && $result->num_rows === 1) {
                                $user_details = $result->fetch_assoc(); // User details
                                $student_name = $user_details["name"];
                                $student_email = $user_details["email"];
                                $stmt = $conn->prepare("SELECT * FROM gate_pass_request WHERE id = ? AND approved = '$appl'");
                                $stmt->bind_param("i", $sanitized_request_id);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0 && $result->num_rows === 1) {
                                    $details = $result->fetch_assoc(); // User details
                                    $request_date = $details["date_created"];
                                    $stmt = $conn->prepare("UPDATE gate_pass_request SET approved = 'true', approved_by = ? WHERE id = ?");
                                    $stmt->bind_param("ii", $sanitized_user_id, $sanitized_request_id);
                                    $stmt->execute();

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
                                                    <p><b>Hello ' . $student_name . ', Your gate pass request submitted on ' . $request_date . ' has been successfully approved!</b></p>
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

                                    $stmt2 = $conn->prepare("SELECT * FROM gate_pass_request WHERE approved = ''");
                                    $stmt2->execute();
                                    $result = $stmt2->get_result();

                                    if ($result->num_rows > 0) {
                                        $all_gate_pass_requests = array();
                                        $account_details = array();

                                        while ($row = $result->fetch_assoc()) {
                                            array_push($all_gate_pass_requests, $row);
                                        }

                                        foreach ($all_gate_pass_requests as $request) {
                                            $user_id_x = $request["user_id"];
                                            $request_id = $request["id"];
                                            $destination_state = $request["destination_state"];
                                            $destination_city = $request["destination_city"];
                                            $date_of_exit = $request["date_of_exit"];
                                            $date_of_return = $request["date_of_return"];
                                            $time_of_exit = $request["time_of_exit"];
                                            $time_of_return = $request["time_of_return"];
                                            $guardian_name = $request["guardian_name"];
                                            $guardian_phone_number = $request["guardian_phone_number"];
                                            $date_requested = $request["date_created"];

                                            $stmt = $conn->prepare("SELECT id, name, email, matric_no FROM account_details WHERE id = ? AND role = 'Student' LIMIT 1");
                                            $stmt->bind_param("i", $user_id_x);
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if ($result->num_rows > 0) {
                                                $user_details = $result->fetch_assoc(); // User details
                                                $user_details += array("request_id" => $request_id);
                                                $user_details += array("date_requested" => $request["date_created"]);
                                                $user_details += array("destination_state" => $destination_state);
                                                $user_details += array("destination_city" => $destination_city);
                                                $user_details += array("date_of_exit" => $date_of_exit);
                                                $user_details += array("date_of_return" => $date_of_return);
                                                $user_details += array("time_of_exit" => $time_of_exit);
                                                $user_details += array("time_of_return" => $time_of_return);
                                                $user_details += array("guardian_name" => $guardian_name);
                                                $user_details += array("guardian_phone_number" => $guardian_phone_number);
                                                $user_details += array("date_requested" => $date_requested);
                                                array_push($account_details, $user_details);
                                            }
                                        }

                                        $myObj = new stdClass();
                                        $myObj->status = "successful";
                                        $myObj->result = $account_details;
                                        $JSON = json_encode($myObj);
                                        http_response_code(200);
                                        echo $JSON;
                                        exit;
                                    } else {
                                        $myObj = new stdClass();
                                        $myObj->status = "successful_with_no_data";
                                        $JSON = json_encode($myObj);
                                        http_response_code(200);
                                        echo $JSON;
                                        exit;
                                    }
                                } else {
                                    $myObj = new stdClass();
                                    $myObj->status = "request_does_not_exist";
                                    $JSON = json_encode($myObj);
                                    http_response_code(404);
                                    echo $JSON;
                                    exit;
                                }
                            } else {
                                $myObj = new stdClass();
                                $myObj->status = "invalid_user";
                                $JSON = json_encode($myObj);
                                http_response_code(401);
                                echo $JSON;
                                exit;
                            }
                        } else {
                            $myObj = new stdClass();
                            $myObj->status = "invalid_request_id";
                            $JSON = json_encode($myObj);
                            http_response_code(401);
                            echo $JSON;
                            exit;
                        }
                    } else {
                        $myObj = new stdClass();
                        $myObj->status = "invalid_user_id";
                        $JSON = json_encode($myObj);
                        http_response_code(401);
                        echo $JSON;
                        exit;
                    }
                }
            }
            //-------------------------------------------
        }
    } else {
        $myObj = new stdClass();
        $myObj->status = "invalid";
        $JSON = json_encode($myObj);
        http_response_code(401);
        echo $JSON;
        exit;
    }
} else {
    $myObj = new stdClass();
    $myObj->status = "invalid";
    $JSON = json_encode($myObj);
    http_response_code(401);
    echo $JSON;
    exit;
}
