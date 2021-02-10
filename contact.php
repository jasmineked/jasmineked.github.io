<?php

// users email address retreived form fields
$from = 'Demo contact form <demo@domain.com>';

// an email address that will receive the email with the output of the form
$sendTo = 'Jasmine K. Edwards <jked630@gmail.com>';

// subject of email 
$subject = 'New message from contact form';

// form field name & translations
//array variable name => text to appear in email
$fields = array('name' => 'Name', 'email' => 'Email', 'message' => 'Message');

// success message
$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';

// error message 
$errorMessage = 'There was an error while submitting the form. Please try again later.';

error_reporting(E_ALL & ~E_NOTICE);

try
{
     if(count($_POST) == 0) throw new \Exception('Form is empty');

     $emailText = "You have a new message from your contact form\n===========================\n";

     foreach ($_POST as $key => $value) {
         //if the field exists in the $fields array, include it in the email
         if(isset($fields[$key])) {
             $emailText .= "$fields[$key]: $value\n";
         }
     }
     // all the necessary headers for the email
     $headers = array('Content-Type: text/plain; charset="UTF-8";',
     'From: ' . $from,
     'Reply-To: ' .$_POST['email'],
     'Return-Path: ' . $from,
    );
    
    // send email
    mail($sendTo, $subject, $emailText, implode("\n, $headers"));

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

// if requested by AJAX request, retuen JSON response
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolwer($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $$encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}

// else just display the message
else {
    echo $responseArray['message'];
}
?>