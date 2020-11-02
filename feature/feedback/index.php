<?php

// include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/api.php';

// session_start();

// p_mail('mngz636@gmail.com','Productlists Feedback',$_POST['email'].'>>>'.$_POST['text']);

//-----------------------------------

require 'vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun('f6f26b4383b27ab64c8c7921a387746b-ea44b6dc-07d85e16');
$domain = "sandboxc720bc57eb9e4e1db3d3473679e23e14.mailgun.org";

# Make the call to the client.
$result = $mgClient->sendMessage("$domain",
	array('from'    => 'Mailgun Sandbox <postmaster@sandboxc720bc57eb9e4e1db3d3473679e23e14.mailgun.org>',
		  'to'      => 'Mongezi <mngz636@gmail.com>',
		  'subject' => 'Hello Mongezi',
		  'text'    => 'Congratulations Mongezi, you just sent an email with Mailgun!  You are truly awesome! '));


//-------------------------------


?>
