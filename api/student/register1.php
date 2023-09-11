<?php 
    session_start(); // Start sessions

    require dirname(__FILE__) . '/db_connection/db_conn.php'; // Import db conn script

    if (isset($_POST['matric_no']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['phone_number']) && isset($_POST['email']) && isset($_POST['address'])){
        $matric_no = $_POST['matric_no']; // Matric no
        $name = $_POST['name']; // Name
        $password = $_POST['password']; // Password
        $phone_number = $_POST['phone_number']; // Phone number
        $email = $_POST['email']; // Email
        $address = $_POST['address']; // Address

        // Validate matric no and password
        if (empty($matric_no)){
            $myObj = new stdClass();
            $myObj->status = "invalid_matric_no";
            $JSON = json_encode($myObj);
            http_response_code(401);
            echo $JSON;
            exit;
        } else {
            if (empty($name)){
                $myObj = new stdClass();
                $myObj->status = "invalid_name";
                $JSON = json_encode($myObj);
                http_response_code(401);
                echo $JSON;
                exit;
            } else {
                if (empty($password)){
                    $myObj = new stdClass();
                    $myObj->status = "invalid_password";
                    $JSON = json_encode($myObj);
                    http_response_code(401);
                    echo $JSON;
                    exit;
                } else {
                    if (empty($phone_number)){
                        $myObj = new stdClass();
                        $myObj->status = "invalid_phone_number";
                        $JSON = json_encode($myObj);
                        http_response_code(401);
                        echo $JSON;
                        exit;
                    } else {
                        if (empty($email)){
                            $myObj = new stdClass();
                            $myObj->status = "invalid_email";
                            $JSON = json_encode($myObj);
                            http_response_code(401);
                            echo $JSON;
                            exit;
                        } else {
                            if (empty($address)){
                                $myObj = new stdClass();
                                $myObj->status = "invalid_address";
                                $JSON = json_encode($myObj);
                                http_response_code(401);
                                echo $JSON;
                                exit;
                            } else {
                                $sanitized_matric_no = filter_var($matric_no, FILTER_SANITIZE_STRING);
                                $sanitized_name = filter_var($name, FILTER_SANITIZE_STRING);
                                $sanitized_password = filter_var($password, FILTER_SANITIZE_STRING);
                                $sanitized_phone_number = filter_var($phone_number, FILTER_SANITIZE_STRING);
                                $sanitized_email = filter_var($email, FILTER_SANITIZE_STRING);
                                $sanitized_address = filter_var($address, FILTER_SANITIZE_STRING);

                                if (strlen($sanitized_matric_no) === 7){
                                    if (strlen($sanitized_name) > 0){
                                        if (strlen($sanitized_password) >= 5 && strlen($sanitized_password) <= 10){
                                            if (strlen($sanitized_phone_number) < 15 || strlen($sanitized_phone_number) !== 0){
                                                if (filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)){
                                                    if (strlen($sanitized_address) > 0){
                                                        $stmt_x = $conn->prepare("SELECT * FROM account_details WHERE email = ? OR user_password = ? OR matric_no = ?");
                                                        $stmt_x->bind_param("sss", $sanitized_email, $sanitized_password, $sanitized_matric_no);
                                                        $stmt_x->execute();
                                                        $result = $stmt_x->get_result();

                                                        if ($result->num_rows === 0){
                                                            $stmt = $conn->prepare("INSERT INTO account_details(name, email, phone_number, matric_no, home_address, user_password, role) VALUES(?, ?, ?, ?, ?, ?, 'Student')");
                                                            $stmt->bind_param("ssssss", $sanitized_name, $sanitized_email, $sanitized_phone_number, $sanitized_matric_no, $sanitized_address, $sanitized_password);
                                                            $stmt->execute();
                                                            $last_id = $conn->insert_id;
    
                                                            $_SESSION['user_id'] = $last_id;
                                                            $_SESSION['name'] = $sanitized_name;
                                                            $_SESSION['matric_no'] = $sanitized_matric_no;
                                                            $_SESSION['email'] = $sanitized_email;
                                                            $_SESSION['role'] = "Student";
    
                                                            $myObj = new stdClass();
                                                            $myObj->status = "account_created_successfully";
                                                            $JSON = json_encode($myObj);
                                                            http_response_code(200);
                                                            echo $JSON;
                                                            exit;
                                                        } else {
                                                            $myObj = new stdClass();
                                                            $myObj->status = "account_already_exists";
                                                            $JSON = json_encode($myObj);
                                                            http_response_code(401);
                                                            echo $JSON;
                                                            exit; 
                                                        }
                                                    } else {
                                                        $myObj = new stdClass();
                                                        $myObj->status = "invalid_address";
                                                        $JSON = json_encode($myObj);
                                                        http_response_code(401);
                                                        echo $JSON;
                                                        exit;
                                                    }
                                                } else {
                                                    $myObj = new stdClass();
                                                    $myObj->status = "invalid_email";
                                                    $JSON = json_encode($myObj);
                                                    http_response_code(401);
                                                    echo $JSON;
                                                    exit;
                                                }
                                            } else {
                                                $myObj = new stdClass();
                                                $myObj->status = "invalid_phone_number";
                                                $JSON = json_encode($myObj);
                                                http_response_code(401);
                                                echo $JSON;
                                                exit;
                                            }
                                        } else {
                                            $myObj = new stdClass();
                                            $myObj->status = "invalid_password";
                                            $JSON = json_encode($myObj);
                                            http_response_code(401);
                                            echo $JSON;
                                            exit;
                                        }
                                    } else {
                                        $myObj = new stdClass();
                                        $myObj->status = "invalid_name";
                                        $JSON = json_encode($myObj);
                                        http_response_code(401);
                                        echo $JSON;
                                        exit;
                                    }
                                } else {
                                    $myObj = new stdClass();
                                    $myObj->status = "invalid_matric_no";
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
        //-------------------------------------------
    } else {
        $myObj = new stdClass();
        $myObj->status = "error";
        $JSON = json_encode($myObj);
        http_response_code(401);
        echo $JSON;
        exit;
    }
?>