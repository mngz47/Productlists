<?php

include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/config.php');

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

function getQueueDiscount($product_id,$price){
	$q_discount;
	$sql = 'SELECT COUNT(id) AS ii FROM queue WHERE product_id='.$product_id;
$result = $conn->query($sql);
	       if($result){
			   $q_row = $result->fetch_assoc();
			   
			   
		   if($q_row['ii']>0){
			   
                 $q_discount = 	$price - (($price/3)*($q_row['ii']/1000));
		   }
		   }
		   return ($q_discount?$q_discount:$price);
}

$LOCATION = 'feature/shopping_cart/index.php';

if(ISSET($_GET['params']) && ISSET($_GET['qty'])){
	
if(ISSET($_SESSION['cart'])){
$_SESSION['cart'] = $_SESSION['cart'].$_GET['product_id'].'/'.$_GET['qty'].'/'.$_GET['params'].'&';
}else{
$_SESSION['cart'] = $_GET['product_id'].'/'.$_GET['qty'].'/'.$_GET['params'].'&';
}

$sql = 'SELECT title FROM product WHERE id='.$_GET['product_id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$name_of_product = $row['title'];

 mail('mngz636@gmail.com','Productlists Shopping Cart','action> '.$name_of_product.' >');

echo 'success';
exit();
}else if(ISSET($_GET['cart_target'])){
$_SESSION['cart'] = str_replace($_GET['cart_target'].'&','',$_SESSION['cart']);
}

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Productlists | Shopping Cart</title>
	
include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/p_styles.php');
	
<meta name="viewport" content="width=device-width" />
<meta name="description" content="Welcome to productlists, let's help you experience the best of technology - we are ready to embrace your partnership." />
<meta name="keywords" content="productlists,contact,south africa,pietermaritzburg,kzn,online shopping,technology,file sharing,music,documents,content,member,company,directory,column,products" />
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

<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/header_3.php"; ?>

<div class="body row" >
<div class="col-sm-3" >
<div id=left_pane class="left_pane" >
<div id=left_pane_1 >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four.php'; ?>
</div>
<div id=left_pane_2 style="display:none;">
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/relationship.php'; ?>
</div></div>
</div>
<div class="content col-sm-6" >
<a name=main ></a>
<div id="main" class=main >
<div class="block center" >
The delivery cost remains the same regardless of the method you choose, this is because we are helping pay for your delivery.
<p>Flat Rate Delivery</p>
</div>
<div class="row shopping_cart scroll_x" >
<table class="table" ><tr><th></th><th>title</th><th>weight</th><th>params</th><th class=highlight_green >original price</th><th class=highlight >dicount price</th><th>Qty</th><th></th></tr>
<?php
$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$total_cost = 0;

$delivery = 0;

if(ISSET($_SESSION['cart'])){
$products = explode('&',$_SESSION['cart']);

$total_products = 0;

for($a=0;$a<count($products)-1;$a++){

$id = explode('/',$products[$a])[0];
$sql = 'SELECT id,company_id,title,price,discount,measurement,shipment_cost,bulk FROM product WHERE id='.$id;
$result = $conn->query($sql);

if($result){
$row = $result->fetch_assoc();
	$product_image = "";
	
	$sql2 = "SELECT url FROM product_image WHERE product_id=".$row["id"];
	$result2 = $conn->query($sql2);
	if($result2){
    $row2 = $result2->fetch_assoc();
	  echo '<tr>'.
		   '<td><img src="'.(strpos($row2["url"],'https://')!==false?$row2["url"]:'https://www.productlists.co.za/services/sell/products/product_images/'.$row2["url"]).'" width=40 /></td>'.
		   '<td><a href="https://www.productlists.co.za/services/sell/products/products.php?product_id='.$row['id'].'" >'.$row['title'].'</a></td>'.
		   '<td>'.(explode(';',$row['measurement'])[0]).($row['title']=='Cooking Oil' || $row['title']=='Milk' || $row['title']=='Mass'?'lt':'kg').'</td>';
		  $qty = explode('/',$products[$a])[1];
		  
		  $total_products+=$qty;
		  
		  $params = explode(';',explode('/',$products[$a])[2]);
      
	  echo '<td>';
     for($aa=0;$aa<count($params)-1;$aa++){
	 echo explode('>',$params[$aa])[0].' . '.explode('>',$params[$aa])[1].'; ';
	 }
      echo 
	  '</td>'.
	   '<td><span><strike>R'.($row['price']+($row['price']*$row['discount']/100)).'</strike></span></td>'.
	   '<td><span>R'.($row['bulk']==1?getQueueDiscount($row['id'],$row['price']):$row['price']).'</span></td>'.
	   '<td><span>'.$qty.'</span></td>'.
	   '<td><a href="https://www.productlists.co.za/feature/shopping_cart/index.php?cart_target='.$products[$a].'" >X</a></td></tr>'; 
		
		   $total_cost+=(($row['bulk']==1?getQueueDiscount($row['id'],$row['price']):$row['price'])*$qty);
		   $delivery+=$row['shipment_cost']*$qty;
		  
	}
}
}



if($total_products>0){
    
$delivery = round($delivery/$total_products);    //Average Delivery Cost
$total_cost+=$delivery;

}
}
?>
<tr><td></td><td></td><td></td><td></td><td><b>Delivery</b></td><td class=total >R<?php echo $delivery; ?></td><td></td></tr>
<tr><td></td><td></td><td></td><td></td><td><b>Total</b></td><td class=total >R<?php echo $total_cost; ?></td><td></td></tr></table>
</div>
<?php

include 'footer.php';

?>
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
