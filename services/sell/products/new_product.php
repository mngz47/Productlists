<?php
session_start();

include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/api.php';

include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/tools/newsletter/api.php';


if(ISSET($_SESSION['company_id'])){
    
$_SESSION['product_general_cache'] = 
$_POST['title'].';'.
$_POST['price'].';'.
$_POST['quantity'].';'.
$_POST['brand'].';'.
$_POST['gender'].';'.
$_POST['health_table'];

if(
general_field($_POST['title'],'Title') &&
digit_field($_POST['price'],'Price') &&
digit_field($_POST['quantity'],'Quantity') &&
general_field($_POST['brand'],'Brand') &&
$_POST['date_added']
){

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$sql = 'SELECT COUNT(id) AS size,id FROM product';
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$newId = $row['size']; 

$draft = (ISSET($_POST['draft']) && $_POST['draft']?'1':'0');

$sql = 'INSERT INTO product (id,title,quantity,brand,gender,health_table,price,date_added,company_id,discount,draft)'.
' VALUES ('.$newId.',"'.$_POST['title'].'",'.$_POST['quantity'].',"'.$_POST['brand'].'",'.$_POST['gender'].','.$_POST['health_table'].','.$_POST['price'].',"'.$_POST['date_added'].'",'.$_SESSION['company_id'].',0,'.$draft.');';
$result = $conn->query($sql);
if($result){
$log = '';

if(ISSET($_FILES['file']['tmp_name'])){
$f = $_FILES['file'];
for($a=0;$a<count($f['tmp_name']);$a++){
if(cover_image($f['name'][$a])){
$t = trim($f['name'][$a]);
$c = 0;
while(file_exists('product_images/'.$t)){
$t = $c.'_'.$f['name'][$a];
$c++;
}
$sql = 'INSERT INTO product_image (id,product_id,url) VALUES (0,'.$newId.',"'.$t.'")';
$result = $conn->query($sql);
if($result){
move_uploaded_file($f['tmp_name'][$a],'product_images/'.$t);
}else{
$log.=mysqli_error($conn);
}
}
}
}

if(ISSET($_POST['img_url'])){
for($a=0;$a<count($_POST['img_url']);$a++){
$sql = 'INSERT INTO product_image (id,product_id,url) VALUES (0,'.$newId.',"'.$_POST['img_url'][$a].'")';
$result = $conn->query($sql);
if(!$result){
$log.=($log?'>>':'').mysqli_error($conn);
}
}
}

$sql = 'INSERT INTO feeling (id,product_id,love,angry,happy) VALUES (0,'.$newId.',0,0,0)';
$result = $conn->query($sql);
if(!$result){
$log.=($log?'>>':'').mysqli_error($conn);
}

$_SESSION['product_general_cache'] = null;
$conn->close();
$_SESSION['response'] = 'Success'.($log?' : Failure : '.$log:'');

echo '<a href="product_parameters.php?product_id='.$newId.'" >next</a>';

include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/tools/newsletter/index.php';

}else{
$_SESSION['response'] = 'Failure : '.mysqli_error($conn);
header('Location:/services/sell/products/product_general.php');
}
}else{
echo $_POST['date_added'];
}
}else{
	if(ISSET($_SESSION['customer_id'])){
header('Location:/services/sell/index.php');
}else{
	if(ISSET($_COOKIE['has_account'])){
header('Location:/member/signin_main.php');
	}else{
header('Location:/member/signup_main.php');
	}
}
}




?>
