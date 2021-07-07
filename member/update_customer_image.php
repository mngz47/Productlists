 <?php
 session_start();
 if(ISSET($_SESSION['customer_id'])){
 $conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');
   
   if($_FILES['p_p']['name']){
   $sql = 'SELECT p_p FROM customer WHERE id='.$_SESSION['customer_id'];
   $result = $conn->query($sql);
   $row = $result->fetch_assoc();
  
   unlink($row['p_p']); 
   
   $p_p = 'customer_images/'.$_FILES['p_p']['name'];
   
   $c = 0;
   while(file_exists($p_p)){
   $p_p = 'customer_images/'.$c.'_'.$_FILES['p_p']['name'];
   $c++;
   }
   
   move_uploaded_file($_FILES['p_p']['tmp_name'],$p_p);
   
   $sql = 'UPDATE customer SET p_p="'.$p_p.'" WHERE id='.$_SESSION['customer_id'];
   $result = $conn->query($sql);
   header('Location:/productlists/index.php?result='.$result);
   }
 $conn->close();  
}
?>
