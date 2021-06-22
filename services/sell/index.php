<?php

include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/config.php');

$LOCATION = 'services/sell/index.php';

if(ISSET($_SESSION['customer_id'])){
    
}else{
	if(ISSET($_COOKIE['has_account'])){
header('Location:/member/signin_main.php');
	}else{
header('Location:/member/signup_main.php');
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Productlists | Sell Products</title>

include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/p_styles.php');
	
<meta name="viewport" content="width=device-width" />
<meta name="autor" content="Mongezi Mafunda" />
</head>
<body>
<script>
<?php 

if(ISSET($_SESSION['response'])){
	echo 'alert("'.$_SESSION['response'].'");';
	$_SESSION['response'] = null;
}

?>
</script>   
	
include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/p_scripts.php');
	
<div id=container class=p_cont >

<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/header_3.php'; ?>

<div class="body row" >
<div class="col-sm-3" >
<div id=left_pane class="left_pane" >
<div id=left_pane_1 >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four.php'; ?>
</div>
<div id=left_pane_3 >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four_control.php'; ?>
</div>
<div id=left_pane_2 style="display:none;" >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/relationship.php'; ?>
</div>
</div>
</div>
<div class="content col-sm-6" >
<a name=main ></a>
<div id="main" class=main >
    
    <?php
    
    $sql = 'SELECT id,name,logo FROM company WHERE member_id='.$_SESSION['customer_id'];
    $result = $conn->query($sql);
    if($result){
    while($row=$result->fetch_assoc()){
        echo
        '<a href="https://www.productlists.co.za/services/sell/open_company.php?company_id='.$row['id'].'" ><div class="block company" style="background-image:url(https://www.productlists.co.za/services/sell/company_images/'.$row['logo'].');background-repeat:no-repeat;background-size:70px auto;padding-left:74px;" >'.
        '<span>'.$row['name'].'</span></div></a>';
        
    }   
    }
    
    ?>

<a href="https://www.productlists.co.za/services/sell/company_general.php" ><div class="block company" style="background-image:url(https://www.productlists.co.za/resources/company.png);background-repeat:no-repeat;background-size:70px auto;padding-left:74px;" >
<span>New Company</span></div></a>


</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
       
</div>
</div>
</div>

<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/footer_4.php'; ?>


</div>
</body>
</html>
<?php
$conn->close();
?>
