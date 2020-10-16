<?php

session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

?>
<!DOCTYPE html>
<html>
<head>
<title>Productlists | Invest</title>
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

  <?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/header_3.php'; ?>
  
<div class="body row" >
<div class="col-sm-3" >
<div id=left_pane class="left_pane" >

<div id=left_pane_2 >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/relationship.php'; ?>
</div></div>
</div>
<div class="content col-sm-6" >
<a name=main ></a>

<div id="main" class=main >
  <p>
    <h3>Invest</h3>
      Help us gain competitive advantage as we automate the internet.</p>
    <div id=calculator >
          <p>
    <h2>Return Calculator<small>9% Interest</small></h2>
      First payment in begins in 3 Months</p>
    
        <span>Amount</span>
        <input type=number id=amount />
        <span>Period of Returns (Months)</span>
        <input type=number id=months onblur=calc_returns(); />
        <span>Returns</span>
        <input type=text id=returns />
        <a class="btn btn-primary" onclick="invest();" >invest</a>
        <script>
            
            function calc_returns(){
                  if(e('amount').value && e('months').value){
                     
                 //  e('returns').value = (e('amount').value + e('amount').value*0.09)/e('months').value ;
                      
                     }else{
                         alert('Fill in Amount and Period of Returns');
                     }
            }
            
            function invest(){
                
            }
            
        </script>
    </div>
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
