<?php
include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/config.php');

if(ISSET($_SESSION['customer_id'])){
  
$sql = 'UPDATE customer SET '.$_GET['fieldname'].'='.str_replace('\"','"',$_GET['fieldval']).' WHERE id='.$_GET['id'].';';
$result = $conn->query($sql);
$conn->close();
echo ($result?'success':'error with query : '.$sql);
}
?>
