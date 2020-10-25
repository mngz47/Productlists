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
<div class=p_cont >

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
to showcase our product and services.<br><br>
The pipeline is physically based in Newcastle where the print out newsletter is
issued. We also have reach online through Facebook classified groups. The
estimate people that can be reached are 150k.<br><br>
The pipeline involves printing out locally then creating digital content that
corresponds in the form of video, posting it on YouTube and sharing on
Facebook.<br><br>
We also make use of online directories like Gumtree as well as banners on our
chain of websites.<br><br>
The pipeline is carried out every 3 days for the whole month.
  </p>
  <h4>Pricing Options <small>(Free graphic design)</small></h4>
  <div class=row id=pricing_option >
    <div class=col-sm-4 onclick="setPackage(this,150);" >
      <div class=space >
        <h5><strong>Basic</strong></h5>
        <span style="color:green" >R150</span> (monthly)<br>
Newsletter Print(1)<br>
YouTube Video(1)<br>
Facebook groups(4)<br>
      </div>
    </div>
    <div class=col-sm-4 onclick="setPackage(this,250);" >
    <div class=space >
      <h5><strong>Moderate</strong></h5>
      <span style="color:green" >R250</span> (monthly)<br>
Newsletter Print(1)<br>
YouTube Video(1)<br>
Facebook groups(8)<br>
Online Directory(3)
      </div>
    </div>
    <div class=col-sm-4 onclick="setPackage(this,350);" >
    <div class=space >
       <h5><strong>Professional</strong></h5>
      <span style="color:green" >R350</span> (monthly)<br>
Newsletter Print(1)<br>
YouTube Video(1)<br>
Facebook groups(12)<br>
Online Directory(6)<br>
Website Banner (3)
      </div>
    </div>
  </div>
  <div style="height:50px;" >
      <a href=# onclick=advertise(); class="btn btn-primary" style="float:right;" >Advertise</a>
  </div>
<p>
    <strong>enquire:</strong><br>
mngz636@gmail.com<br>
063 530 6336<br>
4 VALK Amajuba 2940
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
  
  <script>
  
    function setPackage(ele,price){
     var ops = e('pricing_option').getElementsByTagName('div');
      
      for(var a=0;a<ops.length;a++){
       ops[a].className = ops[a].className.replace('block','');
      }
      
      ele.className+=' block';
       e('amount_ff').value = price;
    }
    
    function advertise(){
      if(e('amount_ff').value){
           e('payment_ff').submit(); 
      }else{
       alert('Select Pricing Option'); 
      }
  
    }
    
  </script>
  
 <form action=https://www.payfast.co.za/eng/process method=post id=payment_ff class=invisible >
<input type=text name=merchant_id value=12647788 />
<input type=text name=merchant_key value=nliu1lbt07r75 />
<input type=text name=return_url value=https://www.productlists.co.za/advertise.php?pp=1 />
<input type=text name=cancel_url value=https://www.productlists.co.za/advertise.php?pp=0 />
<input type=text id=amount_ff name=amount />
<input type=text id=item_name name=item_name value="Advertise" />
<input type=text name=email_confirmation value="1" />
</form>
  
</body>
</html>
<?php
$conn->close();
?>
