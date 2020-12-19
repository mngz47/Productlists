<?php

session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

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
<link rel=stylesheet href=https://productlists.co.za/bootstrap.min.css />
<link rel=stylesheet href=https://productlists.co.za/style.css />
<link rel=stylesheet href=https://productlists.co.za/mobstyle.css />

<link rel=stylesheet href=https://productlists.co.za/index_style.css />

<link rel=stylesheet href=https://www.productlists.co.za/scroll_style.css />

<link rel=stylesheet href=https://productlists.co.za/feature/sign/style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/search/style.css />

<meta name="viewport" content="width=device-width" />

<link rel="shortcut icon" type="image/png" href="logo.png" />
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
<script src=https://productlists.co.za/api.js ></script>
<script src=https://productlists.co.za/feature/search/api.js ></script>
<script src=https://productlists.co.za/feature/sign/api.js ></script>
<script src=https://productlists.co.za/services/sell/products/feature/option/api.js ></script>


<?php include "header_3.php"; ?>

<div class="p_cont"  >
<div class="row" >
<div class="content col-sm-9" >
<a name=main ></a>
<div id="main" class=main >
	
<?php include 'services/face_2.php'; ?>	

<iframe id=four_target_home src="//rcm-na.amazon-adsystem.com/e/cm?o=1&p=48&l=ur1&category=instruments&banner=0JB0A4VDS5FZSF8J66G2&f=ifr&linkID=957b6056e810aaba8d6734b832d49fbf&t=productlists4-20&tracking_id=productlists4-20" width="468" height="60" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>

	<div class=forward >
    <script src="https://www.productlists.co.za/services/banners/api.js" ></script>
</div>
	
</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
	
<div id=left_pane_1 >
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four.php'); ?>
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
	<?php include 'timeline.php'; ?>
		
	</div>	
		</div>
		</div>
	
	<div class="row" >
<div class="content col-sm-9" >
	<div style="padding:20px;" >
		<div id='amazon_products' style='display:none' >
		<span class=title >Workx Vacuum Cleaner</span>
		<p>Portable with strong suction good for removig dirt in narrow spaces. Good for cleaning carpets and car interior.</p>
		</div>
		
		<?php include "services/build_your_brand/feature/video_2.php"; ?>
		
	</div>
		</div>
<div class="col-sm-3" >
<?php include "services/sell/products/feature/group_four_affiliate_video.php"; ?>
	<div id=group_four_affiliate_video_dd style="padding:4px;font-size:1.3em;" >Portable with strong suction good for removig dirt in narrow spaces. Good for cleaning carpets and car interior.</div>
		</div>
	</div>
	
<?php include "footer_4.php"; ?>
</body>
</html>
<?php
$conn->close();
?>
