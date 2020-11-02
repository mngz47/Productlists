<?php

// include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/api.php';

// session_start();

// p_mail('mngz636@gmail.com','Productlists Feedback',$_POST['email'].'>>>'.$_POST['text']);

//-----------------------------------

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://rapidapi.p.rapidapi.com/email/send",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "{
    \"recipient\": \"mngz636@gmail.com\",
    \"sender\": \"admin@productlists.com\",
    \"subject\": \"Subject of Email\",
    \"message\": \"Body of Email\"
}",
	CURLOPT_HTTPHEADER => [
		"content-type: application/json",
		"x-rapidapi-host: fapimail.p.rapidapi.com",
		"x-rapidapi-key: f4d041c051msh25be51a74caa34bp14fd74jsn556f558ca5da"
	],
]);

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
