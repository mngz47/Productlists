<?php

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

function getQueueDiscount($product_id,$price){
	$q_discount;
	$sql = 'SELECT COUNT(id) AS ii FROM queue WHERE product_id='.$product_id;
$result = $conn->query($sql);
	       if($result){
			   $q_row = $result->fetch_assoc();
			   
			   
		   if($q_row['ii']>0){
			   
                 $q_discount = 	$price - (($price/3)*($q_row['ii']/1000));
		   }
		   }
		   return ($q_discount?$q_discount:$price);
}

session_start();
if(ISSET($_SESSION['customer_id'])){
	setcookie('active_checkout_payment',$_GET['p'],time() + (86400 * 30 * 7),'/');
    setcookie('active_checkout_delivery',$_GET['d'],time() + (86400 * 30 * 7),'/');
	
	 if(ISSET($_SESSION['active_checkout_total'])){
     $_SESSION['active_checkout_total'] = null; 
     $_SESSION['active_checkout_payment'] = null;
     $_SESSION['active_checkout_delivery'] = null;
	 }
	
if(ISSET($_SESSION['cart']) && !empty($_SESSION['cart'])){

$products = explode('&',$_SESSION['cart']);

$product_title = '';

$total_products = 0;

$total_cost = 0;

$delivery = 0;

$sql = 'SELECT name,surname,email_cell,balance,country,state_province,city,postal_code,addressl1,addressl2 FROM customer WHERE id='.$_SESSION['customer_id'];
$result = $conn->query($sql);
if($row = $result->fetch_assoc()){
	
	
if(
ISSET($row['state_province']) && !EMPTY($row['state_province']) &&
ISSET($row['city']) && !EMPTY($row['city']) &&
ISSET($row['postal_code']) && !EMPTY($row['postal_code']) &&
ISSET($row['addressl1']) && !EMPTY($row['addressl1']) 
){
	
for($a=0;$a<count($products)-1;$a++){
$id = explode('/',$products[$a])[0];
$qty = explode('/',$products[$a])[1];
$params = explode('/',$products[$a])[2];

$total_products+=$qty;
		  
$sql = 'SELECT id,title,price,company_id,shipment_cost,bulk FROM product WHERE id='.$id;
$result = $conn->query($sql);

if($result){
$row2 = $result->fetch_assoc();

$product_title .= $row2['title'].';';
$total_cost+=(($row2['bulk']==1?getQueueDiscount($row2['id'],$row2['price']):$row2['price'])*$qty);
$delivery+=$row2['shipment_cost']*$qty;

}
}

$total_cost+=$delivery;

$_SESSION['date_of_cart'] = $_GET['date'];

if($_GET['p']=='balance'){

if($row['balance']>=$total_cost){
    $sql = 'UPDATE customer SET balance=(balance-('.$total_cost.'-ROUND('.$total_cost.'*0,03,-1))) WHERE id='.$_SESSION['customer_id'].';';
    $conn->query($sql);
    header('Location:/feature/shopping_cart/payment_response.php?result=1');

}else{
	$_SESSION['update_balance_for_checkout'] = 'feature/shopping_cart/payment_response.php';
	header('Location:/feature/balance/index.php');
	
}

}else if($_GET['p']=='paypal'){
	header('Location:/feature/shopping_cart/paypal_checkout.php?total='.$total_cost);
}else{
   $p_t = '';
	if($_GET['p']=='cc'){
   $p_t = 'cc';
    }else if($_GET['p']=='eft'){
   $p_t = 'eft';
    }
	
   header('Location:/feature/shopping_cart/pay_fast_api.php'.
	'?name='.$row['name'].
	'&surname='.$row['surname'].
	'&email='.$row['email_cell'].
	'&product_title='.$product_title.
	($p_t==''?'':'&payment_type='.$p_t).
	'&total='.$total_cost);
}

}else{
	$_SESSION['active_checkout_payment'] = $_GET['p'];
	$_SESSION['active_checkout_delivery'] = $_GET['d'];
	$_SESSION['response'] = 'Fill in information required to deliver product';
	header('Location:/member/customer_location.php');
}


}
$conn->close();	   

    
}else{
    $_SESSION['response'] = 'Shopping cart is empty';
	header('Location:/services/sell/products/products.php');
}
}else{
	
	if(ISSET($_COOKIE['has_account'])){
		$_SESSION['location_before_sign'] = 'feature/shopping_cart/checkout.php?p='.$_GET['p'].'&d='.$_GET['p'];
		header('Location:/member/signin_main.php');
	}else{
	$_SESSION['active_checkout_payment'] = $_GET['p'];
	$_SESSION['active_checkout_delivery'] = $_GET['d'];
	header('Location:/member/signup_main.php');	
	}
}


?>
