

<?php



function notify_password($email, $password) {
// $email and $message are the data that is being
// posted to this page from our html contact form
$message = "Your password has been changed to ".$password."\r\n".
        "Please change it next time you log in.\r\n";

// When we unzipped PHPMailer, it unzipped to
// public_html/PHPMailer_5.2.0
require("PHPMailer/PHPMailerAutoload.php");
require("PHPMailer/class.PHPMailer.php");


$mail = new PHPMailer();

// set mailer to use SMTP

$mail->SmtpConnect(
    array(
        "tls" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    )
);
$mail->SMTPDebug = 2;    // Enable verbose debug output
$mail->isSMTP(); // Set mailer to use SMTP
$mail->Host = 'smtp.googlemail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;   // Enable SMTP authentication
$mail->Username = '';  // SMTP username
$mail->Password = '';    // SMTP password
$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; // TCP port to connect to
$mail->setFrom('danhpham312@gmail.com', 'Mailer'); // Add set from id
$mail->addAddress('danhpham312@gmail.com', 'da');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->isHTML(true);   // Set email format to HTML
$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
}

?>
