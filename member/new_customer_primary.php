<?php
include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/api.php';

session_start();

$_SESSION['customer_primary_cache'] =
    $_POST['name'].';'.
   $_POST['surname'].';'.
    $_POST['new_email'].';'.
   $_POST['new_password'].';'.
   $_POST['verification_code'];

if($_POST['name'] &&
   $_POST['surname'] &&
   $_POST['new_password'] &&
   filter_var($_POST['new_email'], FILTER_VALIDATE_EMAIL) &&
   $_POST['date_added'] &&
   $_POST['verification_code']==$_SESSION['customer_verification']
   ){
   
   $_SESSION['customer_verification'] = null;
   
   $voucher = 'Welcome to Productlists your R50 voucher has been loaded to your balance.';
   
   if(p_mail($_POST['new_email'],$voucher)){
   
   $p_p = '';
   
   if($_FILES['p_p']['name']){
   $p_p = $_FILES['p_p']['name'];
   
    $c = 0;
   while(file_exists('customer_images/'.$p_p)){
   $p_p = $c.'_'.$_FILES['p_p']['name'];
   $c++;
   }
   
   move_uploaded_file($_FILES['p_p']['tmp_name'],'customer_images/'.$p_p);
   }
   
   $conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');
   
   $sql = 'SELECT id FROM customer WHERE email_cell="'.$_POST['new_email'].'"';
   $result = $conn->query($sql);
   
   if($row = $result->fetch_assoc()){
       
       $_SESSION['response'] = 'Email already in use';
       header('Location:/'.$_SESSION['location_before_sign']);
       
   }else{
       
   $sql = 'SELECT COUNT(id) AS size FROM customer';
   $result = $conn->query($sql);
   $row = $result->fetch_assoc();
   $newId = $row['size']; 
   
   $sql = 'INSERT INTO customer (id,p_p,name,surname,email_cell,date_added,password,balance)'.
          ' VALUES ('.$newId.',"'.$p_p.'","'.$_POST['name'].'","'.$_POST['surname'].'","'.$_POST['new_email'].'","'.$_POST['date_added'].'","'.$_POST['new_password'].'",0);';
   $result = $conn->query($sql);
   
   $_SESSION['customer_id'] = $newId;
   $conn->close(); 
   
   setcookie('has_account','true',time()+(86400 * 365),'/');
   
   $_SESSION['response'] = 'success';
   
   mail('mngz636@gmail.com','Productlists New Member Notification',$_POST['name'].'>>'.$_POST['surname'].'>>'.$_POST['email_cell']);


   if(ISSET($_SESSION['active_checkout_payment'])){
     header('Location:/member/customer_location.php'); 
   }else{
	 header('Location:/'.(ISSET($_SESSION['location_before_sign'])?$_SESSION['location_before_sign']:'index.php'));  
   }
   }
   }else{
       $_SESSION['response'] = 'failure - we cannot reach your email.';
      header('Location:/'.$_SESSION['location_before_sign']);
   }  
}else{
   $_SESSION['response'] = 'failure - please try again.';
   header('Location:/'.$_SESSION['location_before_sign']);
}

?>
