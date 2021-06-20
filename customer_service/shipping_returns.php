<?php

session_start();

$LOCATION = 'customer_service/shipping_returns.php';

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Productlists Shipping & Returns</title>
<link rel=stylesheet href=https://<?php echo $HOME_; ?>/bootstrap.min.css />
<link rel=stylesheet href=https://<?php echo $HOME_; ?>/style.css />
<link rel=stylesheet href=https://<?php echo $HOME_; ?>/mobstyle.css />
<link rel=stylesheet href=https://<?php echo $HOME_; ?>/feature/sign/style.css />
<link rel=stylesheet href=https://<?php echo $HOME_; ?>/feature/search/style.css />
<link rel=stylesheet href=https://<?php echo $HOME_; ?>/scroll_style.css />


<link rel=stylesheet href=https://listro.co.za/style.css />

<link rel="shortcut icon" type="image/png" href="logo.png" />
<meta name="viewport" content="width=device-width" />
<meta name="description" content="Technology Firm - working towards solutions to free the youth. PRODUCTLISTS" />
<meta name="keywords" content="productlists,product,sell,discount,cheap,latest,best selling,local,mzansi,south africa,pietermaritzburg,kzn,online shopping,technology,share files,music,documents,content,learn,education,information" />
<meta name="autor" content="Mongezi Mafunda" />
</head>
<body>
<script>
<?php 

echo (ISSET($_GET['result'])?($_GET['result']?"alert('success');":"alert('failure');"):""); 

if(ISSET($_SESSION['response'])){
	echo 'alert("'.$_SESSION['response'].'");';
	$_SESSION['response'] = null;
}

?>
</script>
<script src=https://<?php echo $HOME_; ?>/api.js ></script>
<script src=https://<?php echo $HOME_; ?>/feature/search/api.js ></script>
<script src=https://<?php echo $HOME_; ?>/feature/sign/api.js ></script>
<script src=https://<?php echo $HOME_; ?>/services/sell/products/feature/option/api.js ></script>

<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/header_3.php'); ?>

<div class=p_cont >

<div class="body row" >
<div class="col-sm-3" >
<div id=left_pane class="left_pane" >
<div id=left_pane_1 >
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four.php'); ?>
</div>
	<div id=left_pane_3 >
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four_control.php'); ?>
</div>
<div id=left_pane_2 style="display:none;" >
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/relationship.php'); ?>
</div>
</div>
</div>
<div class="content col-sm-6" >
<a name=main ></a>
<div id="main" class=main >
<h3>Shipping & Returns</h3>
<p>
<strong>SHIPPING</strong><br>
1. Product ordered from local South African supplier will take 3-5 days whereas product from
Europe or China is expected to take 14-20 days.<br>
2. Shipping method may still be automatically changed to lower costs and accommodate
location of the supplier.<br>
3. If you are experiencing delays, we advise you wait for at least three days before contacting
support given that you’re unhappy with the status of the transaction.<br>
4. If the product is not delivered within specified time and is late by more than 3 days, then the
delivery is free.<br>
5. If the shipping is late by more than 7 working days you are liable to claim your full refund via
support.<br>
</p>
<p>
<strong>RETURNS</strong><br>
1. You have limited time of a week after receiving the product to detect any
damages and return it.<br>
2. You will have to take images of the damaged product and send an email then
you will have to ship product to specified address to claim your refund.<br>
SKU code of product must be visible on image sent to support to avoid scams.
3. If we are not convinced from the images you send that the product is damaged then we have the
right to decline return request.<br>
4. Product may only be returned if damaged or not in condition as specified on the website.<br>
5. If product parameters such as colour or size are incorrect because of customer error, then you can
not return the product.<br>
6. Products will have to be shipped back to the supplier before a refund is made with
additional return shipping costs.<br>
</p>
</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
<div id=right_pane_6 >
</div>

</div>
</div>
</div>


</div>

<?php
 include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/footer_4.php'); 
 ?>
</body>
</html>
<?php
$conn->close();
?>
