<?php
session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$LOCATION = 'services/sell/company_banking.php';

if(!ISSET($_SESSION['company_id'])){
header('Location:/services/sell/company_general.php');
	
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Productlists | Company Banking</title>
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
<script src=https://productlists.co.za/api.js ></script>
<script src=https://productlists.co.za/verification.js ></script>
<script src=https://productlists.co.za/feature/search/api.js ></script>
<script src=https://productlists.co.za/feature/sign/api.js ></script>
<script src=https://productlists.co.za/services/sell/company_banking_api.js ></script>
<script src=https://productlists.co.za/services/sell/products/feature/option/api.js ></script>
<div id=container class=container >
<div id=header class="header row" >
<div class="col-sm-3" >
<div>
<a href=https://www.productlists.co.za/index.php class="logo logo_start" ></a>
<a href=https://www.productlists.co.za/index.php class="title logo" >Productlists</a>
<a href="#" onclick="toggleUpperScroll();return false;" class="toggleUpperScroll highlight" ></a>
<a href="#" onclick="toggleSignIn();return false;" class="toggleSignIn highlight" ></a>
</div>
</div>
<div class="col-sm-6" >
<div class=upper_scroll >
<input onfocus=s_in(); onblur=s_out(this); type=search onkeyup="search(this.value);" class="form-control shadow" id=search placeholder="search" />
</div>
</div>
<div id=header_right class="col-sm-3">
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/sign/signin.php'; ?>
</div>
</div>
<div class="body row" >
<div class="col-sm-3" >
<div id=left_pane class="left_pane" >
<div id=left_pane_1 >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four.php'; ?>
</div>
<div id=left_pane_2 >
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

$sql = 'SELECT id,logo,acc_no,branch_code,bank FROM company WHERE id='.$_SESSION['company_id'];
$result = $conn->query($sql);
if($result){
$row = $result->fetch_assoc();
}else{
echo '---------------'.mysqli_error($conn);    
}

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
<h4>Banking</h4>
<div>
<span>Account Number</span>
<input type=text onfocus="v_open(this,9);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row?$row['acc_no']:''); ?>" placeholder="000000000" <?php echo ($row?'onblur=editfield_2("services/sell/update_company.php","'.$row['id'].'","acc_no","\""+this.value+"\"",account_number(this));':''); ?> />
<span>Branch Code</span>
<input type=text onfocus="v_open(this,6);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row?$row['branch_code']:''); ?>" placeholder="000000" <?php echo ($row?'onblur=editfield_2("services/sell/update_company.php","'.$row['id'].'","branch_code","\""+this.value+"\"",branch_code(this));':''); ?> />
<span>Bank Name</span>
<select onfocus="v_open(this,null);" <?php echo ($row?'onchange=editfield_2("services/sell/update_company.php","'.$row['id'].'","bank","\""+this.value+"\"",bank(this));':''); ?> >
<option value="" >choose bank</option>
<option value="Standard bank" <?php echo ($row && $row['bank']=='Standard bank'?'selected':''); ?> >Standard bank</option>
<option value="Absa" <?php echo ($row && $row['bank']=='Absa'?'selected':''); ?> >Absa</option>
<option value="FNB" <?php echo ($row && $row['bank']=='FNB'?'selected':''); ?> >FNB</option>
<option value="Capitec" <?php echo ($row && $row['bank']=='Capitec'?'selected':''); ?> >Capitec</option>
<option value="Nedbank" <?php echo ($row && $row['bank']=='Nedbank'?'selected':''); ?> >Nedbank</option>
</select>
</div>
</div>
<div id=error_msg class=verification >
</div>
</div>
</div>
<div class=nav >
<a class="btn btn-primary" href=company_product_collection.php >Product collection</a>
<a class="btn btn-primary next" href="products/" >Sell</a>
</div>
</div>

</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
<div id=right_pane_1 >
<?php 
 include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/services/sell/products/feature/option/index.php";
?>
</div>
<div id=right_pane_2 >
<?php 
 include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/services/directory_listings/feature/occupation.php"; 
?>
</div>
<div id=right_pane_3 >
<?php 
 include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/services/directory_listings/feature/company_type.php"; 
?>
</div>
<div id=right_pane_4 >
<?php
 include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/services/build_your_brand/feature/author.php"; 
 ?>
</div>

<?php
 include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/feature/feedback/face.php"; 
?>

</div>
</div>
</div>

<?php
 include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/footer.php"; 
?>

</div>
</body>
</html>
<?php
$conn->close();
?>
