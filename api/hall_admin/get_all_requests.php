<?php 
    session_start(); // Start sessions

    require dirname(__FILE__) . '/db_connection/db_conn.php'; // Import db conn script

    error_reporting(0); // Turn off error reporting

    if (isset($_SESSION['user_id']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['role'])){ 
        if ($_SESSION['role'] === 'Student'){
            session_destroy(); // Destroy all session variables

            $myObj = new stdClass();
            $myObj->status = "role_error";
            $JSON = json_encode($myObj);
            http_response_code(401);
            echo $JSON;
            exit;
        } else if ($_SESSION['role'] === 'Admin'){
            // Session variables
            $user_id = $_SESSION['user_id'];
            $user_name = $_SESSION['name'];
            $email = $_SESSION['email'];
            $role = $_SESSION['role'];
            //-------------------------------

            $stmt = $conn->prepare("SELECT * FROM gate_pass_request WHERE approved = '' ORDER BY id DESC");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0){
                $all_gate_pass_requests = array();
                $account_details = array();

                while ($row = $result->fetch_assoc()){
                    array_push($all_gate_pass_requests, $row);   
                }

                foreach ($all_gate_pass_requests as $request){
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

                    if ($result->num_rows > 0){
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
                $myObj->status = "no_data_available";
                $JSON = json_encode($myObj);
                http_response_code(200);
                echo $JSON;
                exit;
            }
        }
    } else { 
        $myObj = new stdClass();
        $myObj->status = "invalid";
        $JSON = json_encode($myObj);
        http_response_code(401);
        echo $JSON;
        exit;
    }
