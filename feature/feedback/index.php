<?php

// include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/api.php';

// session_start();

// p_mail('mngz636@gmail.com','Productlists Feedback',$_POST['email'].'>>>'.$_POST['text']);

//-----------------------------------

$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://rapidprod-sendgrid-v1.p.rapidapi.com/mail/send",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "{  \"personalizations\": [    {      \"to\": [        {          \"email\": \"mngz636@gmail.com\"        }      ],      \"subject\": \"Hello, World!\"    }  ],  \"from\": {    \"email\": \"from_address@example.com\"  },  \"content\": [    {      \"type\": \"text/plain\",      \"value\": \"Hello, World!\"    }  ]}",
	CURLOPT_HTTPHEADER => array(
		"accept: application/json",
		"content-type: application/json",
		"x-rapidapi-host: rapidprod-sendgrid-v1.p.rapidapi.com",
		"x-rapidapi-key: f4d041c051msh25be51a74caa34bp14fd74jsn556f558ca5da"
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}

//-------------------------------


?>
