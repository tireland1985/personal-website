<?php
  // message vars
  $msg = '';
  $msg_class = '';
  $sendError = false;

  // e-mail vars
  $email = 'user@email.com';

  // check for submit
	if(isset($_POST['submit']))
	{

    // get & filter data
    $args = array(
      'name' => FILTER_SANITIZE_STRING,
      'email' => FILTER_SANITIZE_EMAIL,
      'message' => FILTER_SANITIZE_STRING
    );

    $data = filter_input_array(INPUT_POST, $args); // populate array with sanitized data

    // if every field is filled
    //email & other data is correct
    //recipient vars
    $subject = 'Contact request from '. $data['name'];
    $body = '<h2>Contact Reqeust</h2>'.
      '<p><b>Name: </b>'.$data['name'].'</p>'.
      '<p><b>Email: </b><p>'.$data['email'].'</p>'.
      '<h4>Message: </h4><p>'.$data['message'].'</p>';

    // email headers
    $headers = "MIME-Version: 1.0"."\r\n";
    $headers .= "Content-Type:text/html;charset=UTF-8"."\r\n";

    // additional headers
    $headers .= "From: ".$data['name']."<".$data['email'].">"."\r\n";

    // mailing engine
    if (mail($email, $subject, $body, $headers)) {
      // every mail var was set properly and message was sent
      $msg = 'Message sent!';
      $msg_class = 'green';
    } else {
      $msg = "Message wasn't sent! Check your internet connection and try again.";
      $msg_class = 'red';
    }
  }
?>