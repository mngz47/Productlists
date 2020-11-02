<?php

session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

?>
<!DOCTYPE html>
<html>
<head>
<title>Productlists | Support</title>
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
<div id=container class=p_cont >
    
    <?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/header_3.php'; ?>
    
<div class="body row" >
<div class="col-sm-3" >
<div id=left_pane class="left_pane" >
<div id=left_pane_1 >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four_affiliate.php'; ?>
</div>
<div id=left_pane_2 style="display:none;" >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/relationship.php'; ?>
</div></div>
</div>
<div class="content col-sm-6" >
<a name=main ></a>
<div id="main" class=main >
    
<div class="settle row" >
    <div class="col-sm-6" >
    </div>
    <div class="col-sm-6" >
<h3>
    Help
</h3> 
<form action="feedback/index.php" method=post onsubmit=setDate('date_added'); >
    
    <input name=email type=text class=form-control placeholder=email style="margin-bottom:10px;" />
    
    <textarea name=text class=form-control placeholder=message style="height:70px;margin-bottom:10px;" ></textarea>
<button class="btn btn-primary" style="float:right;" >Send</button>
<input name=date_added type=text id=date_added class=invisible />
</form>
    </div>
</div>

<h3 class='center' >Offices</h3>

<div class=row style="margin-bottom:20px;" >
<div class=col-sm-6 >
    
</div>
<div class=col-sm-6  >
802 Sibukosezwe rd<br>
Imbali 13<br>
Pietermaritzburg<br>
Kwazulu Natal<br>
3201<br>
</div>
</div>
<div class=row style="margin-bottom:20px;" >
<div class=col-sm-6  >

</div>
<div class=col-sm-6 >
Shop 16 Ngulube Drive Informal Markets<br>
Browns Farm<br>
Philippi, Cape Town<br>
Western Cape<br>
7785<br>
</div>
</div>


</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
</div>
</div>
</div>
<?php
 include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/footer_2.php'; 
 ?>
</div>
</body>
</html>
<?php
$conn->close();
?>
