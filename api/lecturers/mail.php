<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require './PHPMailer/Exception.php';
    require './PHPMailer/PHPMailer.php';
    require './PHPMailer/SMTP.php';

    $mail = new PHPMailer(TRUE);

    try {
        $mail->setFrom('babcockexeat@gmail.com', 'Babcock exeat'); // From email (The email that will be used to send the mail)
        $mail->addAddress('alfredmichael819@gmail.com', 'Michael Alfred'); // To email (The email that the mail is going to be sent to)
        $mail->Subject = 'Gate Pass Request';
        $mail->Body = 'Your gate pass request has been approved by Mr John!';
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = 'ssl';
        $mail->Username = 'babcockexeat@gmail.com';
        $mail->Password = 'eopyobspnnqfmuga';
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