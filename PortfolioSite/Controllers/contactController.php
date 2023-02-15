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

        $_SESSION['token'] = bin2hex(random_bytes(35));
        return [
            'template' => 'contact-form.html.php',
            'title' => 'Contact',
            'variables' => ['data[]' => 'data[]']
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

            $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
            if(!$token || $token !== $_SESSION['token']){
                //tokens do not match - display error
                die('A fatal error occurred.');
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            }
            //assuming tokens match, continue

            //filter provided data
            $args = array(
                'name' => FILTER_SANITIZE_STRING,
                'phone' => preg_replace('/[^0-9]/', '', $_POST['phone']),
                'email' => FILTER_SANITIZE_EMAIL,
                'message' => FILTER_SANITIZE_STRING
            );

            //populate 'data' array with sanitized information
            $data = filter_input_array(INPUT_POST, $args);

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
	        $mail->addReplyTo($data['email'], $data['name']);
	
	        $mail->isHTML(true);
	        $mail->Subject = 'Contact request from: ' . $data['name'];
	        $mail->Body = $data['message'] . '<br> Phone Number: ' . $data['phone'];
	
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
            'variables' => ['data[]' => 'data[]']
        ];
    }
}