<?php

include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/api.php';

session_start();

if(ISSET($_POST['email']) && ISSET($_POST['name']) && ISSET($_POST['date_added'])  && ISSET($_POST['p_p'])){

$pattern = "/[0-9a-zA-Z]{3,10}@[0-9a-zA-Z]{3,10}\.(com|co\.za)/";
if(preg_match($pattern, $_POST['email'])){

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');
$sql = 'SELECT id FROM customer WHERE email_cell="'.$_POST['email'].'"';
$result = $conn->query($sql);
if($result){
    if($row = $result->fetch_assoc()){	
        
        $_SESSION['customer_id'] = $row['id'];
        
        $_SESSION['sign_plugin'] = 1;
        
    }else{
        $l_s = ['A','B','C','D','E'];
		$l_l = ['f','g','h','i','j'];
		
		$password = $l_S[rand(0,4)].rand(100,1000).$l_l[rand(0,4)];
        
    $sql = 'SELECT COUNT(id) AS size FROM customer';
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
        
        $sql = 'INSERT INTO customer (id,p_p,name,email_cell,password,balance,date_added) VALUES ('.$row['size'].',"'.$_POST['p_p'].'","'.$_POST['name'].'","'.$_POST['email'].'","'.$password.'",0,"'.$_POST['date_added'].'")';
        $result = $conn->query($sql);
        
        $_SESSION['customer_id'] = $row['size'];
        
        if($result){
        p_mail($_POST['email'],'Productlists Login Password','We have automatically created your membership - your password: '.$password);
        
        $_SESSION['sign_plugin'] = 1;
        }
    }
}

$_SESSION['response'] = 'Success';
} else{
$_SESSION['response'] = 'Failure - email incorrect format.';
}
}else{
$_SESSION['response'] = 'Something went wrong - ';
}

?>