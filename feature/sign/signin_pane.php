<?php

$conn = new mysqli($HOST_,$USER_,$PASS_,$DATABASE_);

//$conn = new mysqli('d6rii63wp64rsfb5.cbetxkdyhwsb.us-east-1.rds.amazonaws.com','muce70z5ukkwpv5d','bqvn5jp04wlmxu64','zyo1oodysira7ro5');

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
