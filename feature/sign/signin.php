<?php

include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/api.php';


if(ISSET($_POST['type']) && ISSET($_POST['email_cell']) && ISSET($_POST['password'])){
    
    //$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');
    // $conn = new mysqli('d6rii63wp64rsfb5.cbetxkdyhwsb.us-east-1.rds.amazonaws.com','muce70z5ukkwpv5d','bqvn5jp04wlmxu64','zyo1oodysira7ro5');
    // $conn = new mysqli($HOST_,$USER_,$PASS_,$DATABASE_);
  
    include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/config.php');
    
$sql = 'SELECT id,password FROM '.$_POST['type'].' WHERE email_cell="'.$_POST['email_cell'].'"';
$result = $conn->query($sql);

if($row = $result->fetch_assoc()){
    
if($row['password']==$_POST['password']){ 

$_SESSION[$_POST['type'].'_id']=$row['id'];
$_SESSION['response'] = 'success';

setcookie('has_account','true',time()+(86400 * 365),'/'); 

}else{
if(ISSET($_SESSION['forgot_password'])){

p_mail($_POST['email_cell'],'Productlists Login Password Reminder','Password : '.$row['password']);

}else{
$_SESSION['response'] = 'Wrong password - try again and if you still cannot remember we will email it to you.';
$_SESSION['forgot_password'] = 'yes';
}	
}	
}else{
$_SESSION['response'] = 'The email you have entered is not in our system. Double click to sign_in to company.'.$_POST['type'];		
}

if(ISSET($_GET['from'])){
    $r = '';
    if($row){
        if($row['password']==$_POST['password']){
            $r = $row['id'];    
        }else{
            $r = '-1';
        }
    }else{
            $r = '-1';
    }
    
    header('Location: https://www.listro.co.za/sign.php?member_id='.$r.'&to='.$_GET['from']);
}else{
   header('Location:/'.(ISSET($_SESSION['location_before_sign'])?$_SESSION['location_before_sign']:'index.php')); 
}


}

if(ISSET($_COOKIE['auto_login']) && $_COOKIE['auto_login'] && ISSET($_SESSION['customer_id'])){
$_SESSION['customer_id'] = $_COOKIE['auto_login'];
}


?>
