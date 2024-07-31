<?php
// Set the email address where the form submissions will be sent
$receiving_email_address = 'contact@example.com';

// Check if the PHP Email Form library exists and include it
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

// Validate and sanitize form inputs
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

// Check if the email is valid
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email address!');
}

// Create a new instance of PHP_Email_Form
$contact = new PHP_Email_Form;
$contact->ajax = true;

// Set the form data to be sent
$contact->to = $receiving_email_address;
$contact->from_name = $name;
$contact->from_email = $email;
$contact->subject = $subject;

// Add form messages with labels
$contact->add_message($name, 'From');
$contact->add_message($email, 'Email');
$contact->add_message($message, 'Message', 10);

// Send the email and output the result
echo $contact->send();
?>
