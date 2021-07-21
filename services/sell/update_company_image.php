<?php

function isImage($url){
return (strpos($url,'jpg')!==-1 || strpos($url,'JPG')!==-1 ||  strpos($url,'png')!==-1 ||  strpos($url,'gif')!==-1);
}

 session_start();
 if(ISSET($_SESSION['company_id'])){
 $conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');
   
   if($_FILES['logo']['name'] && isImage($_FILES['logo']['name'])){
   $sql = 'SELECT logo FROM company WHERE id='.$_SESSION['company_id'];
   $result = $conn->query($sql);
   $row = $result->fetch_assoc();
  
   unlink('company_images/'.$row['logo']); 
   
   $logo = $_FILES['logo']['name'];
    
   $c = 0;
   while(file_exists('company_images/'.$logo)){
   $logo = $c.'_'.$_FILES['logo']['name'];
   $c++;
   }
   
   move_uploaded_file($_FILES['logo']['tmp_name'],'company_images/'.$logo);
   
   $sql = 'UPDATE company SET logo="'.$logo.'" WHERE id='.$_SESSION['company_id'];
   $result = $conn->query($sql);
   echo ($result?'success':'failure');
   }
   
 $conn->close();  
}
?>
