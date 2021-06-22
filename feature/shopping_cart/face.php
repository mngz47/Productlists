<div class=cart_face >
<?php

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

if(ISSET($_SESSION['cart'])){
$products = explode('&',$_SESSION['cart']);

$nop = (count($products)-1);

echo $nop>0?'<a href=https://www.productlists.co.za/feature/shopping_cart/index.php ><h4>Shopping Cart ('.$nop.')</h4></a>':'';

for($a=0;$a<$nop;$a++){

$id = explode('/',$products[$a])[0];
$sql = 'SELECT id FROM product WHERE id='.$id;
$result = $conn->query($sql);

if($result){
$row = $result->fetch_assoc();

	$sql2 = "SELECT url FROM product_image WHERE product_id=".$row["id"];
	$result2 = $conn->query($sql2);
	if($result2){
    $row2 = $result2->fetch_assoc();
	  echo 
		   '<img src="'.(strpos($row2["url"],'https://')!==false?$row2["url"]:'https://www.productlists.co.za/services/sell/products/product_images/'.$row2["url"]).'" width=40 />'; 
		
	}
}
}
}

?>
</div>
<style>
    .cart_face {
        margin:7px;
    }
    
    .cart_face img {
        margin:4px;
    }
    
</style>