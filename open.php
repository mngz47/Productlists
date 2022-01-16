<?php

function getQueueDiscount($conn,$product_id,$q_price){
	$q_discount=0;
	$sql = 'SELECT COUNT(id) AS ii FROM queue WHERE product_id='.$product_id;
	$result = $conn->query($sql);
        
	   if($q_row = $result->fetch_assoc()){
	 	if($q_row['ii']){
	   
            $q_discount = ($q_price/3)($q_row['ii']/1000);
	    $q_discount = $q_price - $q_discount;
		   
		  }  
		  }	
		
          return round(($q_discount?$q_discount:$q_price));
}


function httpGet($url){
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
));
return curl_exec($curl);
curl_close($curl);
}


include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/config.php');

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
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-6WQ0XKPSP9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-6WQ0XKPSP9');
</script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
	
$page_meta_content = ($in_product?'|':($brand?'| You can now experience all products by "'.$brand.'"; we pride ourselves in local brands boosting the local economy ':($category?'| You can now scroll according to "'.$category.'" option; we are continually reducing the time it takes to complete transaction':'Welcome to technology: you can now share files, shop and experience the best of content. Productlists empowering the youth')));

?>
<title>Productlists <?php echo ($page_title); ?></title>
<link rel=stylesheet href=bootstrap.min.css />
<link rel=stylesheet href=style.css />
<link rel=stylesheet href=mobstyle.css />
<link rel=stylesheet href=input_style.css />
<link rel=stylesheet href=scroll_style.css />
<link rel=stylesheet href=feature/sign/style.css />
<link rel=stylesheet href=feature/search/style.css />
<link rel=stylesheet href=https://<?php echo $HOME_; ?>/feature/feedback/style.css />
<link rel=stylesheet href=https://<?php echo $HOME_; ?>/verification_style.css />
<link rel=stylesheet href=https://<?php echo $HOME_; ?>/services/grocery/grocery_style.css />
<link rel=stylesheet href=services/sell/products/style.css />
<link rel=stylesheet href=https://<?php echo $HOME_; ?>/services/sell/products/feature/feeling/style.css />
<link rel=stylesheet href=https://<?php echo $HOME_; ?>/feature/shopping_cart/style.css />
<link rel="shortcut icon" type="image/png" href="https://<?php echo $HOME_; ?>/resources/logo.png" />
<meta name="viewport" content="width=device-width" />
<meta name="description" content="<?php echo ($page_meta_content); ?> " />
<meta name="keywords" content="productlists,product,sell,discount,cheap,latest,best selling,local,mzansi,south africa,pietermaritzburg,kzn,online shopping,technology,share files,music,documents,content,learn,education,information" />
<meta name="autor" content="Mongezi Mafunda" />
</head>
<body>

<script src=https://<?php echo $HOME_; ?>/api.js ></script>
<script src=https://<?php echo $HOME_; ?>/verification.js ></script>

<script src=https://<?php echo $HOME_; ?>/feature/search/api.js ></script>
<script src=https://<?php echo $HOME_; ?>/feature/sign/api.js ></script>
<script src=https://<?php echo $HOME_; ?>/services/sell/products/api.js ></script>

<script src=https://<?php echo $HOME_; ?>/feature/shopping_cart/api.js ></script>
<script src=https://<?php echo $HOME_; ?>/services/sell/products/feature/option/api.js ></script>

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
<div class="col-sm-1" >

</div>
<div class="content col-sm-5" >
   
	<div id="main" class=main >
	   <div class=products id=products >
<?php

$conn = new mysqli($HOST_,$USER_,$PASS_,$DATABASE_);

$specification;
	
$sql = 'SELECT p.id,p.company_id,p.title,p.quantity,p.price,p.brand,p.specification,p.parameters,p.measurement,p.discount,p.bulk,DATE_FORMAT(p.date_added,"%d-%m-%y  %h:%i %p") AS date_time FROM'.
' product p  WHERE p.id='.$product_id;
   

if($result = $conn->query($sql)){
    
if($row = $result->fetch_assoc()){
	
	$more_than_one_image = false;
	
	$images = '';
	
	echo 
	
	'<div class=row >'.
	'<div class=col-sm-3 >';
	$sql2 = "SELECT url FROM product_image WHERE product_id=".$row["id"];
	$result2 = $conn->query($sql2);
	$row2 = $result2->fetch_assoc();
	
	if($result2){

	while($row22=$result2->fetch_assoc()){
		 $more_than_one_image = true;
		 $images .= '<span id="'.(strpos($row22["url"],'//')!==false?$row22["url"]:'product_images/'.$row22["url"]).'" />'.
		 '<img src="'.(strpos($row22["url"],'//')!==false?$row22["url"]:'product_images/'.$row22["url"]).'" width=50px height=auto title="'.$row['title'].'" />'.
		 '</span>';
	}
    }
	/*
$sql3 = 'SELECT DISTINCT COUNT(t.product_id) AS rank FROM'.
' transaction t WHERE t.product_id='.$row['id'];
	$result3 = $conn->query($sql3);
	$row3 = $result3->fetch_assoc();
	*/
          echo 
		   '</div><div class="col-sm-8" >'.
		   '<div class="scroll_x force_right" ><div class="variance_p" >';
		    
    if(isset($_SESSION['company_id'])?$_SESSION['company_id']==$row['company_id']:false){
	echo
	'<table class=company_options >'.
    '<td><a href="/services/sell/products/product_general.php?product_id='.$row['id'].'" >edit</a></td>'.
	'<td><a href=# onclick="deleteProduct('.$row['id'].');return false;" >delete</a></td>'.
	'</table>';
	}
		   
		   echo
		   '<a class=title href="products.php?product_id='.$row['id'].'" >'.$row['title'].'</a>'.
		   '<table class=p_head >'.
		   '<tr>'.
		   '<td class=price title=price >'.
		   'R'.($row['bulk']==1?getQueueDiscount($conn,$_GET['product_id'],$row['price']):$row['price']).
		   '</td>'.
		   '<td class=discount title=discount >'.($row['discount']?'-'.round($row['discount'],2).'%':'').'</td>'.
		   '<td class=sold title=sold >'.
		   ($row3['rank']?$row3['rank'].'<span class=caret ></span>':'').
		   '</td>'.
		   '</tr>'.
		   '</table>'.
		   '<a href="products.php?product_id='.$row['id'].'" ><img title="'.$row['title'].'" id=main_product_image class=main_product_image onmouseleave=" e(\'mother\').style.display = \'none\';" onmousemove="showMother(event);" src="'.(strpos($row2["url"],'//')!==false?$row2["url"]:'product_images/'.$row2["url"]).'" /></a>'.
		   
		   (ISSET($more_than_one_image)?
		   '<div style="text-align:center;" id=product_images >'.
		   $images.
		   '<a href=# onclick="nextProduct();return false;" class=next_product > > </a>'.
		   '</div>':'');
		   
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
		   '<span class=date ><a class=fshare href="https://facebook.com/sharer.php?u=https://'.$HOME_.'/open.php?product_id=
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
	</div>
</div>
<div class="col-sm-6" >

	<div id=tabs style="padding:10px;font-size:1.2em;" >
		<a href=# onclick="e('checkout').style.display='none';e('reviews').style.display='none';e('spec').style.display='';e('queue').style.display='none';return false;" class="space" >Description</a>
		
		<?php
		
		$queue_checkout;
		if(ISSET($row['bulk']) && $row['bulk']==1){
			$sql = 'SELECT COUNT(id) AS ii FROM queue WHERE product_id='.$_GET['product_id'];
$result = $conn->query($sql);
	       if($q_row = $result->fetch_assoc()){
			   
		   if($q_row['ii']%100>7){
			  $queue_checkout = 1; 
		   }
	         }
		}
		?>
		
		<a href=# <?php echo ($queue_checkout || !$row['bulk']?'':'style="display:none;"'); ?> onclick="e('checkout').style.display='';e('reviews').style.display='none';e('spec').style.display='none';e('queue').style.display='none';return false;" class="space" >Checkout</a>
		
		<a href=# <?php echo (ISSET($row['bulk']) && $row['bulk']==1?'':'style="display:none;"'); ?> onclick="e('checkout').style.display='none';e('reviews').style.display='none';e('spec').style.display='none';e('queue').style.display='';return false;" class="space" >Queue</a>
		
		<a href=# onclick="e('checkout').style.display='none';e('reviews').style.display='';e('spec').style.display='none';e('queue').style.display='none';return false;" class="space" >Reviews</a>
	</div>
	<div style="padding:10px;" >
	<div id=spec <?php echo (ISSET($row['bulk']) && $row['bulk']==1?'style="display:none;"':''); ?> >
	<?php echo '<p class=spec >'.$specification.'</p>';  ?>
	</div>
	<div id=queue <?php echo (ISSET($row['bulk']) && $row['bulk']==1?'':'style="display:none;"'); ?> >
	<?php 
		
		
		if(ISSET($row['bulk']) && $row['bulk']==1){
		include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/queue/index.php'; 
		}else{
			echo '<p>Feature is supported for items available in bulk.</p>';
		}
	?>
	</div>
<div id=checkout style="display:none;" >
	 <?php
    	
  //  include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/shopping_cart/face.php');
  //  include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/shopping_cart/footer.php'); 
	
     ?>
	</div>
<div class=row id=reviews style="display:none;" >	
	
	<?php 
	$conn = new mysqli($HOST_,$USER_,$PASS_,$DATABASE_);
	$sql = 'SELECT ali_productId,ali_companyId FROM product WHERE id='.$_GET['product_id'];
$result = $conn->query($sql);
	       if($row = $result->fetch_assoc()){
		       //echo 'test('.$row['ali_productId'].','.$row['ali_companyId'].')';
			if($row['ali_productId'] && $row['ali_companyId']){
	echo '<iframe width=100% height=470px src="https://feedback.aliexpress.com/display/productEvaluation.htm?v=2&productId='.$row['ali_productId'].'&ownerMemberId='.$row['ali_companyId'].'" ></iframe>';
			} 
		  }
	?>

<?php
include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/services/sell/products/reply/index.php";
   
include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/services/sell/products/reply/list.php";
?>
</div>
</div>
</div>
</div>
<div class=row style="padding:20px;" >
		
</div>
	
	<script src="https://productlists-reviews.herokuapp.com/face_api.js" ></script>
	<div id=productlists-reviews ></div>
	<script>
	var req = sendreq_3("https://productlists-reviews.herokuapp.com/face.php?title=<?php echo $t; ?>",e("productlists-reviews"));
req.onload = function(){
	target.innerHTML = req.responseText;
	e('yt_title').innerHTML = e('amazon_products').getElementsByTagName('span')[0].innerHTML;
	e('group_four_affiliate_video_dd').innerHTML = e('amazon_products').getElementsByTagName('p')[0].innerHTML;	
};
	</script>

	<iframe src="https://agg-v3.herokuapp.com/index.html?aff_link=<?php echo $HOME_."/open.php?product_id=".$_GET['product_id']; ?>&category=<?php echo $category; ?>"   style="width:0px;height:0px;overflow-x:hidden;overflow-y:hidden;" ></iframe>
	
<?php 	
include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/footer_4.php"; 
?>
</div>
</body>
</html>
<?php
$conn->close();
?>
