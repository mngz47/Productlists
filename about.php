<?php

function httpGet($url){
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
));
return curl_exec($curl);
curl_close($curl);
}

session_start();
$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');
?>
<!DOCTYPE html>
<html>
<head>
<title>Productlists | About</title>
<link rel=stylesheet href=https://www.productlists.co.za/style.css />
<link rel=stylesheet href=https://www.productlists.co.za/bootstrap.min.css />
<link rel=stylesheet href=https://www.productlists.co.za/mobstyle.css />
<link rel=stylesheet href=https://www.productlists.co.za/feature/sign/style.css />
<link rel=stylesheet href=https://www.productlists.co.za/feature/search/style.css />
<link rel=stylesheet href=https://www.productlists.co.za/feature/feedback/style.css />
<link rel=stylesheet href=https://listro.co.za/style.css />
<link rel=stylesheet href=https://productlists.co.za/index_style.css />

<link rel="shortcut icon" type="image/png" href="https://www.productlists.co.za/logo.png" />
<meta name="viewport" content="width=device-width" />
<meta name="description" content="Technology Firm - working towards solutions to free the youth. We offer a system for members to sell products through a professional online company and build their brand. The system is suitable for businesses seeking to achieve remote income flow and lower operating costs." />
<meta name="keywords" content="shares,writer,programmer,engineer,donate,enquiry,productlists,support,contact,south africa,pietermaritzburg,kzn,online shopping,technology,file sharing,music,documents,content,member,company,directory,column,products" />
<meta name="autor" content="Mongezi Mafunda" />
</head>
<body>
<script src=https://www.productlists.co.za/api.js ></script>
<script src=https://www.productlists.co.za/verification.js ></script>
<script src=https://www.productlists.co.za/feature/search/api.js ></script>
<script src=https://www.productlists.co.za/feature/sign/api.js ></script>
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
</div></div>
</div>
<div class="content col-sm-6" >
<a name=main ></a>

<div id="main" class=main >
<p>
   <h3>About</h3>
   
   @writeforsa on IG is an online initiative to get young writers to grow their influence and expand their knowledge as well as write for lifetime commissions by creating unique content.<br><br>
The idea is to write an article turn it to a video then link it to Wikipedia.<br><br>
We are an online marketplace that offers a professional and safe system that allows Members to buy directly from suppliers.<br><br>
We aim to remove the risk from the Member which is posed by traditional classified sites by using professional suppliers in South Africa as well as China.<br><br>
The system is suitable for businesses seeking to achieve remote income flow and lower operating costs. <br><br>
AUTOMATION will allow humans to shift their attention to bigger things rather then food and shelter. Our engineers create SYSTEMS that will automate water, energy, food and shelter supply and make it free for everyone.<br><br>
We predict that by 2025 we will have created homes for 400 families, an assembly from iron and glass. The houses will be fitted with water, energy and food supply.<br><br>

Please donate to the cause.

 <strong style="float:right;margin:3px;" >est. 2012</strong>
</p> 
<div class=scroll_x >
<?php

echo httpGet("https://www.listro.co.za/tasks/list.php?business=http://www.productlists.co.za/about.php");

?>  
</div>
<p>
<h3>Employees</h3>
<div class="row horizontal_view" >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/member/feature/employee/list.php'; ?>   
</div>    
</p>
</div>

</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
<div id=right_pane_1 >
<?php 
include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/option/index.php';
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
</div></div>
</div>
</div>
<?php
 include 'footer_2.php'; 
 ?>
</div>
</body>
</html>
<?php
$conn->close();
?>
