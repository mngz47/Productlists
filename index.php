<?php

include 'config.php';

$LOCATION = 'index.php';

?>
<!DOCTYPE html>
<html>
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-6WQ0XKPSP9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-6WQ0XKPSP9');
</script>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Productlists</title>
<link rel=stylesheet href=bootstrap.min.css />
<link rel=stylesheet href=style.css />
<link rel=stylesheet href=mobstyle.css />

<link rel=stylesheet href=index_style.css />

<link rel=stylesheet href=scroll_style.css />

<link rel=stylesheet href=feature/sign/style.css />
<link rel=stylesheet href=feature/search/style.css />

<meta name="viewport" content="width=device-width" />

<link rel="shortcut icon" type="image/png" href="https://<?php echo $HOME_; ?>/resources/logo.png" />
<meta name="description" content="Technology Firm - working towards solutions to free the youth. PRODUCTLISTS" />
<meta name="keywords" content="productlists,product,sell,discount,cheap,latest,best selling,local,mzansi,south africa,pietermaritzburg,kzn,online shopping,technology,share files,music,documents,content,learn,education,information" />
<meta name="author" content="Mongezi Mafunda" />


</head>
<body>
<script>
<?php 

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


<?php include "header_3.php"; ?>

<div class="p_cont"  >
<div class="row" >
<div class="content col-sm-9" >
<a name=main ></a>
<div id="main" class=main >
	
	<iframe src="https://productlists-services.herokuapp.com/face.php" style="width:100%;height:470px;border:none;overflow-y:none;" ></iframe>
	
<?php
	// include 'services/face_2.php'; 
?>	
	
</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
	
<div id=left_pane_1 >
<?php include ('/services/sell/products/feature/group_four.php'); ?>
</div>

	
<div id=right_pane_2 style="display:none;" >
<?php include "feature/relationship.php"; ?>
</div>
</div>
</div>
</div>
</div>
	
	<div class="row" >
		<div class="col-sm-1" ></div>
<div class="content col-sm-11" >
	<div style="padding:20px;" >
	
	<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/option/body_2.php'); ?>	
	
		<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/timeline.php'); ?>
		
	</div>	
		</div>
		</div>
	
	<div class="row" >
<div class="content col-sm-9" >
	<div style="padding:20px;" >
		<div id='amazon_products' style='display:none' >
		<span class=title >Introduction To Productlists</span>
		<p>Productlists is a tech firm working towards solutions to free the youth. Enjoy our instant game service, product listings and reviews.</p>	
		<span class=title >Kasi Nametest</span>
		<p>South African local instant game - enter your name and find out with Mzansi kasi you are from.</p>
		<span class=title >Recreational Activies In Newcastle South Africa</span>
		<p>Get the latest business and tourist information about Newcastle. Learn about Accommodation, Job Recruitment and more.</p>
		<span class=title >F-Snake Classic Productlists Game</span>
		<p>Play our classic snake game with seven stages. Overcome the obstacle and score as much points as you can.</p>
		<span class=title >F-Snake Classic Productlists Game</span>
		<p>Play our classic snake game. As you progress in the stages the obstacle moves faster and faster.</p>
		<span class=title >Touch Bistro Restaurant POS</span>
		<p>Replace your printed out food menu with a digital tablet menu able to send orders directly to kitchen without calling for waiter.</p>
		<span class=title >Touch Bistro Digital Menu and Payment</span>
		<p>Collect more information during payment so you can resell your specials to frequent customers.</p>
		<span class=title >CV Engine</span>
		<p>Generate Your CV For FREE in 3 minutes and send it to your email.</p>
		<span class=title >Stop Paying For Traffic.</span>
		<p>Saas and other large companies that need to pay for advertising on a monthly basis can create a content division in their businesses.</p>	
		<span class=title >Jungle Scout</span>
		<p>Use the best tools to sell on Amazon, optimize your listing - access best selling keywords and automatic repricing.</p>
		<span class=title >Adzooma</span>
		<p>Automate and manage all your Google, Facebook and Microsoft Ads in one place. Award winning App.</p>
		</div>
		
		<?php include "services/build_your_brand/feature/video_2.php"; ?>
		
	</div>
		</div>
<div class="col-sm-3" >
<?php include "services/sell/products/feature/group_four_affiliate_video.php"; ?>
	<div id=group_four_affiliate_video_dd style="padding:4px;font-size:1.3em;" >Productlists is a tech firm working towards solutions to free the youth. Enjoy our instant game service, product listings and reviews.</div>
		</div>
	</div>
	
<?php include "footer_4.php"; ?>
</body>
</html>
<?php
$conn->close();
?>
