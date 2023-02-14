<?php
namespace PortfolioSite\Controllers;
use \PHPMailer\PHPMailer\PHPMailer;
use \PHMailer\PHPMailer\Exception;

class contactController{
    public function __construct(array $get, array $post){
        $this->get = $get;
        $this->post = $post;
    }

    public function form(){

        return [
            'template' => 'contact-form.html.php',
            'title' => 'Contact',
            'variables' => []
        ];
    }

    public function formSubmit(){
        // the folowing vatiables are defined in the configuration secrets file
        $username = constant('MAILER_USERNAME'); 
        $password = constant('MAILER_PASSWORD'); 
        $myEmail = constant('MAILER_EMAIL'); 

        require '../PHPMailer/src/Exception.php';
        require '../PHPMailer/src/PHPMailer.php';
        require '../PHPMailer/src/SMTP.php';

        if(isset($_POST['submit'])){

            $field_name = $_POST['name'];
            $field_email = $_POST['email'];
            $field_phone = $_POST['phone'];
            $field_message = $_POST['message'];

	        $mail = new PHPMailer(true);
	
	        $mail->SMTPDebug = 0;
	
	        $mail->Host = 'v.je'; //will not work in current development env due to no SMTP support - also requires real domain name
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
	        echo '<h2>There appears to be an issue with the contact form, please try again later</h2>';
            print_r($_POST);
        }

        return [
            'template' => 'contact-form.html.php',
            'title' => 'Contact',
            'variables' => [ 'field_name' => 'field_name',
                             'field_email' => 'field_email',
                             'field_phone' => 'field_phone',
                             'field_message' => 'field_message']
        ];
    }
}