<?php
session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$LOCATION = 'services/sell/company_product_collection.php';

if(!ISSET($_SESSION['company_id'])){
header('Location:/services/sell/company_general.php');
	
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Productlists | Company Product Collection</title>
<link rel=stylesheet href=https://productlists.co.za/style.css />
<link rel=stylesheet href=https://productlists.co.za/bootstrap.min.css />
<link rel=stylesheet href=https://productlists.co.za/mobstyle.css />
<link rel=stylesheet href=https://productlists.co.za/input_style.css />
<link rel=stylesheet href=https://productlists.co.za/verification_style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/feedback/style.css />

<link rel=stylesheet href=https://productlists.co.za/feature/sign/style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/search/style.css />
<link rel="shortcut icon" type="image/png" href="logo.png" />
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
<script src=https://productlists.co.za/api.js ></script>
<script src=https://productlists.co.za/verification.js ></script>
<script src=https://productlists.co.za/verification_location.js ></script>
<script src=https://productlists.co.za/feature/search/api.js ></script>
<script src=https://productlists.co.za/feature/sign/api.js ></script>
<script src=https://productlists.co.za/services/sell/products/feature/option/api.js ></script>
<div id=container class=p_cont >
	
	<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/header_3.php'; ?>
	
<div class="body row" >
<div class="col-sm-3" >
<div id=left_pane class="left_pane" >
<div id=left_pane_1 >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four.php'; ?>
</div>
<div id=left_pane_3 >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four_control.php'; ?>
</div>	
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

if(ISSET($_SESSION['company_id'])){
$sql = 'SELECT id,logo,country,state_province,city,postal_code,addressl1,addressl2 FROM company WHERE id='.$_SESSION['company_id'];
$result = $conn->query($sql);

if($result){
$row = $result->fetch_assoc();
}else{
echo '---------------'.mysqli_error($conn);    
}

}else if(ISSET($_SESSION['customer_id'])){
	header('Location:/services/sell/index.php');
}else{
	header('Location:/member/signup_main.php');
}
?>
<div class="input" >
<div class="row" >
<div class="col-sm-5" >
<div class="images" >
<a href=# onclick="setImage(e('image'),<?php echo ($row?'\'services/sell/update_company_image.php\'':'\'\''); ?>);return false;" ><img id=image src="<?php echo ($row['logo']?'https://productlists.co.za/services/sell/company_images/'.$row['logo']:'https://productlists.co.za/resources/company.png'); ?>" /></a>
<input id=image_input type=file name=logo accept="image/*"  />
</div>
</div>
<div id=slides class="col-sm-7" >
<div class="slide" >
<h4>Product collection</h4>
<div>
<span>Country</span>
<input type=text onfocus="v_open(this,50);" onkeydown="return (len(this,null)?true:false);"  value="<?php echo ($row['country']?$row['country']:''); ?>" <?php echo ($row?'onblur=editfield_2("services/sell/update_company.php","'.$row['id'].'","country","\""+this.value+"\"",true);':''); ?> />
<span>State/Province</span>
<input type=text onfocus="v_open(this,50);" onkeydown="return (len(this,null)?true:false);" onkeyup="auto_complete_province(this);" value="<?php echo ($row['state_province']?$row['state_province']:''); ?>" <?php echo ($row?'onblur=editfield_2("services/sell/update_company.php","'.$row['id'].'","state_province","\""+this.value+"\"",findProvince(this))':''); ?> />
<span>City</span>
<input type=text onfocus="v_open(this,50);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row['city']?$row['city']:''); ?>" <?php echo ($row?'onblur=editfield_2("services/sell/update_company.php","'.$row['id'].'","city","\""+this.value+"\"",city_v(this));':''); ?> />
<span>Postal Code</span>
<input type=text onfocus="v_open(this,6);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row['postal_code']?$row['postal_code']:''); ?>" placeholder="0000" <?php echo ($row?'onblur=editfield_2("services/sell/update_company.php","'.$row['id'].'","postal_code","\""+this.value+"\"",postal_code_v(this));':''); ?> />
<span>Address line 1</span>
<input type=text onfocus="v_open(this,50);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row['addressl1']?$row['addressl1']:''); ?>" placeholder="No Street" <?php echo ($row?'onblur=editfield_2("services/sell/update_company.php","'.$row['id'].'","addressl1","\""+this.value+"\"",addr1(this));':''); ?> />
<span>Address line 2</span>
<input type=text onfocus="v_open(this,50);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row['addressl2']?$row['addressl2']:''); ?>" placeholder="Suburb"  <?php echo ($row?'onblur=editfield_2("services/sell/update_company.php","'.$row['id'].'","addressl2","\""+this.value+"\"",addr2(this));':''); ?> />
</div>
</div>
<div id=error_msg class=verification >
</div>
</div>
</div>
<div class=nav >
<a class="btn btn-primary" href=company_general.php >General</a>
<a class="btn btn-primary next" href=company_banking.php >Banking</a>
</div>
</div>
</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
<div id=right_pane_1 >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/option/index.php';  ?>
</div>
</div>
</div>
</div>
<?php
 include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/footer_4.php"; 
?>
</div>
</body>
</html>
<?php
$conn->close();
?>
