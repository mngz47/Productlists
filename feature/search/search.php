<div class=scroll_x >
<?php
$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$t = 0;
$sql = 'SELECT COUNT(id) as t FROM product WHERE (title LIKE "%'.$_GET["text"].'%" OR specification LIKE "%'.$_GET["text"].'%" OR brand LIKE "%'.$_GET["text"].'%" OR  category LIKE "%'.$_GET["text"].'%") AND draft=0';
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$t = $row['t'];


$c = 0;
$end = $_GET["s"]*10+10;  

$sql = 'SELECT id,title,specification FROM product WHERE title LIKE "%'.$_GET["text"].'%" OR specification LIKE "%'.$_GET["text"].'%" OR brand LIKE "%'.$_GET["text"].'%" OR  category LIKE "%'.$_GET["text"].'%"';
$result = $conn->query($sql);
if($result){
	
echo '<table class=table >';

$row;

while($row = $result->fetch_assoc()){

    if($c<$end){
	$product_image = "";
	
	$sql2 = "SELECT url FROM product_image WHERE product_id=".$row["id"];
	$result2 = $conn->query($sql2);
	if($result2){
    $row2 = $result2->fetch_assoc();
    $product_image = $row2["url"];
	}
	
      echo '<tr>'.
		   '<td><a href="https://www.productlists.co.za/services/sell/products/open.php?product_id='.$row['id'].'" ><img src="'.(strpos($product_image,'//')!==false?$product_image:'https://productlists.co.za/services/sell/products/product_images/'.$product_image).'" width=40 /></a></td>'.
		   '<td><a href="https://www.productlists.co.za/services/sell/products/open.php?product_id='.$row['id'].'" >'.$row['title'].'</a></td>'.
		   '<td>'.(strlen($row['specification'])>20?substr($row['specification'],0,20).'...':$row['specification']).'</td>'.
		   '</tr>';
	  
	}
	  $c+=1;
    }
	
	echo 
	'</table>';
	
	include 'columns.php';
	
	include 'companies.php';
	
    $hide_s = false;
    $s = (($hide_s=($_GET["s"]*10>$t))?$_GET["s"]:$_GET["s"]+1);

	'<div class=search_nav >'.
	(!$hide_s?'<a class=more href=# onclick="sendreq_2(\'feature/search/search.php?text='.$_GET['text'].'&s='.$s.'\',e(\'main\'));" >load more</a>':'').
	'</div>';
	
	if($t==0){
		echo '<h4>No Results</h4>';
	}
}
$conn->close();
?>
</div>
