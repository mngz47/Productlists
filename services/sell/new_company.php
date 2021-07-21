<?php

session_start();

include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/api.php';

include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/api.php';


if(ISSET($_SESSION['customer_id'])){
	
$_SESSION['company_general_cache'] = 
$_POST['name'].';'.
$_POST['email_cell'].';'.
$_POST['password'];	

if(
   general_field($_POST['name'],'Name') &&
   
   email($_POST['email_cell']) &&
   
   general_field($_POST['password'],'Password') &&
   
     $_POST['date_added']
   ){
       
	if($_POST['verification_code']==$_SESSION['customer_verification'] || ISSET($_SESSION['admin_pass'])){
	  
   $logo = '';
   
   if($_FILES['logo']['name'] && cover_image($_FILES['logo']['name'])){
   $logo = $_FILES['logo']['name'];
   
   $c = 0;
   while(file_exists('company_images/'.$logo)){
   $logo = $c.'_'.$_FILES['logo']['name'];
   $c++;
   }
   
   move_uploaded_file($_FILES['logo']['tmp_name'],'company_images/'.$logo);
   }
   
   $conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');
   
   $sql = 'SELECT COUNT(id) AS size FROM company';
   $result = $conn->query($sql);
   $row = $result->fetch_assoc();
   $newId = $row['size']; 
   
   $sql = 'INSERT INTO company (id,logo,name,email_cell,password,date_added,member_id)'.
          ' VALUES ('.$newId.',"'.
		  $logo.'","'.
		  $_POST['name'].'","'.
		  $_POST['email_cell'].'","'.
		  $_POST['password'].'","'.
		  $_POST['date_added'].'",'.
		  $_SESSION['customer_id'].');';
   
   
   $result = $conn->query($sql);
   
   if($result){
   $_SESSION['company_general_cache'] = null;
   $_SESSION['company_id'] = $newId;
   $conn->close();
   
   $_SESSION['response'] = 'Success';
   header('Location:/services/sell/company_general.php');
   
   }else{
	   $_SESSION['response'] = 'Failure : ';
       header('Location:/services/sell/company_general.php');
   }
   }else{
	   $_SESSION['response'] = 'Incorrect verification code.';
       header('Location:/services/sell/company_general.php');
   }
}else{
    echo $_POST['date_added'];
}
}else{
	if(ISSET($_COOKIE['has_account'])){
header('Location:/member/signin_main.php');
	}else{
header('Location:/member/signup_main.php');
	}
}
?>
