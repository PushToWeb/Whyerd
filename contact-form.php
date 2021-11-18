<?php
    $name = $_POST['name'];
    $visitor_email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    $email_from = 'contact@whyerd.com';
    $email_subject = "New Message from Whyerd - $subject";
    $email_to = 'bencze.levente011@gmail.com';

    $email_body = "User Name: " .$name ."\nUser Email: " .$visitor_email ."\nUser Subject: " .$subject ."\nUser Message:\n" .$message;

    $headers = "From: $email_from \r\n";
    $headers .= "Reply-To: $visitor_email \r\n";

    mail($email_to, $email_subject, $email_body, $headers);
    $goto_after_mail = "/";  
    echo $email_body;
    
    //header("Location: $goto_after_mail");

?>