<?php
session_start();
if(ISSET($_SESSION['company_id'])){
$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$sql = 'SELECT title,price FROM product WHERE id='.$_GET['product_id'].';';
$result = $conn->query($sql);
if($result){
 $row = $result->fetch_assoc();
 
 $sql = 'UPDATE transaction SET status="Deleted - Product '.$row['title'].' Price'.$row['price'].'",product_id=-1 WHERE product_id='.$_GET['product_id'];
$conn->query($sql);
 
 $sql = 'DELETE FROM product WHERE id='.$_GET['product_id'];
$result = $conn->query($sql);
 
$sql = 'SELECT url FROM product_image WHERE product_id='.$_GET['product_id'].';';
$result = $conn->query($sql);
if($result){
while($row = $result->fetch_assoc()){
 if(strpos($row['url'],'https://')==-1){
  unlink('product_images/'.$row['url']); 
 } 
}
}

if($result){
$sql = 'DELETE FROM product_image WHERE product_id='.$_GET['product_id'].';';
$result = $conn->query($sql);
if($result){
$sql = 'DELETE FROM review WHERE product_id='.$_GET['product_id'].';';
$result = $conn->query($sql);
if($result){
$sql = 'DELETE FROM feeling WHERE product_id='.$_GET['product_id'].';';
$result = $conn->query($sql);
}
}
}
 
 $sql = 'SELECT id FROM product WHERE id>'.$_GET['product_id'].';';
$result = $conn->query($sql);
if($result){
while($row = $result->fetch_assoc()){
 $sql = 'UPDATE product SET id='.($row['id']-1).' WHERE id='.$row['id'];
 $conn->query($sql);
 $sql = 'UPDATE product_image SET product_id='.($row['id']-1).' WHERE product_id='.$row['id'];
 $conn->query($sql);
  $sql = 'UPDATE review SET product_id='.($row['id']-1).' WHERE product_id='.$row['id'];
 $conn->query($sql);
  $sql = 'UPDATE feeling SET product_id='.($row['id']-1).' WHERE product_id='.$row['id'];
 $conn->query($sql);
}
}

 
}
$conn->close();
echo $result;
}
?>
