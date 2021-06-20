<?php

include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/config.php');

$LOCATION = 'customer_service/faq.php';

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Productlists FAQ</title>
<link rel=stylesheet href=bootstrap.min.css />
<link rel=stylesheet href=style.css />
<link rel=stylesheet href=mobstyle.css />
<link rel=stylesheet href=feature/sign/style.css />
<link rel=stylesheet href=feature/search/style.css />
<link rel=stylesheet href=scroll_style.css />


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
<script src=api.js ></script>
<script src=feature/search/api.js ></script>
<script src=feature/sign/api.js ></script>
<script src=services/sell/products/feature/option/api.js ></script>

<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/header_3.php'); ?>

<div class=p_cont >

<div class="body row" >
<div class="col-sm-3" >
<div id=left_pane class="left_pane" >
<div id=left_pane_1 >
<?php
      include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four.php'); 
?>
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
	<h3>Frequently Asked Questions</h3>
	    
	    <p>
<strong>What is the purpose of Productlists?</strong><br>
To sell local and international products, help lower cost of products through buying power queues,
help customers make better buying decisions through columns about product variance and the
market.
	    </p>
	    <p>
<strong>What are the benefits of using Productlists?</strong><br>
Time saving, feature intensive to help customers understand the market and make better buying
decisions.
We help lower shipping costs by making use of flat rate charges across different shipping companies.
By making a direct deposit and shopping from your balance you save us money on transaction fees
therefore we give the money back to you by giving you a 3% discount.
Buying Power Queue – allows you to buy a product at the same time as a group of people that
allows you to have price dropping leverage.
Reusable Shopping Cart – Stores the shopping cart checkout history and allows you to cut time by
simply reusing the previous shopping cart and helps you to monitor your buying patterns.
	</p>
	<p>
<strong>Where do you source your Product?</strong><br>
We primarily find South African suppliers on Instagram, but we list suppliers from Europe and Asia to
gain access to overall international market in terms of product variance and quality.
	</p>
	<p>
<strong>How do I buy items on Productlists?</strong><br>
You can add item to cart select delivery methods and payment methods then click checkout, this will
take you to delivery information section which will then allow you to make payment and complete
the transaction. You can check the status of your transaction via home page.
	</p>
	<p>
<strong>When Will I get the product I have ordered?</strong><br>
Product ordered from local South African supplier will take 3-5 days whereas product from Europe
or China is expected to take 14-20 days. If you are experiencing delays, we advise you to wait for at
least three days before contacting support given that you’re unhappy with the status of the
transaction.
	</p>
	<p>
<strong>How can I monitor my order?</strong><br>
For each transaction we make use of a messaging thread for each order, this makes it easier to
enquire about your order - your message will be replied to within 24hrs.
	</p>
	<p>
		<strong>Is it safe to transact on Productlists?</strong><br>
We make use of TSL which is an international standard to transmit information securely. All
payments are performed by third party domain with more experience.
	</p>
	<p>	
	<strong>How can I return damaged or wrong Products?</strong><br>
We prefer that you swap the product for an alternative, but we do offer an option to return the
product, but you have limited time of a week after receiving the product to detect any damages and
return it. You will have to take images of the damaged product and send an email to claim your
refund.
	</p>
	<p>
<strong>Why should I donate?</strong><br>
We create content about local markets and showcase business success stories, we believe that the
best way to grow economy is to show the practical examples. Your donation will go towards
improving the quality of this content and the number of people with access to it.
	</p>
	<p>
<strong>Banking Details</strong><br>
PayPal account: admin@productlists.co.za<br>
Productlists (pty)ltd <br>
Bank: FNB<br>
Account no: 62689950501 (Down at the moment)<br>
	<br>
PayPal account: mngz636@gmail.co.za<br>
Mongezi Mafunda <br>
Bank: Standard Bank<br>
Account no: 10129573092 (Recommended)<br>
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
