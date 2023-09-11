<?php 
    session_start(); // Start sessions

    require dirname(__FILE__) . '/db_connection/db_conn.php'; // Import db conn script

    if (isset($_POST['email']) && isset($_POST['password'])){
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING); // Email
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING); // Password

        // Validate email and password
        if (empty($email)){
            $myObj = new stdClass();
            $myObj->status = "missing_email";
            $JSON = json_encode($myObj);
            http_response_code(401);
            echo $JSON;
            exit;
        } else {
            if (empty($password)){
                $myObj = new stdClass();
                $myObj->status = "missing_password";
                $JSON = json_encode($myObj);
                http_response_code(401);
                echo $JSON;
                exit;
            } else {
                $stmt = $conn->prepare("SELECT * FROM account_details WHERE email = ? AND user_password = ? AND role = 'Admin'");
                $stmt->bind_param("ss", $email, $password);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0 && $result->num_rows === 1){
                    $user_records = $result->fetch_assoc(); // User details

                    $_SESSION['user_id'] = $user_records["id"];
                    $_SESSION['name'] = $user_records["name"];
                    $_SESSION['email'] = $user_records["email"];
                    $_SESSION['role'] = $user_records["role"];

                    $myObj = new stdClass();
                    $myObj->status = "login_successful";
                    $JSON = json_encode($myObj);
                    http_response_code(200);
                    echo $JSON;
                    exit;
                } else {
                    $myObj = new stdClass();
                    $myObj->status = "account_does_not_exist";
                    $JSON = json_encode($myObj);
                    http_response_code(404);
                    echo $JSON;
                    exit;
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