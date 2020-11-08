<?php
session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$LOCATION = 'services/sell/company_general.php';

if(!ISSET($_SESSION['customer_id'])){
	if(ISSET($_COOKIE['has_account'])){
header('Location:/member/signin_main.php');
	}else{
header('Location:/member/signup_main.php');
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Productlists | Company General</title>
<link rel=stylesheet href=https://productlists.co.za/style.css />
<link rel=stylesheet href=https://productlists.co.za/bootstrap.min.css />
<link rel=stylesheet href=https://productlists.co.za/mobstyle.css />
<link rel=stylesheet href=https://productlists.co.za/input_style.css />
<link rel=stylesheet href=https://productlists.co.za/verification_style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/feedback/style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/sign/style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/search/style.css />
<link rel="shortcut icon" type="image/png" href="https://productlists.co.za/logo.png" />
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
<script src=https://productlists.co.za/feature/search/api.js ></script>
<script src=https://productlists.co.za/feature/sign/api.js ></script>
<script src=https://productlists.co.za/services/sell/company_general_api.js ></script>
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
$sql = 'SELECT id,logo,name,registration_no,email_cell,password,website,company_type FROM company WHERE id='.$_SESSION['company_id'];
$result = $conn->query($sql);
if($result){
$row = $result->fetch_assoc();
}
}
?>
<form id=input method=post <?php echo ($row?'':'action=new_company.php') ?> enctype="multipart/form-data" onsubmit=setDate("date_added"); >
<div class="input" >
<div class="row" >
<div class="col-sm-5" >
<div class="images" >
<span>Logo</span>
<a href=# onclick="setImage(e('image'),<?php echo ($row?'\'services/sell/update_company_image.php\'':'\'\''); ?>);return false;" >
<img id=image src="<?php echo ($row['logo']?'https://www.productlists.co.za/services/sell/company_images/'.$row['logo']:'https://www.productlists.co.za/resources/company.png'); ?>" /></a>
<input id=image_input type=file name=logo accept="image/*"  />
</div>
</div>
<div id=slides class="col-sm-7" >
<div  class="slide" >
<h4>General</h4>
<div>
<span>Company Name</span>
<input type=text name=name value="<?php echo ($row?$row['name']:(ISSET($_SESSION['company_general_cache'])?explode(';',$_SESSION['company_general_cache'])[0]:'')); ?>" onfocus="v_open(this,30);" onkeydown="return (len(this,null)?true:false);" onblur=<?php echo ($row?'editfield_2("services/sell/update_company.php","'.$row['id'].'","name","\'"+this.value+"\'",company_name(this));':'company_name(this);'); ?> />
<?php 
if($row){
echo 
'<span>Registration Number</span><input type=text onfocus="v_open(this,15);" onkeydown="return (len(this,null)?true:false);"  value="'.($row['registration_no']?$row['registration_no']:'').'" placeholder="0000/00000/00" onblur=editfield_2("services/sell/update_company.php","'.$row['id'].'","registration_no","\'"+this.value+"\'",registration_number(this)); onkeydown="return (len(this,null)?true:false);"  />'.
'<span>Website</span><input type=text onfocus="v_open(this,50);" onkeydown="return (len(this,null)?true:false);"  value="'.($row['website']?$row['website']:'').'" placeholder="www.productlists.co.za" onblur=editfield_2("services/sell/update_company.php","'.$row['id'].'","website","\'"+this.value+"\'",website(this)); onkeydown="return (len(this,null)?true:false);"  />'.
     '<script>var company_type = [';
    
	$sql = 'SELECT DISTINCT company_type FROM company';
    $result = $conn->query($sql);
    $options = '';
    if($result){
    while($row2 = $result->fetch_assoc()){
     $options.=($row2['company_type']?'"'.$row2['company_type'].'",':'');
	}	
	echo substr($options,0,strlen($options)-1);
    }
	
echo '];</script>'.
     '<span>Company Type</span><input onfocus="v_open(this,50);" onkeydown="return (len(this,null)?true:false);" type=text value="'.($row['company_type']?$row['company_type']:'').'" onblur=editfield_2("services/sell/update_company.php","'.$row['id'].'","company_type","\'"+this.value+"\'",true); onkeyup="auto_correct(company_type,\'Company Type\',this);"  autocomplete=false />'; 
}
?>
<span>Email</span>
<input type=text name=email_cell onfocus="v_open(this,100);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row?$row['email_cell']:(ISSET($_SESSION['company_general_cache'])?explode(';',$_SESSION['company_general_cache'])[1]:'')); ?>" onblur=<?php echo ($row?'editfield_2("services/sell/update_company.php","'.$row['id'].'","email_cell","\""+this.value+"\"",email(this,"company",0));':'email(this,"company",1);'); ?> />
<?php echo ($row?'':'<span>Password</span><input onfocus="v_open(this,15);showPassword(this,1);" onblur="password_v(this);showPassword(this,0);" onkeydown="return (len(this,\'p\')?true:false);" autocomplete=false type=password name=password value="'.(ISSET($_SESSION['company_general_cache'])?explode(';',$_SESSION['company_general_cache'])[2]:'').'" />'); ?>
<div id=v_load >
<img src=https://productlists.co.za/resources/loader.gif width=20px /><span>sending verification code...</span>
</div>
<div id=v_code >
<span>Verification Code</span>
<input placeholder="0000" type=text name=verification_code />
</div>
<input id=date_added name=date_added type=text />
</div>
</div>
<div id=error_msg class=verification >
</div>
</div>
</div>
<div class=nav >
<?php
echo (ISSET($_SESSION['company_id'])?
'<a class="btn btn-primary next" href=company_product_collection.php >Product collection</a>':
'<button class="btn btn-primary next" type=submit >Save</button>');
?>
</div>
</div>
</form>
</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >

<div id=right_pane_1 >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/services/sell/products/feature/option/index.php"; ?>
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
