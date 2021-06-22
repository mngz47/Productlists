<?php

include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/config.php');

?>
<!DOCTYPE html>
<html>
<head>
<title>Productlists | Invest</title>
  
<link rel=stylesheet href=https://listro.co.za/style.css />
<link rel=stylesheet href=https://<?php echo $HOME_; ?>/index_style.css />
  
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/p_styles.php'); ?>
  
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
  
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/p_scripts.php'); ?>
  
<div id=container class=p_cont >

  <?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/header_3.php'; ?>
  
<div class="body row" >
<div class="col-sm-3" >
<div id=left_pane class="left_pane" >
<div id=left_pane_1 >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four.php'; ?>
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
    <h2>Invest</h2>
   Help us gain competitive advantage.<br>
  <strong>Financail Needs</strong><br>
  <table style="width=400px;margin:20px;" >
    <tr><td>Advertising</td></tr>
    <tr><td>Mobile App</td></tr>
  </table>
  After you process the transaction you will recieve personal email from us with confirmation.<br>
  To make investment greater than R6000 access <a href=https://<?php echo $HOME_; ?>/customer_service/faq.php >FAQ</a> for banking details.
  </p>
    <div id=calculator style="width:333px;margin-left:auto;margin-right:auto;margin-bottom:20px;" >
          <p>
    <h3>Return Calculator<small> 9% Interest</small></h3>
      First payment begins in 3 Months</p>
    
        <span>Amount</span>
        <input type=number id=amount onblur=calc_returns(); class="form-control" />
        <span>Period of Return (Months)</span>
        <input type=number id=months onblur=calc_returns(); class="form-control"  />
        <span>Monthly Return</span>
        <input type=text id=returns class="form-control"  />
        <a  href=# class="btn btn-primary" style="float:right;margin:5px;" onclick="invest();return false;" >invest</a>
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
  <script>
            
            function calc_returns(){
                  if(e('amount').value && e('months').value){
                     
                    var aa = parseInt(e('amount').value);
                    var mm = parseInt(e('months').value);
                    
                  e('returns').value = Math.round((aa + aa*0.09)/mm);
                      
                     }else{
                         alert('Fill in Amount and Period of Returns');
                     }
            }
            
            function invest(){
                e('amount_ff').value = e('amount').value;
                e('item_name').value += e('months').value+' Months';
              e('payment_ff').submit();
            }
            
        </script>
<form action=https://www.payfast.co.za/eng/process method=post id=payment_ff class=invisible >
<input type=text name=merchant_id value=12647788 />
<input type=text name=merchant_key value=nliu1lbt07r75 />
<input type=text name=return_url value=https://www.productlists.co.za/invest.php?pp=1 />
<input type=text name=cancel_url value=https://www.productlists.co.za/invest.php?pp=0 />
<input type=text id=amount_ff name=amount />
<input type=text id=item_name name=item_name value="Investment " />
<input type=text name=email_confirmation value="1" />
</form>
</body>
</html>
<?php
$conn->close();
?>
