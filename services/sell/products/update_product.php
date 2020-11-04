<?php
session_start();
if(ISSET($_SESSION['company_id'])){
$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

if($_GET['fieldname']==='price'){
$sql = 'UPDATE product SET discount=((price-'.$_GET['fieldval'].')/price*100) WHERE id='.$_GET['id'].';';
$result = $conn->query($sql);
}

$sql = 'UPDATE product SET '.$_GET['fieldname'].'='.str_replace('\"','"',$_GET['fieldval']).' WHERE id='.$_GET['id'].';';
$result = $conn->query($sql);

$conn->close();
echo ($result?'success':'error with query : '.$sql);
}
?>
