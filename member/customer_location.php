<?php
session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

if(!ISSET($_SESSION['customer_id'])){
	if(ISSET($_COOKIE['has_account'])){
header('Location:/member/signin_main.php');
	}else{
header('Location:/member/signup_main.php');
	}
}

$LOCATION = 'member/customer_location.php';

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Productlists | Delivery</title>
<link rel=stylesheet href=https://www.productlists.co.za/style.css />
<link rel=stylesheet href=https://www.productlists.co.za/bootstrap.min.css />
<link rel=stylesheet href=https://www.productlists.co.za/mobstyle.css />
<link rel=stylesheet href=https://www.productlists.co.za/input_style.css />
<link rel=stylesheet href=https://www.productlists.co.za/verification_style.css />

<link rel=stylesheet href=https://www.productlists.co.za/feature/sign/style.css />
<link rel=stylesheet href=https://www.productlists.co.za/feature/search/style.css />
<link rel="shortcut icon" type="image/png" href="https://www.productlists.co.za/resources/logo.png" />
<meta name="viewport" content="width=device-width" />
<meta name="autor" content="Mongezi Mafunda" />
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
<script src=https://www.productlists.co.za/api.js ></script>
<script src=https://www.productlists.co.za/verification.js ></script>
<script src=https://www.productlists.co.za/verification_location.js ></script>

<script src=https://www.productlists.co.za/feature/search/api.js ></script>
<script src=https://www.productlists.co.za/feature/sign/api.js ></script>

<div id=container class=p_cont >
    
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/header_2.php"; ?>

<div class="body row" >
<div class="col-sm-3" >
<div id=left_pane class="left_pane" >

<div id=left_pane_2 style="display:none;" >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/relationship.php'; ?>
</div>
</div>
</div>
<div class="content col-sm-6" >
<a name=main ></a>
<div id="main" class=main >
<?php

$row='';

if(ISSET($_SESSION['customer_id'])){
$sql = 'SELECT id,p_p,postal_code,country,state_province,city,addressl1,addressl2 FROM customer WHERE id='.$_SESSION['customer_id'];
$result = $conn->query($sql);
if($result){
$row = $result->fetch_assoc();
}
}
?>
<form id=input method=post action="<?php echo ($row?'':'new_customer.php'); ?>" enctype="multipart/form-data" >
<div class="input" >
<div class="row" >
<div class="col-sm-5" >
<div class="images" >
<a href=# onclick="setImage(e('image'),<?php echo ($row?'\'member/update_customer_image.php\'':'\'\''); ?>);return false;" ><img id=image src="<?php echo (ISSET($row['p_p']) && $row['p_p']?'https://www.productlists.co.za/member/customer_images/'.$row['p_p']:'https://www.productlists.co.za/resources/user.png'); ?>" /></a>
<input id=image_input type=file name=p_p accept="image/*"  />
</div>
</div>
<div id=slides class="col-sm-7" >
<div class="slide" >
<h4>Delivery</h4>
<div>
<span>Country</span>
<input onfocus="v_open(this,30);" <?php echo ($row?'onblur=editfield_2("member/update_customer.php","'.$row['id'].'","country","\""+this.value+"\"",true);':''); ?>  onkeydown="return (len(this,null)?true:false);" autocomplete=false type=text value="<?php echo ($row['country']?$row['country']:'South Africa'); ?>" />
<span>State/Province</span>
<input onfocus="v_open(this,50);"  <?php echo ($row?'onblur=editfield_2("member/update_customer.php","'.$row['id'].'","state_province","\""+this.value+"\"",findProvince(this));':''); ?> onkeyup="auto_complete_province(this);" onkeydown="return (len(this,null)?true:false);" autocomplete=false type=text value="<?php echo ($row['state_province']?$row['state_province']:''); ?>" />
<span>City</span>
<input onfocus="v_open(this,50);"  <?php echo ($row?'onblur=editfield_2("member/update_customer.php","'.$row['id'].'","city","\""+this.value+"\"",city_v(this));':''); ?> onkeydown="return (len(this,null)?true:false);" type=text value="<?php echo ($row['city']?$row['city']:''); ?>" />
<span>Postal Code</span>
<input onfocus="v_open(this,6);"  <?php echo ($row?'onblur=editfield_2("member/update_customer.php","'.$row['id'].'","postal_code","\""+this.value+"\"",postal_code_v(this));':''); ?> onkeydown="return (len(this,null)?true:false);" type=text value="<?php echo ($row['postal_code']?$row['postal_code']:''); ?>" placeholder="0000" />
<span>Address Line 1</span>
<input onfocus="v_open(this,50);" <?php echo ($row?'onblur=editfield_2("member/update_customer.php","'.$row['id'].'","addressl1","\""+this.value+"\"",addr1(this));':''); ?> onkeydown="return (len(this,null)?true:false);"  type=text value="<?php echo ($row['addressl1']?$row['addressl1']:''); ?>" placeholder="No Street" />
<span>Address Line 2</span>
<input onfocus="v_open(this,50);" <?php echo ($row?'onblur=editfield_2("member/update_customer.php","'.$row['id'].'","addressl2","\""+this.value+"\"",addr2(this));':''); ?> onkeydown="return (len(this,null)?true:false);" type=text value="<?php echo ($row['addressl2']?$row['addressl2']:''); ?>" placeholder="Suburb" />

</div>
</div>
<div id=error_msg class=verification >
</div>
</div>
</div>
<div class=nav >
<?php
if(ISSET($_SESSION['active_checkout_payment'])){
    echo '<a class="btn btn-primary next" href="https://www.productlists.co.za/feature/shopping_cart/checkout.php?p='.$_SESSION['active_checkout_payment'].'&d='.$_SESSION['active_checkout_delivery'].'" >finish</a>'; 
}else{
	echo '<a class="btn btn-primary next" href=https://www.productlists.co.za/index.php >home</a>';
}
?>
</div>
</div>
</form>

</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" ></div>
</div>
</div>
<?php
 include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/footer_2.php"; 
?>

</div>
</body>
</html>
<?php
$conn->close();
?>
