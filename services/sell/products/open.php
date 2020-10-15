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
<div class="col-sm-4" >

</div>
<div class="content col-sm-5" >
   
	<div id="main" class=main >
	   <div class=products id=products >
		   
		   <?php

$specification;
	
$sql = 'SELECT p.id,p.company_id,p.title,p.quantity,p.price,p.brand,p.specification,p.parameters,p.measurement,p.discount,DATE_FORMAT(p.date_added,"%d-%m-%y  %h:%i %p") AS date_time FROM'.
' product p  WHERE p.id='.$product_id;
   

if($result = $conn->query($sql)){
    
if($row = $result->fetch_assoc()){
	
	$more_than_one_product = false;
	
	
	$sql2 = "SELECT url FROM product_image WHERE product_id=".$row["id"];
	$result2 = $conn->query($sql2);
	$row2 = $result2->fetch_assoc();
	
	if($result2){

		echo '<div id=product_images >';
	while($row22=$result2->fetch_assoc()){
		 $more_than_one_product = true;
	echo '<span id="'.(strpos($row22["url"],'//')!==false?$row22["url"]:'product_images/'.$row22["url"]).'" /></span>';
	}
	   echo '</div>';
    }
	
$sql3 = 'SELECT DISTINCT COUNT(t.product_id) AS rank FROM'.
' transaction t WHERE t.product_id='.$row['id'];
	$result3 = $conn->query($sql3);
	$row3 = $result3->fetch_assoc();
	
          echo 
		   '</div><div class="col-sm-8" >'.
		   '<div class="scroll_x force_right" ><div class="variance_p" >';
		    
    if(isset($_SESSION['company_id'])?$_SESSION['company_id']==$row['company_id']:false){
	echo
	'<table class=company_options >'.
    '<td><a href="product_general.php?product_id='.$row['id'].'" >edit</a></td>'.
	'<td><a href=# onclick="deleteProduct('.$row['id'].');return false;" >delete</a></td>'.
	'</table>';
	}
		   
		   echo
		   '<a class=title href="products.php?product_id='.$row['id'].'" >'.$row['title'].'</a>'.
		   '<table class=p_head >'.
		   '<tr>'.
		   '<td class=price title=price >'.
		   'R'.$row['price'].
		   '</td>'.
		   '<td class=discount title=discount >'.($row['discount']?'-'.round($row['discount'],2).'%':'').'</td>'.
		   '<td class=sold title=sold >'.
		   ($row3['rank']?$row3['rank'].'<span class=caret ></span>':'').
		   '</td>'.
		   '</tr>'.
		   '</table>'.
		   '<a href="products.php?product_id='.$row['id'].'" ><img id=main_product_image class=main_product_image onmouseleave=" e(\'mother\').style.display = \'none\';" onmousemove="showMother(event);" src="'.(strpos($row2["url"],'//')!==false?$row2["url"]:'product_images/'.$row2["url"]).'" /></a>'.
		   
		   (ISSET($more_than_one_product)?
		   '<div style="text-align:center;" ><a href=# onclick="nextProduct();return false;" class=next_product > > </a></div>':'');
		   
		$result2 = $conn->query("SELECT logo,name,website FROM company WHERE id=".$row["company_id"]);
	       if($result2){
           $row2 = $result2->fetch_assoc();
		   echo 
		  
           '<table class=p_head >'.
		   '<tr>'.
		   '<td>'.
		   '<a class=company href="products.php?brand='.$row['brand'].'" >'.$row["brand"].'</a>'.
		   '</td>'.
		   '<td>'.($category=='grocery'?explode(';',$row['measurement'])[0].($row['title']=='Cooking Oil' || $row['title']=='Milk' || $row['title']=='Mass'?'lt':'kg'):'').'</td>'.
		   '<td>'.
		   '<span class=date ><a class=fshare href="https://facebook.com/sharer.php?u=https://www.productlists.co.za/services/sell/products/open.php?product_id=
'.$row['id'].'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600,top=150, left=\'+((screen.width/2)-300));return false;" >Share</a></span>'.
		   '</td>'.
		   '</tr>'.
		   '</table>';
		   }
		   
		   echo 
		   '<div class=params id=params >';
		   
		   $params = explode('/',$row['parameters']);
		   for($a=0;$a<count($params)-1;$a++){
		   $param_name = explode('>',$params[$a])[0];
		   echo '<select><option value="'.$param_name.'" >choose '.$param_name.'</option>';
		   
		   
		   $param_values = explode(';',explode('>',$params[$a])[1]);
		   
		   for($aa=0;$aa<count($param_values)-1;$aa++){
		   echo '<option value="'.$param_values[$aa].'" >'.$param_values[$aa].'</option>';
		   }
		   echo '</select>';
		   }
		   
		   echo 
		   '</div>'.
		   '<script>checkImageParameterAbility();</script>'.
		   '<div class="center block" >'.($category=='grocery'?'Specialized grocery delivery.':'Expect delivery within 2 weeks.').'</div>'.
		   
		   
		   ($row['quantity']>0?
		   '<div class=add_to_cart ><input id=cart_qty type=number value=1 placeholder="Qty" /><a class="btn btn-primary" id=add_to_cart href=# onclick="addToCart(setParameters('.$row['id'].'),this);return false;" >add to cart</a></div>':'<div class="block center" >Out of Stock</div>');
		  
	         $specification = $row['specification'];
			 
           echo 
		   '</div></div></div>';
		   
		   
    }
}
	
?>
		   
	</div>
	</div>

	<div id=tabs style="padding:40px;font-size:1em;" >
		<a href=# onclick="e('checkout').style.display='none';e('reviews').style.display='none';e('spec').style.display='';" class="space" >Description</a>
		<a href=# onclick="e('checkout').style.display='';e('reviews').style.display='none';e('spec').style.display='none';" class="space" >Checkout</a>
		<a href=# onclick="e('checkout').style.display='none';e('reviews').style.display='';e('spec').style.display='none';" class="space" >Reviews</a>
	</div>
	<div style="padding:10px;" >
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
	
	
</div>
<div class="col-sm-3" >

</div>
</div>
	<div class=row style="padding:20px;" >
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
</body>
</html>
<?php
$conn->close();
?>
