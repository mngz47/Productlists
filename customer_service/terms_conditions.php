<?php

session_start();

$LOCATION = 'customer_service/terms_conditions.php';

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Productlists Terms & Conditions</title>
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
<div id=left_pane_2 style="display:none;" >
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/relationship.php'); ?>
</div>
</div>
</div>
<div class="content col-sm-6" >
<a name=main ></a>
<div id="main" class=main >
<h3>Terms & Conditions</h3>
<p>
<strong>1. Conditions of Use</strong><br>
Welcome to our online store! Productlists (pty)ltd provide its products and services to you subject to
the following conditions. If you visit or shop within this website, you should accept these terms and
conditions. Please read them carefully.
</p>
<p>
<strong>2. Membership</strong><br>
2.1 If you use this site, you are responsible for maintaining the confidentiality of your account and
password and for restricting access to your computer.<br>
2.2 You agree to accept responsibility for all activities that occur under your account or password.<br>
2.3 If you are under 18, you may use our website only with involvement of a parent or legal
guardian.<br>
2.4 Productlists (pty)ltd reserve the right to refuse service, terminate accounts, remove or edit
content, or cancel orders at their sole discretion.<br>
2.5 Your registration as a Member on this website is based on your actual shipping needs.<br>
2.6 The balance of your account can only be used to purchase items of this website. Please, protect
your account information.<br>
</p> 
<p>
<strong>3.Payment</strong><br>
3.1 If we do not receive payment, your transaction will be deleted after 5 working days.<br>
3.2 You warrant that you are fully authorised to use the credit card supplied for purposes of
performing transactions.<br>
3.3 You also warrant that your credit card has enough available funds to cover all the costs of
transactions.<br>
</p>
<p>
<strong>4.Copyright</strong><br>
4.1 All content included on this site, such as text, articles, graphics, logos, banners, photographs,
button icons, images, audio clips, digital downloads, data compilations, and software, is the property
of Productlists (pty)ltd, or third party and protected by international copyright laws.<br>
4.2 We mention the author of the resource either on the link of the resource or on the webpage.
The compilation of all content on this site is the exclusive property of Productlists (pty)ltd or third
party contributors.<br>
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
