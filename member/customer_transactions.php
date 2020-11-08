<?php
session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$LOCATION = 'member/customer_transaction.php';

if(!ISSET($_SESSION['customer_id'])){
	
if(ISSET($_COOKIE['has_account'])){
	header('Location:/member/signin_main.php');
	}else{
	header('Location:/member/signup_main.php');	
	}

}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Productlists | Transaction</title>
<link rel=stylesheet href=https://www.productlists.co.za/style.css />
<link rel=stylesheet href=https://www.productlists.co.za/bootstrap.min.css />
<link rel=stylesheet href=https://www.productlists.co.za/mobstyle.css />
<link rel=stylesheet href=https://www.productlists.co.za/feature/sign/style.css />
<link rel=stylesheet href=https://www.productlists.co.za/feature/search/style.css />
<link rel="shortcut icon" type="image/png" href="https://www.productlists.co.za/resources/logo.png" />
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
<script src=https://www.productlists.co.za/api.js ></script>
<script src=https://www.productlists.co.za/feature/search/api.js ></script>
<script src=https://www.productlists.co.za/feature/sign/api.js ></script>
<div id=container class=p_cont >
    
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/header_3.php"; ?>

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
<div class=block >
<h3>Transactions</h3>    
</div>
<div class=scroll_x >
<?php
if(ISSET($_SESSION['customer_id'])){

echo '<table class=table >'.
	 '<tr><th>date</th><th>status</th><th>cart</th></tr>';
	 
$no_of_t;

$sql = 'SELECT count(id) as no_of_t FROM cart WHERE customer_id='.$_SESSION['customer_id'];
$result = $conn->query($sql);
if($result){
$row = $result->fetch_assoc();
$no_of_t = $row['no_of_t'];
}

	 $c = 0;
     $end = (ISSET($_GET["s"])?$_GET["s"]*10+10:10);;
	 
$sql = 'SELECT id,date,status,products FROM cart WHERE customer_id='.$_SESSION['customer_id'].' ORDER BY date DESC';
$result = $conn->query($sql);

if($result){
while($row = $result->fetch_assoc()){
if($c<$end){

echo '<tr>'.
     '<td>'.$row['date'].'</td>'.
	 '<td class=highlight ><span id=status >'.$row['status'].'</span><div><input type=text placeholder="reply message" onblur="sendStatus('.$row['id'].',this);" /></div></td>'.
	 '<td>'.($row['products']?'<a href=# onclick=openCart('.$row['id'].'); >open</a>':'').'</td>'.
	 '</tr>';
	 
}else if($c==$end){
break;
}
$c+=1;
}
}

$hide_s = false;
$s = (ISSET($_GET["s"])?(($hide_s=($_GET["s"]*10>$no_of_t))?$_GET["s"]:$_GET["s"]+1):(($hide_s=(10>$no_of_t))?1:$_GET["s"]+1));

echo '</table>'.
     '<div class=nav>'.
     (!$hide_s?'<a class=more href=customer_transaction.php?s='.$s.' >load more</a>':'').
     '</div>';
}
?>
</div>
</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
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
