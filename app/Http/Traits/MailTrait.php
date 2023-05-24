<?php

namespace App\Http\Traits;

trait MailTrait
{
    // this is a bad a prctice, but this if ur client is Mnofy and don't want to pay for a mail server
    // this is a bad a prctice, but this if ur client is Mnofy and don't want to pay for a mail server
    // this is a bad a prctice, but this if ur client is Mnofy and don't want to pay for a mail server
    // this is a bad a prctice, but this if ur client is Mnofy and don't want to pay for a mail server
    // this is a bad a prctice, but this if ur client is Mnofy and don't want to pay for a mail server
    
    public function sendMailTrait($to, $subject, $message, $from, $name = null, $email = null)
    {

        $subject = 'New message from AGS website';
        // prepare email body text
        $Body = "";
        $Body .= "Name: ";
        $Body .= $name;
        $Body .= "\n";
        $Body .= "Email: ";
        $Body .= $email;
        $Body .= "\n";
        $Body .= "Message: ";
        $Body .= $message;
        $Body .= "\n";

        // send email
        mail($to, $subject, $Body, "From:" . $from);
    }
}
