<?php
$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

if(ISSET($_SESSION['company_id'])){

$no_of_t;

$sql = 'SELECT count(id) as no_of_t FROM transaction WHERE company_id='.$_SESSION['company_id'];
$result = $conn->query($sql);
if($result){
$row = $result->fetch_assoc();
$no_of_t = $row['no_of_t'];
}

$sql = 'SELECT directory FROM company WHERE id='.$_SESSION['company_id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$directory = $row['directory'];

echo
"<div class='footer scroll_text_cont' >".
"<a href=https://www.productlists.co.za/services/sell/company_transactions.php class=scroll_text id=transaction_btn >transactions".($no_of_t?'<span id=no_of_transaction >'.$no_of_t.'</span>':'')."</a> ".
"<a href=https://www.productlists.co.za/services/sell/products/products.php?company=".$_SESSION['company_id']." class=scroll_text >view products</a>".
"<a href=https://www.productlists.co.za/services/sell/products/product_general.php class=scroll_text >new product</a>".
"<span class=scroll_text ><input class=space type=checkbox id=directory_act onchange=xml_response(sendreq('services/directory_listings/feature/activate_directory.php?switch=".($directory)."')); ".($directory?'checked':'')."  />activate directory</span>".
"</div>";
	
}else if(ISSET($_SESSION['customer_id'])){

$no_of_t;

$sql = 'SELECT count(id) as no_of_t FROM cart WHERE customer_id='.$_SESSION['customer_id'];
$result = $conn->query($sql);
if($result){
$row = $result->fetch_assoc();
$no_of_t = $row['no_of_t'];
}


$sql = 'SELECT directory,balance FROM customer WHERE id='.$_SESSION['customer_id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$directory = $row['directory'];

echo
"<div class='footer scroll_text_cont' >".
"<a href=https://www.productlists.co.za/feature/balance/index.php class='highlight_green' >balance=R".($row["balance"])."</a>".
"<a href=https://www.productlists.co.za/member/customer_transaction.php class=scroll_text id=transaction_btn >transactions".($no_of_t?'<span id=no_of_transaction >'.$no_of_t.'</span>':'')."</a>".
"<span class=scroll_text ><input class=space type=checkbox id=keep_logged_in onchange=auto_login() ".(ISSET($_COOKIE['auto_login']) && $_COOKIE['auto_login']!=''?'checked':'')."  />keep me logged in</span>".
"<span class=scroll_text ><input class=space type=checkbox id=directory_act onchange=xml_response(sendreq('services/directory_listings/feature/activate_directory.php?switch=".($directory)."')); ".($directory?'checked':'')."  />activate directory</span>".
"</div>";

}
?>
