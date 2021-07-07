<?php
session_start();
if(ISSET($_SESSION['customer_id'])){
$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');
$sql = 'UPDATE customer SET '.$_GET['fieldname'].'='.str_replace('\"','"',$_GET['fieldval']).' WHERE id='.$_GET['id'].';';
$result = $conn->query($sql);
$conn->close();
echo ($result?'success':'error with query : '.$sql);
}
?>
