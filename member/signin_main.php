<?php

session_start();

function httpGet($url){
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
));
return curl_exec($curl);
curl_close($curl);
}

$LOCATION = 'member/signin_main.php';

session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Productlists | Sign In</title>
<link rel=stylesheet href=https://www.productlists.co.za/style.css />
<link rel=stylesheet href=https://www.productlists.co.za/bootstrap.min.css />
<link rel=stylesheet href=https://www.productlists.co.za/mobstyle.css />
<link rel=stylesheet href=https://productlists.co.za/input_style.css />
<link rel=stylesheet href=https://www.productlists.co.za/feature/sign/style.css />
<link rel=stylesheet href=https://www.productlists.co.za/feature/search/style.css />
<link rel="shortcut icon" type="image/png" href="https://productlists.co.za/logo.png" />
<meta name="viewport" content="width=device-width" />
<meta name="description" content="Become a member, become part real technology within four fields. File sharing; shopping; in depth content" />
<meta name="keywords" content="productlists,sign in,south africa,pmb,pietermaritzburg,kzn,online shopping,technology,sharing,shopping,in depth content" />
<meta name="autor" content="Mongezi Mafunda" />

<meta name="google-signin-client_id" content="644981683202-gq3ogqsu0g8i9kb2uj7setjcl9nal28c.apps.googleusercontent.com">

</head>
<body>
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v5.0&appId=838292889616021&autoLogAppEvents=1"></script>
<script>

 var location_before_sign = <?php echo $_SESSION['location_before_sign']; ?>
 
<?php 

if(ISSET($_SESSION['response'])){
	echo 'alert("'.$_SESSION['response'].'");';
	$_SESSION['response'] = null;
}

?>
</script> 
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src=https://www.productlists.co.za/api.js ></script>
<script src=https://www.productlists.co.za/feature/search/api.js ></script>
<script src=https://www.productlists.co.za/feature/sign/api.js ></script>
<div id=container class=p_cont >

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
<?php 

if(ISSET($_GET['from'])){
    echo httpGet('https://www.productlists.co.za/feature/sign/signin.php?from='.$_GET['from']);
}else{
    
}

?>
</div>
</div>

<div class="body row" >
<div class="col-sm-3" >
<div id=left_pane class="left_pane" >
<div id=left_pane_2 style="display:none;">
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/relationship.php'; ?>
</div>
</div>
</div>
<div class="content col-sm-6" >
<a name=main ></a>
<div id="main" class=main >


<form id=signin method=post action='https://www.productlists.co.za/feature/sign/signin.php'  >
<div class="input" >
<div class="row" >
<div class="col-sm-5" >
<div class="images" >
<img id=image src='https://productlists.co.za/resources/user.png' />
</div>
</div>
<div id=slides class="col-sm-7" >
<div  class="slide" >
<h4>Sign In</h4>
<div>

<span>Email</span>
<input type=text name=email_cell />
<span>Password</span>
<input type=password name=password />
<input id=signin_type type=text name=type value='' class=invisible />

</div>
</div>
</div>
</div>
<div class=nav >
<a class="btn btn-default next" type=submit onclick='handleSignInType(this);' >sign_in</a>
</div>
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/sign/plugin.php');  ?>

</div>
</form>


<div class=artpiece >
<h3>Nameless Swag</h3>
<img src=https://productlists.co.za/resources/nameless_swag.jpg title="nameless swag" />
</div>
<style>

.artpiece {
margin-bottom:20px;
text-align:center;
}

.artpiece img {
width:70%;
}
</style>

</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
</div>
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
