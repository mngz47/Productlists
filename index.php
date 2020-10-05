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
	
<iframe src="https://productlists.co.za/services/f_snake/index.html" style="width:100%;height:450px;border:2px solid yellow;" ></iframe>

<?php include 'timeline.php'; ?>

	<a href="https://productlists.co.za/services/cv_engine/templates/temp22.html" >
		<img src="https://productlists.co.za/services/cv_engine/temp222.png" width="100%" />
	</a>	
	
</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
<div id=left_pane_1 >
<?php include "services/sell/products/feature/group_four.php"; ?>
</div>
<div id=right_pane_2 style="display:none;" >
<?php include "feature/relationship.php"; ?>
</div>
</div>
</div>
</div>
</div>
<?php include "footer_4.php"; ?>
</body>
</html>
<?php
$conn->close();
?>
