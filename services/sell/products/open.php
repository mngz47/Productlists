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
<div class="content col-sm-5" >
<a name=main ></a>
<div id="main" class=main >
<div id=mother style="display:none;position:absolute;left:500px;top:200px;border:2px solid black;width:300px;height:300px;z-index:30;" >
</div>    
<div class=products id=products >
<div class=row >
<div class=col-sm-2 >
</div>
</div>
</div>
<div class="content col-sm-7" >
   
	

	<div id=tabs >
		<a href=# onclick="e('checkout').style.display='none';e('reviews').style.display='none';e('spec').style.display='';" class="space" >Description</a>
		<a href=# onclick="e('checkout').style.display='';e('reviews').style.display='none';e('spec').style.display='none';" class="space" >Checkout</a>
		<a href=# onclick="e('checkout').style.display='none';e('reviews').style.display='';e('spec').style.display='none';" class="space" >Reviews</a>
	</div>
	
	<div id=spec >
	<?php echo '<p class=spec >'.$specification.'</p>';  ?>
	</div>
<div id=checkout style="display:none;" >
	 <?php
    
    if(!ISSET($_SESSION['customer_id'])){
     
    // include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/shopping_cart/q_c/quick_c.php');
   
    }
    
    include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/shopping_cart/face.php');
   
    
     ?>
  
    
    <?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/shopping_cart/footer.php'); ?>

	</div>
<div class=row id=reviews style="display:none;" >	
<?php
include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/services/sell/products/reply/index.php";
   
include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/services/sell/products/reply/list.php";
?>
</div>
	
</div>
<div class="col-sm-3" >

</div>
</div>
	
	<div class=row >
		<div class=col-sm-4 ><?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four_affiliate.php'); ?>
</div>
		<div class=col-sm-4 >
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/references.php'); ?>

<div id=left_pane_2 style="display:none;" >
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/relationship.php'); ?>
			</div>
<?php 
include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/option/index.php';
?>
	</div>
		<div class=col-sm-4 >
	<?php

$service_item = 2;
include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/cover_face.php';
 
?>
	</div>
		</div>
<?php 	
include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/footer_4.php"; 
?>

</div>
</div>
</body>
</html>
<?php
$conn->close();
?>
