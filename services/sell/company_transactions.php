<?php

include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/config.php');

$LOCATION = 'services/sell/company_transactions.php';

if(!ISSET($_SESSION['company_id'])){
header('Location:/services/sell/company_general.php');
	
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Productlists | Company Transaction</title>
	
include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/p_styles.php');
	
<meta name="viewport" content="width=device-width" />
<meta name="autor" content="Mongezi Mafunda" />
</head>
<body>
	
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
<div id=left_pane_2 style="display=none" >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/relationship.php'; ?>
</div>
</div>
</div>
<div class="content col-sm-6" >
<a name=main ></a>
<div id="main" class=main >
<div class=scroll_x >
<table class=table >
<tr><th>product</th><th>date</th><th>parameters</th><th>qty</th><th>status</th></tr>
<?php

$no_of_t;

$sql = 'SELECT count(id) as no_of_t FROM transaction WHERE company_id='.$_SESSION['company_id'];
$result = $conn->query($sql);
if($result){
$row = $result->fetch_assoc();
$no_of_t = $row['no_of_t'];
}

	 $c = 0;
     $begin = (ISSET($_GET["st"])?$_GET["st"]*10:0);
     $end = $begin+10;
	 
$sql = 'SELECT product_id,DATE_FORMAT(date,"%d-%m-%y  %h:%i %p") AS date_time,params,qty,status FROM transaction WHERE company_id='.$_SESSION['company_id'].' ORDER BY date DESC';
$result = $conn->query($sql);

if($result){
while($row = $result->fetch_assoc()){

if($c<$end){

$sql2 = 'SELECT id,title FROM product WHERE id='.$row['product_id'];
$result2 = $conn->query($sql2);
if($result2){
$row2 = $result2->fetch_assoc();
echo '<tr>'.
     '<td><a href="https://www.productlists.co.za/services/sell/products/products.php?product_id='.$row2['id'].'" >'.$row2['title'].'</a></td>'.
	 '<td>'.$row['date_time'].'</td>'.
	 '<td>'.$row['params'].'</td>'.
	 '<td>'.$row['qty'].'</td>'.
	 '<td><textarea onblur="updateTransactionStatus(this,'.$row['id'].');" >'.$row['status'].'</textarea></td>'.
	 '</tr>';
	 
}
}else if($c==$end){
break;
}
$c+=1;
}
}

$st = (ISSET($_GET["st"])?($_GET["st"]*10<$no_of_t?$_GET["st"]+1:$_GET["st"]):1);

$has_more = ($st*10<$no_of_t);

echo '</table></div>'.

($has_more?
     '<div class=nav >'.
	 '<a class=more href=company_transactions.php?st='.$st.' >load more</a>'.
     '</div>':'');
    
?>
</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
<div id=right_pane_1 >
<?php 
include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/option/index.php';
?>
</div>
</div>
</div>
</div>

<?php
 include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/footer_4.php"; 
?>

</div>
</body>
</html>
<?php
$conn->close();
?>
