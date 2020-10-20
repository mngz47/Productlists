<?php

session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$LOCATION = 'index.php';

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
    <script>
   
    var affiliates_banner = ["//rcm-na.amazon-adsystem.com/e/cm?o=1&p=48&l=ur1&category=instruments&banner=0JB0A4VDS5FZSF8J66G2&f=ifr&linkID=957b6056e810aaba8d6734b832d49fbf&t=productlists4-20&tracking_id=productlists4-20",
		     "//rcm-na.amazon-adsystem.com/e/cm?o=1&p=26&l=ur1&category=amazonhomepage&f=ifr&linkID=395a3797c0390ce90b0909dac625fbf4&t=productlists4-20&tracking_id=productlists4-20",
		     "//rcm-na.amazon-adsystem.com/e/cm?o=1&p=26&l=ur1&category=bestsellingproducts&banner=1F8VTV49P7N5K5XY5N82&f=ifr&linkID=62fbaa2c4f1eadfd296f4e00a685b4c2&t=productlists4-20&tracking_id=productlists4-20",
		     "//rcm-na.amazon-adsystem.com/e/cm?o=1&p=48&l=ur1&category=instruments&banner=1F5XAJEA6KXT7JPXEC02&f=ifr&linkID=e4ae1c402faaed3fc1483d4072b07ade&t=productlists4-20&tracking_id=productlists4-20",
		     "https://www.productlists.co.za/services/air_bnb/index.html"];
    var index_home = 0;
    
    function four_next_home(){
		if(index<affiliates.length){
			e('four_target_home').src = affiliates_banner[index_home];
			index_home++;
		}else{
		index_home = 0;	
		}
	  }
  setInterval(function(){
  four_next_home();
  },14000);
    </script>
</div>
	
</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
<div id=left_pane_1 >
<?php include "services/sell/products/feature/group_four_affiliate.php"; ?>
</div>
<div id=right_pane_2 style="display:none;" >
<?php include "feature/relationship.php"; ?>
</div>
</div>
</div>
</div>
</div>
	
	<div class="row" >
<div class="content col-sm-9" >
	<div style="padding:20px;" >
		<?php include 'timeline.php'; ?>

	<a href="https://productlists.co.za/services/cv_engine/templates/temp22.html" >
		<img src="https://productlists.co.za/services/cv_engine/temp222.png" width="100%" />
	</a>	
	
	</div>
		</div>
<div class="col-sm-3" >
		</div>
	</div>
	
<?php include "footer_4.php"; ?>
</body>
</html>
<?php
$conn->close();
?>
