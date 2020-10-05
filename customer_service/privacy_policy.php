<?php

session_start();

$LOCATION = 'customer_service/privacy_policy.php';

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Productlists Privacy Policy</title>
<link rel=stylesheet href=https://productlists.co.za/bootstrap.min.css />
<link rel=stylesheet href=https://productlists.co.za/style.css />
<link rel=stylesheet href=https://productlists.co.za/mobstyle.css />
<link rel=stylesheet href=https://productlists.co.za/feature/sign/style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/search/style.css />
<link rel=stylesheet href=https://www.productlists.co.za/scroll_style.css />


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
<script src=https://productlists.co.za/api.js ></script>
<script src=https://productlists.co.za/feature/search/api.js ></script>
<script src=https://productlists.co.za/feature/sign/api.js ></script>
<script src=https://productlists.co.za/services/sell/products/feature/option/api.js ></script>

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
	<h3>Privacy Policy</h3>
  <p>
    <strong>What information we collect?</strong><br>
Personal Information: First Name, Last Name, Email
Delivery Address: Country, State/Province, City, Postal Code, Address line 1, Address line 2,
 </p>
  <p>
    <strong>What we use the information for?</strong><br>
We use the primary information to identify the customer and associate transacting account to
person, we use your email to notify you about new content and keep you aware of your
transactions.
We use the delivery address also as the billing address, the information helps to generate a lawful
invoice.
  </p>
  <p>
    <strong>How do we keep your information safe?</strong>
We make use of TLS to protect your password and we use payment vendors such as Payfast and
PayPal to process payments and avoid keeping credit card or banking information.
We do not sell personal information to any third-party sources.
  </p>
  <p>
    <strong>Do we make use of cookies?</strong><br>
Yes. Cookies are small files that a site or its service provider transfers to your computers hard drive
through your Web browser (if you have allowed it via your settings). This enables the sites or service
providers systems to recognize your browser and capture and remember certain information.
<br>
We use cookies to help us remember and process the items in your shopping cart, understand and
save your preferences for future visits and compile aggregate data about site traffic and site
interaction so that we can offer better site experiences and tools for you in the future.
  </p>
  <p>
    <strong>How long do we retain your information?</strong><br>
We will retain your personal information for as long as it is necessary to fulfil the purposes
outlined in this Privacy Policy, unless a longer retention period is required or permitted by tax,
accounting or other applicable laws.
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
