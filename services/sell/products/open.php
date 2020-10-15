<?php
session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$LOCATION = 'services/sell/products/open.php?product_id='.$_GET['product_id'];

$category = '';

$brand = '';

if(ISSET($_GET['product_id'])){
$sql = 'SELECT category,brand FROM product WHERE id='.$_GET['product_id'];
$result = $conn->query($sql);
	       if($result){
		   $row = $result->fetch_assoc();
		   $category = $row['category'];
		   $brand = $row['brand'];
		   }
}

if(ISSET($_COOKIE['product_view_lock']) && ISSET($_SESSION['customer_id']) && strpos($_COOKIE['product_view_lock'],$_SESSION['customer_id']."_".$_GET['member_id'])==-1){
    //update views specific to signed in user

    setcookie('product_view_lock',($_COOKIE['product_view_lock'].";".$_SESSION['customer_id']."_".$_GET['member_id']),time() + (86400 * 30 * 7),'/');
    
    $sql = 'INSERT INTO views (id,date_added,from_,from_id,member_id,device_id) VALUES (0,"'.date('Y-m-d H:i').'",1,'.$_GET['product_id'].','.$_SESSION['customer_id'].','.$_COOKIE['device_usage_id'].')';
    $conn->query($sql); 
    
}else if($_COOKIE['product_view_lock']==null || strpos($_COOKIE['product_view_lock'],"-1_".$_GET['member_id'])==-1){
    //update views based on device
   
    setcookie('product_view_lock',(ISSET($_SESSION['customer_id'])?$_SESSION['customer_id']:'-1_'.$_GET['member_id']),time() + (86400 * 30 * 7),'/');
   
    $sql = 'INSERT INTO views (id,date_added,from_,from_id,device_id) VALUES (0,"'.date('Y-m-d H:i').'",1,'.$_GET['product_id'].','.$_COOKIE['device_usage_id'].')';
    $conn->query($sql); 
    
}

$product_id = $_GET['product_id'];

$in_product = true;

?>

<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 

$t;
$b;
$o;

$row;

if($in_product){
$sql = "SELECT title,brand,category,specification FROM product WHERE id=".$product_id;
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	
	$t = $row['title'];
	$b = $row['brand'];
	$o = $row['category'];
}

$page_title = ($in_product?'| '.$o.' | '.$b.' | '.$t:  ($brand?'| all products by '.$brand:($category?'| all '.$category:'')) );
	
$page_meta_content = ($in_product?'| '.$row['specification']:($brand?'| You can now experience all products by "'.$brand.'"; we pride ourselves in local brands boosting the local economy ':($category?'| You can now scroll according to "'.$category.'" option; we are continually reducing the time it takes to complete transaction':'Welcome to technology: you can now share files, shop and experience the best of content. Productlists empowering the youth')));

?>
<title>Productlists <?php echo ($page_title); ?></title>
<link rel=stylesheet href=https://productlists.co.za/bootstrap.min.css />
<link rel=stylesheet href=https://productlists.co.za/style.css />
<link rel=stylesheet href=https://productlists.co.za/mobstyle.css />
<link rel=stylesheet href=https://productlists.co.za/input_style.css />
<link rel=stylesheet href=https://productlists.co.za/scroll_style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/sign/style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/search/style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/feedback/style.css />
<link rel=stylesheet href=https://www.productlists.co.za/verification_style.css />
<link rel=stylesheet href=https://productlists.co.za/services/grocery/grocery_style.css />
<link rel=stylesheet href=https://productlists.co.za/services/sell/products/style.css />
<link rel=stylesheet href=https://productlists.co.za/services/sell/products/feature/feeling/style.css />
<link rel=stylesheet href=https://www.productlists.co.za/feature/shopping_cart/style.css />
<link rel="shortcut icon" type="image/png" href="https://productlists.co.za/logo.png" />
<meta name="viewport" content="width=device-width" />
<meta name="description" content="<?php echo ($page_meta_content); ?> " />
<meta name="keywords" content="productlists,product,sell,discount,cheap,latest,best selling,local,mzansi,south africa,pietermaritzburg,kzn,online shopping,technology,share files,music,documents,content,learn,education,information" />
<meta name="autor" content="Mongezi Mafunda" />
</head>
<body>

<script src=https://productlists.co.za/api.js ></script>
<script src=https://productlists.co.za/verification.js ></script>

<script src=https://productlists.co.za/feature/search/api.js ></script>
<script src=https://productlists.co.za/feature/sign/api.js ></script>
<script src=https://productlists.co.za/services/sell/products/api.js ></script>

<script src=https://productlists.co.za/feature/shopping_cart/api.js ></script>
<script src=https://productlists.co.za/services/sell/products/feature/option/api.js ></script>

<script>
<?php 

if(ISSET($_SESSION['response'])){
	echo 'alert("'.$_SESSION['response'].'");';
	$_SESSION['response'] = null;
}
?>

</script>
<div class=scroll_master >
<div class=p_cont >
    <?php
    $sql2 = "SELECT url FROM product_image WHERE product_id=".$_GET['product_id'];
	$result2 = $conn->query($sql2);
	$row2 = $result2->fetch_assoc();
	
	echo '<img src="'.(strpos($row2["url"],'//')!==false?$row2["url"]:'product_images/'.$row2["url"]).'" style="display:none;" />';
	
    ?>

<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/header_3.php'); ?>

<div class="body row" >
<div class="col-sm-2" >

</div>
<div class="content col-sm-7" >
   

	
	
</div>
<div class="col-sm-3" >

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
