<?php
if(ISSET($_COOKIE['auto_login']) && $_COOKIE['auto_login']!=''){
setcookie('auto_login','',time() + (86400 * 30 * 7),'/');
echo 'auto login disabled';
}else{
session_start();
setcookie('auto_login',$_SESSION['customer_id'],time() + (86400 * 30 * 7),'/');
echo 'auto login enabled';
}
?>
