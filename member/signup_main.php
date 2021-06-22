<?php

include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/config.php');

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$LOCATION = 'member/signup_main.php';

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Productlists | Primary Info</title>
<?php	
include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/p_styles.php');
?>	
<meta name="viewport" content="width=device-width" />
<meta name="description" content="Sign in to be able use all the features offered by productlists. Welcome back!" />
<meta name="keywords" content="productlists,sign in,directory,south africa,pmb,pietermaritzburg,kzn,online shopping,technology,file sharing,shopping,in depth content" />
<meta name="autor" content="Mongezi Mafunda" />

<meta name="google-signin-client_id" content="644981683202-gq3ogqsu0g8i9kb2uj7setjcl9nal28c.apps.googleusercontent.com">

</head>
<body>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v5.0&appId=838292889616021&autoLogAppEvents=1"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>

<script>
<?php 

if(ISSET($_SESSION['response'])){
	echo 'alert("'.$_SESSION['response'].'");';
	$_SESSION['response'] = null;
}

?>
</script>
<?php	
include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/p_scripts.php');
?>	
<div id=container class=p_cont >

<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/header_3.php"; ?>


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
$sql = 'SELECT id,p_p,name,surname,email_cell,occupation FROM customer WHERE id='.$_SESSION['customer_id'];
$result = $conn->query($sql);
if($result){
$row = $result->fetch_assoc();
}
}
?>
<form id=input method=post action="<?php echo ($row?'':'new_customer_primary.php'); ?>" enctype="multipart/form-data" onsubmit=setDate("date_added"); >
<div class="input" >
<div class="row" >
<div class="col-sm-5" >
<div class="images" >
<span>Profile Image</span>
<a href=# onclick="setImage(e('image'),<?php echo ($row?'\'member/update_customer_image.php\'':'\'\''); ?>);return false;" ><img id=image src="<?php echo (ISSET($row['p_p']) && $row['p_p']?'https://'.$HOME_.'/member/customer_images/'.$row['p_p']:'https://'.$HOME_.'/resources/user.png'); ?>" /></a>
<input id=image_input type=file name=p_p accept="image/*"  />
</div>
</div>
<div id=slides class="col-sm-7" >
<div  class="slide" >
<h4>Primary Info</h4>
<div>
<span>Name</span>
<input onfocus="v_open(this,30);" onblur=<?php echo ($row?'editfield_2("member/update_customer.php","'.$row['id'].'","name","\'"+this.value+"\'",general_field(this));':'general_field(this);'); ?> onkeydown="return (len(this,null)?true:false);" autocomplete=false type=text name=name value="<?php echo ($row?$row['name']:(ISSET($_SESSION['customer_primary_cache'])?explode(';',$_SESSION['customer_primary_cache'])[0]:'')); ?>" />
<span>Surname</span>
<input onfocus="v_open(this,30);" onblur=<?php echo ($row?'editfield_2("member/update_customer.php","'.$row['id'].'","surname","\'"+this.value+"\'",general_field(this));':'general_field(this);'); ?> onkeydown="return (len(this,null)?true:false);" autocomplete=false type=text name=surname value="<?php echo ($row?$row['surname']:(ISSET($_SESSION['customer_primary_cache'])?explode(';',$_SESSION['customer_primary_cache'])[1]:'')); ?>" />
<span>Email</span>
<input onfocus="v_open(this,100);" onblur=<?php echo ($row?'editfield_2("member/update_customer.php","'.$row['id'].'","email_cell","\'"+this.value+"\'",email(this,"customer",0));':'email(this,"customer",1);'); ?> onkeydown="return (len(this,null)?true:false);" autocomplete=false type=text name=new_email value="<?php echo ($row?$row['email_cell']:(ISSET($_SESSION['customer_primary_cache'])?explode(';',$_SESSION['customer_primary_cache'])[2]:'')); ?>" />

<?php 
if($row){
    echo
    '<script>var occupation = [';
    
	$sql = 'SELECT DISTINCT occupation FROM customer';
    $result = $conn->query($sql);
    $options = '';
    if($result){
    while($row2 = $result->fetch_assoc()){
     $options.=($row2['occupation']?'"'.$row2['occupation'].'",':'');
	}	
	echo substr($options,0,strlen($options)-1);
    }
	
	echo
     '];</script>'.
     '<span>Occupation</span><input onfocus="v_open(this,50);" onblur=editfield_2("member/update_customer.php","'.$row['id'].'","occupation","\'"+this.value+"\'",auto_correct(occupation,\'Occupation\',this)); onkeyup="auto_correct(occupation,\'Occupation\',this);" onkeydown="return (len(this,null)?true:false);" autocomplete=false type=text value="'.($row['occupation']?$row['occupation']:'').'" />';
}
?>

<?php echo ($row?'':'<span>Password</span><input onfocus="v_open(this,15);showPassword(this,1);" onblur="password_v(this);showPassword(this,0);" onkeydown="return (len(this,\'p\')?true:false);" autocomplete=false type=password name=new_password value="'.(ISSET($_SESSION['customer_primary_cache'])?explode(';',$_SESSION['customer_primary_cache'])[3]:'').'" />'); ?>

<div id=v_load >
<img src=https://productlists.co.za/resources/loader.gif width=20px /><span>sending verification code...</span>
</div>
<div id=v_code >
<span>Verification Code</span>
<input placeholder="0000" type=text name=verification_code value="<?php echo (ISSET($_SESSION['customer_primary_cache'])?explode(';',$_SESSION['customer_primary_cache'])[4]:'') ?>" />
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
echo (ISSET($_SESSION['customer_id'])?
'<a class="btn btn-primary next" href=customer_location.php >delivery</a>':
'<button class="btn btn-primary next" type=submit >save</button>');
?>
</div>

<?php 

if(!ISSET($_SESSION['customer_id'])){
 include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/sign/plugin.php');  
}

?>

</div>
</form>

</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
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
