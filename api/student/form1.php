<?php 
    session_start(); // Start sessions

    require dirname(__FILE__) . '/db_connection/db_conn.php'; // Import db conn script

    if (isset($_POST['state']) && isset($_POST['city']) && isset($_POST['doe']) && isset($_POST['dor']) && isset($_POST['toe']) && isset($_POST['tor']) && isset($_POST['gn']) && isset($_POST['gpn'])){
        if (isset($_SESSION['user_id']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['role'])){ 
            if ($_SESSION['role'] === 'Student'){
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

                // Validate details
                if (empty($state)){
                    $myObj = new stdClass();
                    $myObj->status = "invalid_state";
                    $JSON = json_encode($myObj);
                    http_response_code(401);
                    echo $JSON;
                    exit;
                } else {
                    if (empty($city)){
                        $myObj = new stdClass();
                        $myObj->status = "invalid_city";
                        $JSON = json_encode($myObj);
                        http_response_code(401);
                        echo $JSON;
                        exit;
                    } else {
                        if (empty($doe)){
                            $myObj = new stdClass();
                            $myObj->status = "invalid_doe";
                            $JSON = json_encode($myObj);
                            http_response_code(401);
                            echo $JSON;
                            exit;
                        } else {
                            if (empty($dor)){
                                $myObj = new stdClass();
                                $myObj->status = "invalid_dor";
                                $JSON = json_encode($myObj);
                                http_response_code(401);
                                echo $JSON;
                                exit;
                            } else {
                                if (empty($toe)){
                                    $myObj = new stdClass();
                                    $myObj->status = "invalid_toe";
                                    $JSON = json_encode($myObj);
                                    http_response_code(401);
                                    echo $JSON;
                                    exit;
                                } else {
                                    if (empty($tor)){
                                        $myObj = new stdClass();
                                        $myObj->status = "invalid_tor";
                                        $JSON = json_encode($myObj);
                                        http_response_code(401);
                                        echo $JSON;
                                        exit;
                                    } else {
                                        if (empty($gn)){
                                            $myObj = new stdClass();
                                            $myObj->status = "invalid_gn";
                                            $JSON = json_encode($myObj);
                                            http_response_code(401);
                                            echo $JSON;
                                            exit;
                                        } else {
                                            if (empty($gpn)){
                                                $myObj = new stdClass();
                                                $myObj->status = "invalid_gpn";
                                                $JSON = json_encode($myObj);
                                                http_response_code(401);
                                                echo $JSON;
                                                exit;
                                            } else {
                                                $sanitized_state = filter_var($state, FILTER_SANITIZE_STRING);
                                                $sanitized_city = filter_var($city, FILTER_SANITIZE_STRING);
                                                $sanitized_doe = filter_var($doe, FILTER_SANITIZE_STRING);
                                                $sanitized_dor = filter_var($dor, FILTER_SANITIZE_STRING);
                                                $sanitized_toe = filter_var($toe, FILTER_SANITIZE_STRING);
                                                $sanitized_tor = filter_var($tor, FILTER_SANITIZE_STRING);
                                                $sanitized_gn = filter_var($gn, FILTER_SANITIZE_STRING);
                                                $sanitized_gpn = filter_var($gpn, FILTER_SANITIZE_STRING);

                                                if (strlen($sanitized_state) >= 1){
                                                    if (strlen($sanitized_city) >= 1){
                                                        if (strlen($sanitized_doe) >= 1){
                                                            if (strlen($sanitized_dor) >= 1){
                                                                if (strlen($sanitized_toe) >= 1){
                                                                    if (strlen($sanitized_tor) >= 1){
                                                                        if (strlen($sanitized_gn) >= 1){
                                                                            if (strlen($sanitized_gpn) >= 1){
                                                                                $bool = "false";
                                                                                $stmt = $conn->prepare("INSERT INTO gate_pass_request(user_id, approved, destination_state, destination_city, date_of_exit, date_of_return, time_of_exit, guardian_name, guardian_phone_number, time_of_return, date_created) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                                                                                $stmt->bind_param("isssssssss", $user_id, $bool, $sanitized_state, $sanitized_city, $sanitized_doe, $sanitized_dor, $sanitized_toe, $sanitized_gn, $sanitized_gpn, $sanitized_tor);
                                                                                $stmt->execute();

                                                                                $myObj = new stdClass();
                                                                                $myObj->status = "form_submitted_successfully";
                                                                                $JSON = json_encode($myObj);
                                                                                http_response_code(200);
                                                                                echo $JSON;
                                                                                exit;
                                                                            } else {
                                                                                $myObj = new stdClass();
                                                                                $myObj->status = "invalid_gpn";
                                                                                $JSON = json_encode($myObj);
                                                                                http_response_code(401);
                                                                                echo $JSON;
                                                                                exit;
                                                                            }
                                                                        } else {
                                                                            $myObj = new stdClass();
                                                                            $myObj->status = "invalid_gn";
                                                                            $JSON = json_encode($myObj);
                                                                            http_response_code(401);
                                                                            echo $JSON;
                                                                            exit;
                                                                        }
                                                                    } else {
                                                                        $myObj = new stdClass();
                                                                        $myObj->status = "invalid_tor";
                                                                        $JSON = json_encode($myObj);
                                                                        http_response_code(401);
                                                                        echo $JSON;
                                                                        exit;
                                                                    }
                                                                } else {
                                                                    $myObj = new stdClass();
                                                                    $myObj->status = "invalid_toe";
                                                                    $JSON = json_encode($myObj);
                                                                    http_response_code(401);
                                                                    echo $JSON;
                                                                    exit;
                                                                }
                                                            } else {    
                                                                $myObj = new stdClass();
                                                                $myObj->status = "invalid_dor";
                                                                $JSON = json_encode($myObj);
                                                                http_response_code(401);
                                                                echo $JSON;
                                                                exit;
                                                            }
                                                        } else {
                                                            $myObj = new stdClass();
                                                            $myObj->status = "invalid_doe";
                                                            $JSON = json_encode($myObj);
                                                            http_response_code(401);
                                                            echo $JSON;
                                                            exit;
                                                        }
                                                    } else {
                                                        $myObj = new stdClass();
                                                        $myObj->status = "invalid_city";
                                                        $JSON = json_encode($myObj);
                                                        http_response_code(401);
                                                        echo $JSON;
                                                        exit;
                                                    }
                                                } else {
                                                    $myObj = new stdClass();
                                                    $myObj->status = "invalid_state";
                                                    $JSON = json_encode($myObj);
                                                    http_response_code(401);
                                                    echo $JSON;
                                                    exit;
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
            } else if ($_SESSION['role'] === 'Admin'){
                header("Location: http://localhost/promise_project/hall_admin/dashboard/index.php");
            }
        } else { 
            header("Location: http://localhost/promise_project/index.php");
        }
    } else {
        $myObj = new stdClass();
        $myObj->status = "error";
        $JSON = json_encode($myObj);
        http_response_code(401);
        echo $JSON;
        exit;
    }
?>