<?php

include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/api.php';

if(ISSET($_POST['type']) && ISSET($_POST['email_cell']) && ISSET($_POST['password'])){
    
    //$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');
   // $conn = new mysqli($HOST_,$USER_,$PASS_,$DATABASE_);
   // include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/config.php');
    
$sql = 'SELECT id,password FROM '.$_POST['type'].' WHERE email_cell="'.$_POST['email_cell'].'"';
$result = $conn->query($sql);

if($row = $result->fetch_assoc()){
    
if($row['password']==$_POST['password']){ 

$_SESSION[$_POST['type'].'_id']=$row['id'];
$_SESSION['response'] = 'success';

setcookie('has_account','true',time()+(86400 * 365),'/'); 

}else{
if(ISSET($_SESSION['forgot_password'])){

p_mail($_POST['email_cell'],'Productlists Login Password Reminder','Password : '.$row['password']);

}else{
$_SESSION['response'] = 'Wrong password - try again and if you still cannot remember we will email it to you.';
$_SESSION['forgot_password'] = 'yes';
}	
}	
}else{
$_SESSION['response'] = 'The email you have entered is not in our system. Double click to sign_in to company.'.$_POST['type'];		
}

if(ISSET($_GET['from'])){
    $r = '';
    if($row){
        if($row['password']==$_POST['password']){
            $r = $row['id'];    
        }else{
            $r = '-1';
        }
    }else{
            $r = '-1';
    }
    
    header('Location: https://www.listro.co.za/sign.php?member_id='.$r.'&to='.$_GET['from']);
}else{
   header('Location:/'.(ISSET($_SESSION['location_before_sign'])?$_SESSION['location_before_sign']:'index.php')); 
}


}

if(ISSET($_COOKIE['auto_login']) && $_COOKIE['auto_login'] && ISSET($_SESSION['customer_id'])){
$_SESSION['customer_id'] = $_COOKIE['auto_login'];
}

$conn = new mysqli($HOST_,$USER_,$PASS_,$DATABASE_);

if(ISSET($_SESSION['company_id'])){
$sql = 'SELECT id,name,logo FROM company WHERE id='.$_SESSION['company_id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo
"<div id=signin_toggle_hold class='signin shadow' >".
"<a href=https://".$HOME_."/services/sell/company_general.php >".
"<div class=row >".
"<img class=space src=".($row['logo']?'https://'.$HOME_.'/services/sell/company_images/'.$row['logo']:"https://".$HOME_."/resources/company.png")." width=40px />".
"<span class='t' >".
(strlen($row['name'])>14?substr($row['name'],0,14).'...':$row['name']).
"</span>".
"</div>".
"</a>".
"<div class='footer scroll_text_cont' >".
"<a href=https://".$HOME_."/feature/sign/signout.php class=scroll_text >sign_out</a>".
"</div>".
"</div>";
}else if(ISSET($_SESSION['customer_id'])){

$sql = 'SELECT name,surname,p_p,balance FROM customer WHERE id='.$_SESSION['customer_id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo
"<div id=signin_toggle_hold class='signin shadow' >".
"<a href=https://".$HOME_."/member/signup_main.php >".
"<div class='row' >".  
"<img class=space src=".($row['p_p']?(strpos($row['p_p'],'http')>-1?$row['p_p']:'https://'.$HOME_.'/member/customer_images/'.$row['p_p']):"https://".$HOME_."/resources/user.png")." width=40px />".
"<span class=t >".$row['name']." ".$row['surname']."</span>".
"</div>".
"</a>".
"<div class='footer scroll_text_cont' >".
"<a href=https://".$HOME_."/feature/sign/signout.php class=scroll_text >sign_out</a>".
"</div>".
"</div>";

}else{
echo
"<div id=signin_toggle_hold class='signin shadow' >".
"<style>".
"#sign_face img { float:right;padding:3px; }".
"#signin { display:none; }".
"</style>".
"<div id=sign_face  >".
"<table style='display:inline-block;' ><tr><td><a href=https://".$HOME_."/member/signin_main.php >Sign In</a></td></tr>".
"<tr><td><a href=https://".$HOME_."/member/signup_main.php >Sign Up</a></td></tr></table>".
"<a href=# onclick='e(\"sign_face\").style.display=\"none\";e(\"signin\").style.display=\"block\";' ><img src=https://".$HOME_."/resources/user.png width=40px /></a>".
"<a href=https://".$HOME_."/feature/shopping_cart/index.php ><img src=https://".$HOME_."/resources/cart.png width=40px /></a>".
"</div>".
"<form id=signin method=post action='https://".$HOME_."/feature/sign/signin.php".(ISSET($_GET['from'])?'?from='.$_GET['from']:'')."' >".
"<div class=row ><table><tr>".
"<td width=20% class=user_image ></td>".
"<td width=40% ><input class=form-control type=text name=email_cell placeholder='email' /></td>".
"<td width=40% ><input class=form-control type=password name=password placeholder=password /></td>".
"</tr></table></div>".
"<div class=footer >".
"<a href=# onclick='e(\"signin\").style.display=\"none\";e(\"sign_face\").style.display=\"block\";' >back</a>".
"<a href=# class='btn btn-default' onclick='handleSignInType(this);return false;' >sign_in</a>".
"</div>".
"<input id=signin_type type=text name=type value='' class=invisible />".
"</form>".


"</div>";
}
?>
