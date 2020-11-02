<?php

include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/api.php';

session_start();

// p_mail('mngz636@gmail.com','Productlists Feedback',$_POST['email'].'>>>'.$_POST['text']);


$this->load->library('google');

try {
    $message = new Message();
    $message->setSender('admin@productlists.co.za');
    $message->addTo('mngz636@gmail.com');
    $message->setSubject('Productlists Feedback');
    $message->setTextBody(,$_POST['email'].'>>>'.$_POST['text']);
    $message->send();
    echo 'Mail Sent';
} catch (InvalidArgumentException $e) {
    echo 'There was an error';
}

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
