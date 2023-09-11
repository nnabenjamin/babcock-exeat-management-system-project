<?php 
    session_start(); // Start sessions

    $mail = new PHPMailer(TRUE);
                                        
    try {
        $mail->setFrom('babcockexeat@gmail.com', 'Babcock exeat'); // From email (The email that will be used to send the mail)
        $mail->addAddress('alfredmichael819@gmail.com', 'Michael Alfred'); // To email (The email that the mail is going to be sent to)
        $mail->Subject = 'Gate Pass Request';
        $mail->Body = '<p><b>Hello ' . $student_name . ', Your gate pass request submitted on ' . $request_date . ' has been successfully approved by ' . $amin_name . '!</b></p>';
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = 'ssl';
        $mail->Username = 'babcockexeat@gmail.com';
        $mail->Password = 'yteqapbwdsxrwmkj';
        $mail->Port = 465;
        
        /* Enable SMTP debug output. */
        $mail->SMTPDebug = 2;
        
        $mail->send();
    } catch (Exception $e){
        echo $e->errorMessage();
    }

    catch (\Exception $e){
        echo $e->getMessage();
    }
?>