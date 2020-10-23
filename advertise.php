<?php

session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

?>
<!DOCTYPE html>
<html>
<head>
<title>Productlists | Advertise</title>
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
  <?php 
  
  if(ISSET($_POST['pp'])){
    if($_POST['pp']){
       echo '<script>alert("Success");</script>';
    }else{
      echo '<script>alert("Failure");</script>';
    }
  }
  
  ?>
<script src=https://www.productlists.co.za/api.js ></script>
<script src=https://www.productlists.co.za/verification.js ></script>
<script src=https://www.productlists.co.za/feature/search/api.js ></script>
<script src=https://www.productlists.co.za/feature/sign/api.js ></script>
<div id=container class=container >

  <?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/header_3.php'; ?>
  
<div class="body row" >
<div class="col-sm-3" >
<div id=left_pane class="left_pane" >
<div id=left_pane_1 >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four_affiliate.php'; ?>
</div>
<div id=left_pane_2 style="display:none;" >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/relationship.php'; ?>
</div>
  </div>
</div>
<div class="content col-sm-6" >
<a name=main ></a>

<div id="main" class=main >
  <p>
  <h3>Di-On-Marketing</h3>
We are improving the business image of Newcastle by managing top pipeline
to showcase our product and services.
The pipeline is physically based in Newcastle where the print out newsletter is
issued. We also have reach online through Facebook classified groups. The
estimate people that can be reached are 150k.
The pipeline involves printing out locally then creating digital content that
corresponds in the form of video, posting it on YouTube and sharing on
Facebook.
We also make use of online directories like Gumtree as well as banners on our
chain of websites.
The pipeline is carried out every 3 days for the whole month.
  </p>
  
  
</div>
</div>
<div class="col-sm-3" >
</div>
</div>
<?php
 include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/footer_4.php'; 
 ?>
</div>
</body>
</html>
<?php
$conn->close();
?>
