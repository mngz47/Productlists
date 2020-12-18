<div class=block >
        <h3>Categories</h3>
    </div>
    <div id=category_list >
           
<?php

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$sql = 'SELECT DISTINCT category FROM product';
$result = $conn->query($sql);

if($result){
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

'<a href="https://www.productlists.co.za/services/sell/products/products.php?category='.$row['category'].'" id="'.(strpos($latest_image,'http')!==false?$latest_image:'https://www.productlists.co.za/services/sell/products/product_images/'.$latest_image).'" onclick=catergory_transport(this); >'.
$row['category'].'</a>';

}
}
?>
</div>
<style>
    #category_list a{
        display:block;
        font-size:1.2em;
        rgba(0,0,0,0.2);
        box-shadow: -1px -1px 7px 0px rgba(0,0,0,0.2);
        margin-bottom:3px;
        padding-left:4px;
    }
</style>
