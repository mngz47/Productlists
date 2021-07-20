<?php 

session_start();
$_SESSION['company_id'] = $_GET['company_id'];
header('Location:/index.php');

?>
