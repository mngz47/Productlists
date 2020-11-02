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

if(ISSET($_POST['email']) && ISSET($_POST['text']) && ISSET($_POST['date_added'])   && !ISSET($_SESSION['feedback_lock'])){

$pattern = "/[0-9a-zA-Z]{3,10}@[0-9a-zA-Z]{3,10}\.(com|co\.za)/";

if(preg_match($pattern, $_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');
$sql = 'SELECT id FROM customer WHERE email_cell="'.$_POST['email'].'"';
$result = $conn->query($sql);
if($result){
    if($row = $result->fetch_assoc()){	
        
    }else{
        $l_s = ['A','B','C','D','E'];
		$l_l = ['f','g','h','i','j'];
		
		$password = $l_S[rand(0,4)].rand(100,1000).$l_l[rand(0,4)];
        
    $sql = 'SELECT COUNT(id) AS size FROM customer';
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
        
        if(p_mail($_POST['email'],'Productlists Login Password','We have automatically created your membership - your password: '.$password)){
          
           $sql = 'INSERT INTO customer (id,email_cell,password,balance,date_added) VALUES ('.$row['size'].',"'.$_POST['email'].'","'.$password.'",0,"'.$_POST['date_added'].'")';
           $result = $conn->query($sql);
        
          if($result){
            $_SESSION['response'] = 'Success - '; 
          }else{
            $_SESSION['response']  = 'Try Again - ';
          }
        }else{
            $_SESSION['response']  = 'Not Valid Email';
        }
    }
}

mail('mngz636@gmail.com','Productlists Feedback',$_POST['email'].'>>>'.$_POST['text']);
$_SESSION['feedback_lock'] = 'active';

} else{
$_SESSION['response'] = 'Failure - email incorrect format.';
}
}else{
$_SESSION['response'] = 'Something went wrong - ';
}

header('Location:/index.php');
?>
