<?php
if(ISSET($_GET['target'])){
$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');
if(ISSET($_SESSION['customer_id'])){
if($_GET['t']=='a'){
$sql = 'INSERT INTO taste (id,customer_id,opt) VALUES (0,'.$_SESSION['customer_id'].',"'.$_GET['target'].'");';
$result = $conn->query($sql);
echo $result;
}else if($_GET['t']=='r'){
$sql = 'DELETE FROM taste WHERE opt="'.$_GET['target'].'"';
$result = $conn->query($sql);
echo $result;
}
}else if($_COOKIE['has_account']){
echo 'signin';
}else{
echo 'signup';
}
$conn->close();
exit();
}

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$taste = '';
if(ISSET($_SESSION['customer_id'])){
$sql = 'SELECT opt FROM taste WHERE customer_id='.$_SESSION['customer_id'];
$result = $conn->query($sql);
if($result){
while($row = $result->fetch_assoc()){
$taste.=$row['opt'];
}
}
}

$sql = 'SELECT DISTINCT category FROM product';
$result = $conn->query($sql);

if($result){
echo '<a name=options ></a>'.
'<a href="https://www.productlists.co.za/services/sell/products/products.php?category=" ><div class="block opt_begin" >all options</div></a>';
while($row = $result->fetch_assoc()){
	
	$latest_image;
	
	if($result2=($conn->query("SELECT id FROM product WHERE category='".$row['category']."' ORDER BY date_added DESC"))){
		if($row2 = $result2->fetch_assoc()){
			if($result3=($conn->query('SELECT url FROM product_image WHERE product_id='.$row2['id']))){
		     if($row3 = $result3->fetch_assoc()){
			 $latest_image = $row3['url'];
		     }
	        }
		}
	}
	
echo 
'<div class="'.(ISSET($category)?($category==$row['category']?'block_hoov':'block'):'block').' opt" >'.
'<a href="https://www.productlists.co.za/services/sell/products/products.php?category='.$row['category'].'" >'.
'<div style="background-image:url('.(strpos($latest_image,'//')!==false?$latest_image:'https://www.productlists.co.za/services/sell/products/product_images/'.$latest_image).');" >'.

$row['category'].'</div></a>'.
'<input type=checkbox value="'.$row['category'].'" '.($taste?(strpos($row['category'],$taste)!=-1?'checked=true':''):'').' onchange="addOption(this);" />'.
'</div>';

}
}
?>
