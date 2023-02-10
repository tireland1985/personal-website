<?php
namespace PortfolioSite\Controllers;
use \PHPMailer\PHPMailer\PHPMailer;
use \PHMailer\PHPMailer\Exception;

class contactController{
    public function __construct(){

    }

    public function form(){

        return [
            'template' => 'contact-form.html.php',
            'title' => 'Contact',
            'variables' => []
        ];
    }

    public function formSubmit(){

        $username = $MAILER_USERNAME; //get from secrets file
        $password = $MAILER_PASSWORD; //get from secrets file
        $myEmail = $MAILER_EMAIL; //get from secrets file

        require '../../PHPMailer/src/Exception.php';
        require '../../PHPMailer/src/PHPMailer.php';
        require '../../PHPMailer/src/SMTP.php';

        if(isset($_POST['submit'])){
	        $mail = new PHPMailer(true);
	
	        $mail->SMTPDebug = 0;
	
	        $mail->Host = 'v.je'; //use real domain, not v.je as dev env does not have smtp 
	        $mail->SMTPAuth = true;
	        $mail->Username = $username;
	        $mail->Password = $password;
	        $mail->SMTPSecure = 'tls';
	        $mail->Port = '587';
	
	        $mail->setFrom($username, 'Mailer');
	        $mail->addAddress($myEmail);
	        $mail->addReplyTo($_POST['email'], $_POST['name']);
	
	        $mail->isHTML(true);
	        $mail->Subject = 'Contact request from: ' . $_POST['name'];
	        $mail->Body = $_POST['message'];
	
	        try {
		        $mail->send();
		        echo 'Your message has been sent';
	        }
	        catch (\Exception $e) {
		        echo "Message sending failed. Error: {$mail->ErrorInfo}";
        	}
        }
        else {
	        echo 'There appears to be an issue with the contact form, please try again later';
        }
    }
}