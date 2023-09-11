<?php 
    session_start(); // Start sessions

    require dirname(__FILE__) . '/db_connection/db_conn.php'; // Import db conn script

    if (isset($_POST['search'])){
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

                $search = $_POST['search']; // Search

                // Validate details
                if (!isset($search)){
                    $myObj = new stdClass();
                    $myObj->status = "invalid_search";
                    $JSON = json_encode($myObj);
                    http_response_code(401);
                    echo $JSON;
                    exit;
                } else {
                    $sanitized_search = "%" . filter_var($search, FILTER_SANITIZE_STRING) . "%";

                    if (strlen($sanitized_search) >= 1){
                        $stmt = $conn->prepare("SELECT id, name, email FROM account_details WHERE matric_no LIKE ? AND role = 'Student'");
                        $stmt->bind_param("s", $sanitized_search);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0){
                            $account_details = array();
                            $all_gate_pass_requests = array();
                            $user_id_array = array();
                            $account_details_x = array();

                            while ($row = $result->fetch_assoc()){
                                array_push($account_details, $row);   
                            }

                            foreach ($account_details as $detail){
                                $user_id_x = $detail["id"];
            
                                $stmt = $conn->prepare("SELECT * FROM gate_pass_request WHERE user_id = ? AND approved = 'false' ORDER BY id DESC");
                                $stmt->bind_param("i", $user_id_x);
                                $stmt->execute();
                                $result = $stmt->get_result();
            
                                if ($result->num_rows > 0){
                                    while ($row = $result->fetch_assoc()){
                                        array_push($all_gate_pass_requests, $row);   
                                    }
                                }
                            }

                            if (count($all_gate_pass_requests) > 0){
                                foreach ($all_gate_pass_requests as $request){
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
                                    $stmt->bind_param("i", $request["user_id"]);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0){
                                        while ($row = $result->fetch_assoc()){
                                            $row += array("request_id" => $request["id"]);
                                            $row += array("destination_state" => $destination_state);
                                            $row += array("destination_city" => $destination_city);
                                            $row += array("date_of_exit" => $date_of_exit);
                                            $row += array("date_of_return" => $date_of_return);
                                            $row += array("time_of_exit" => $time_of_exit);
                                            $row += array("time_of_return" => $time_of_return);
                                            $row += array("guardian_name" => $guardian_name);
                                            $row += array("guardian_phone_number" => $guardian_phone_number);
                                            $row += array("date_requested" => $date_requested);
                                            array_push($account_details_x, $row += array("date_requested" => $request["date_created"]));  
                                        }
                                    }
                                }

                                $myObj = new stdClass();
                                $myObj->status = "successful";
                                $myObj->result = $account_details_x;
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
                        } else {
                            $myObj = new stdClass();
                            $myObj->status = "no_data_available";
                            $JSON = json_encode($myObj);
                            http_response_code(200);
                            echo $JSON;
                            exit;
                        }
                    } else {
                        $myObj = new stdClass();
                        $myObj->status = "invalid_search";
                        $JSON = json_encode($myObj);
                        http_response_code(401);
                        echo $JSON;
                        exit;
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
?>