<?php
session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$LOCATION = 'services/sell/products/products.php';

$category = (ISSET($_GET['category'])?$_GET['category']:(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[0]:''));

$category_type = (ISSET($_GET['category_type'])?$_GET['category_type']:(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[7]:''));

$brand = (ISSET($_GET['brand'])?$_GET['brand']:(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[6]:''));

$alph = (ISSET($_GET['alph'])?$_GET['alph']:(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[1]:''));
$alph = (ISSET($_COOKIE['auto']) && ISSET($_GET['alph'])?(explode(';',$_COOKIE['auto'])[1]==$alph?'':$alph):$alph);



if(ISSET($_GET['category']) && $_GET['category']){
    $category_type = '';
    $brand = '';
    $alph = '';
}else if(ISSET($_GET['category_type']) && $_GET['category_type']){
    $category = '';
    $brand = '';
    $alph = '';
}else if(ISSET($_GET['brand']) && $_GET['brand']){
    $category_type = '';
    $category = '';
    $alph = '';
}else if(ISSET($_GET['alph']) && $_GET['alph']){
    $category_type = '';
    $category = '';
    $brand = '';
}


$title = (ISSET($_GET['title'])?true:false);
$love = (ISSET($_GET['love'])?true:false);
$angry = (ISSET($_GET['angry'])?true:false);
$happy = (ISSET($_GET['happy'])?true:false);
$cheapest = (ISSET($_GET['cheapest'])?true:false);
$latest = (ISSET($_GET['latest'])?true:false);
$best_selling = (ISSET($_GET['best_selling'])?true:false);
$discount = (ISSET($_GET['discount'])?true:false);

//conditions neccesary to access cookie cached scroll conditions
if(!$title && !$love && !$angry && !$happy && !$cheapest && !$latest && !$best_selling && !$discount){
$title = (ISSET($_COOKIE['auto'])?(explode(';',$_COOKIE['auto'])[2]=='title'?true:false):false);
$love = (ISSET($_COOKIE['auto'])?(explode(';',$_COOKIE['auto'])[2]=='love'?true:false):false);
$angry = (ISSET($_COOKIE['auto'])?(explode(';',$_COOKIE['auto'])[2]=='angry'?true:false):false);
$happy = (ISSET($_COOKIE['auto'])?(explode(';',$_COOKIE['auto'])[2]=='happy'?true:false):false);
$cheapest = (ISSET($_COOKIE['auto'])?(explode(';',$_COOKIE['auto'])[2]=='cheapest'?true:false):false);
$latest = (ISSET($_COOKIE['auto'])?(explode(';',$_COOKIE['auto'])[2]=='latest'?true:false):false);
$best_selling = (ISSET($_COOKIE['auto'])?(explode(';',$_COOKIE['auto'])[2]=='best_selling'?true:false):false);
$discount = (ISSET($_COOKIE['auto'])?(explode(';',$_COOKIE['auto'])[2]=='discount'?true:false):false);
}

$order_by=' ';

if($love){
$order_by = 'love';
}else if($angry){
$order_by = 'angry';
}else if($happy){
$order_by = 'happy';
}else if($cheapest){
$order_by = 'cheapest';
}else if($latest){
$order_by = 'latest';
}else if($best_selling){
$order_by = 'best_selling';
}else if($discount){
$order_by = 'discount';
}else{
$title = true;
$order_by = 'title';
}

$company = (ISSET($_GET['company'])?$_GET['company']:(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[5]:''));
$company = (ISSET($_COOKIE['auto']) && ISSET($_GET['company'])?(explode(';',$_COOKIE['auto'])[5]==$company?'':$company):$company);

if(ISSET($_GET['category'])){
	$brand = '';
	$company = '';
}else if(ISSET($_GET['brand'])){
	$category = '';
	$company = '';
}else if(ISSET($_GET['company'])){
	$category = '';
	$brand = '';
}

$reverse_p_id = (
ISSET($_GET['brand']) || 
ISSET($_GET['category']) || 
ISSET($_GET['alph']) || 
ISSET($_GET['title']) ||
ISSET($_GET['love']) || 
ISSET($_GET['angry']) ||
ISSET($_GET['happy']) || 
ISSET($_GET['cheapest']) || 
ISSET($_GET['latest']) || 
ISSET($_GET['best_selling']) ||
ISSET($_GET['discount']) ||
ISSET($_GET['s']));

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


$product_id = (ISSET($_GET['product_id'])?$_GET['product_id']:($reverse_p_id?-1:(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[3]:-1)));

$s = ISSET($_GET["s"])?$_GET["s"]:(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[4]:0);

$begin = $s*40;

setcookie('auto',$category.';'.$alph.';'.$order_by.';'.$product_id.';'.$s.';'.$company.';'.$brand.';'.$category_type,time() + (86400 * 30 * 7),'/');
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Productlists Products</title>
<link rel=stylesheet href=https://productlists.co.za/bootstrap.min.css />
<link rel=stylesheet href=https://productlists.co.za/style.css />
<link rel=stylesheet href=https://productlists.co.za/mobstyle.css />
<link rel=stylesheet href=https://productlists.co.za/input_style.css />
<link rel=stylesheet href=https://productlists.co.za/scroll_style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/sign/style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/search/style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/feedback/style.css />

<link rel=stylesheet href=https://productlists.co.za/services/grocery/grocery_style.css />
<link rel=stylesheet href=https://productlists.co.za/services/sell/products/style.css />
<link rel=stylesheet href=https://productlists.co.za/services/sell/products/feature/feeling/style.css />

<link rel="shortcut icon" type="image/png" href="https://productlists.co.za/logo.png" />
<meta name="viewport" content="width=device-width" />
<meta name="description" content="Productlists" />
<meta name="keywords" content="productlists,product,sell,discount,cheap,latest,best selling,local,mzansi,south africa,pietermaritzburg,kzn,online shopping,technology,share files,music,documents,content,learn,education,information" />
<meta name="autor" content="Mongezi Mafunda" />
</head>
<body>
<script src=https://productlists.co.za/api.js ></script>
<script src=https://productlists.co.za/feature/search/api.js ></script>
<script src=https://productlists.co.za/feature/sign/api.js ></script>
<script src=https://productlists.co.za/services/sell/products/api.js ></script>
<script src=https://productlists.co.za/services/sell/products/feature/feeling/api.js ></script>
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
	<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/aggregation/lite/plug.php'); ?>
<div class=scroll_master >
<div id=container class=p_cont >
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/header_3.php'); ?>
<div class="body row" >
<div class="content col-sm-9" >
<a name=main ></a>
<div id="main" class=main style="padding-left:15px;" >
<?php 

echo ($category?'<h3 class=block >'.$category.'</h3>':'');

?>
<div class=category_type id=category_type >
<?php
if($category){

    $sql = 'SELECT DISTINCT category_type FROM product WHERE category='.$category;
    $result = $conn->query($sql);

    if($result){
    while($row = $result->fetch_assoc()){
    echo '<a href="products.php?category='.$category.'&category_type='.$row['category_type'].'" >'.$row['category_type'].'</a>';
	} 
    }
	
}
?>
</div>
<div class=products id=products >
<?php

$s_t;
{
	
$sql = 'SELECT COUNT(id) AS s_t FROM product'.
	' WHERE draft=0'.
($category?' AND category="'.$category.'"':'').
($category_type?' AND category_type="'.$category_type.'"':'').
($brand?' AND brand="'.$brand.'"':'').
($alph?' AND UPPER(SUBSTRING(title,1,1))="'.$alph.'"':'');


$result = $conn->query($sql);
	       if($result){
		   $row = $result->fetch_assoc();
		   $s_t = $row['s_t'];
		   }

$sql = 'SELECT p.id,p.company_id,p.title,p.price,p.brand,p.specification,p.parameters,p.measurement,p.quantity,p.discount,DATE_FORMAT(p.date_added,"%d-%m-%y  %h:%i %p") AS date_time FROM'.
' product p'.
' WHERE draft=0'.
($category?' AND category="'.$category.'"':'').
($category_type?' AND category_type="'.$category_type.'"':'').
($brand?' '.($category || $category_type?'':'WHERE').'AND brand="'.$brand.'"':'').
($alph?' '.($category || $category_type || $brand?'AND':'WHERE').' UPPER(SUBSTRING(title,1,1))="'.$alph.'"':'').
($love?' ORDER BY f.love DESC':($cheapest?' ORDER BY p.price ASC':($latest?' ORDER BY p.date_added DESC':($alph==''?' ORDER BY p.title ASC':($angry?' ORDER BY f.angry DESC':($happy?' ORDER BY f.happy DESC':($discount?' ORDER BY p.discount DESC':' ')))))));


}

echo '[sql]<textarea>'.$sql.'</textarea>';
	
$result = $conn->query($sql);

if($result){

$has_products = $row = $result->fetch_assoc();

$c_p = 0;

$end = $s*40+40;

$locked = false;
	
$body_rows = '';

while($row){
	 
	 if($c_p>=$begin && !$locked){
	 $locked=true;
	 }
	 
	 $extend = ($c_p>=$begin && $c_p<$end);
	 
	 $completed = false;
	 // && $c_p%4!=0
    if($extend){
	
	$body_rows.= '<div class=col-sm-3 style="padding:7px;" >'.(ISSET($_GET['s'])?(($_GET['s']*40)==$c_p?'<a name=current >':''):'');
	$sql2 = "SELECT url FROM product_image WHERE product_id=".$row["id"];
	$result2 = $conn->query($sql2);
	$row2 = $result2->fetch_assoc();
	
	
$sql3 = 'SELECT DISTINCT COUNT(t.product_id) AS rank FROM'.
' transaction t WHERE t.product_id='.$row['id'];
	$result3 = $conn->query($sql3);
	$row3 = $result3->fetch_assoc();
	
		    
    if(isset($_SESSION['company_id'])?$_SESSION['company_id']==$row['company_id']:false){
	$body_rows.=
	'<table class=company_options >'.
    '<td><a href="product_general.php?product_id='.$row['id'].'" >edit</a></td>'.
	'<td><a href=# onclick="deleteProduct('.$row['id'].');return false;" >delete</a></td>'.
	'</table>';
	}
		   
		  $body_rows.=
		   '<a class=title href="open.php?product_id='.$row['id'].'" title="'.$row['title'].'" >'.(strlen($row['title'])>14?substr($row['title'],0,14).'...':$row['title']).'</a>'.
		   '<table class=p_head >'.
		   '<tr>'.
		   '<td class=price title=price style="color:green;" >'.
		   'R'.$row['price'].
		   '</td>'.
		   '<td class=discount title=discount >'.($row['discount']?'-'.round($row['discount'],2).'%':'').'</td>'.
		   '<td class=sold title=sold >'.
		   ($row3['rank']?$row3['rank'].'<span class=caret ></span>':'').
		   '</td>'.
		   '</tr>'.
		   '</table>'.
		   '<a href="open.php?product_id='.$row['id'].'" ><img width="100%;" src="'.(strpos($row2["url"],'//')!==false?$row2["url"]:'product_images/'.$row2["url"]).'" /></a>';
		   
		   
		$result2 = $conn->query("SELECT logo,name,website FROM company WHERE id=".$row["company_id"]);
	       if($result2){
           $row2 = $result2->fetch_assoc();
		   $body_rows.=
		   '<table class=p_head width=100% >'.
		   '<tr>'.
		   '<td>'.
		   '<a class=company href="products.php?brand='.$row['brand'].'" >'.$row["brand"].'</a>'.
		   '</td>'.
		   '<td>'.($category=='grocery'?explode(';',$row['measurement'])[0].($row['title']=='Cooking Oil' || $row['title']=='Milk' || $row['title']=='Mass'?'lt':'kg'):'').'</td>'.
		   '<td>'.
		   '<span class=date ><a style="float:right;" class=fshare href="https://facebook.com/sharer.php?u=https://www.productlists.co.za/services/sell/products/products.php?product_id=
'.$row['id'].'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600,top=150, left=\'+((screen.width/2)-300));return false;" >Share</a></span>'.
		   '</td>'.
		   '</tr>'.
		   '</table>';
		   }
		  
		   
		   $body_rows.=
		   '</div>';
			
	    if($c_p%4==0 && $c_p!=0){
		 echo '<div class=row style="padding-bottom:4px;'.($c_p==0?'display:none;':'').'" >'.$body_rows.'</div>';
		 $body_rows='';
	     }
		   
		   
		   
		 $completed = $extend;
    }else{
	     if($completed){
		    break;
		 }
	}
	$row = $result->fetch_assoc();
	$c_p+=1;
	}
	

	echo (!$has_products?'<div class=block >Requested <strong>product</strong> is not found.<br><br></div>':'');
	
	 $service_item = 2;
	 include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/cover_face.php';
	
	}else{
	    
	    
echo '('.$sql.')---'.mysqli_error($conn);
	    
	}
?>

</div>
</div>
<?php	
	echo 
	'<div id=scroll ><div class=scroll >'.
	'<table class=menu ><tr>'.
	'<td class="begin alphabet" >';

	$count=0;
	$sql = 'SELECT DISTINCT LEFT(title,1) AS p FROM product WHERE category="'.$category.'"';
    $result = $conn->query($sql);
    if($result){
    while($row = $result->fetch_assoc()){
    echo '<a href="products.php?alph='.$row['p'].'" '.($alph==$row['p']?'class=highlight':'').'  >'.$row['p'].'</a>';
	
	if($count==13){
		echo '<br>';
	}else{
		$count+=1;
	}
    }
    }
	
	echo
    '</td>'.
	'<td class=begin ><a href="products.php?title=true" '.($title?'class="highlight a_z"':'class="a_z"').' >A-Z</a></td>'.
	'<td><div class=td_feeling >'.
	'<a class="love'.($love?'_highlight':'').'" href="products.php?love=true" ></a>'.
	'<a class="angry'.($angry?'_highlight':'').'" href="products.php?angry=true" ></a>'.
	'<a class="happy'.($happy?'_highlight':'').'" href="products.php?happy=true" ></a>'.
	'</div></td>'.
	'<td>'.
	'<a class=td_order href="products.php?best_selling=true" '.($best_selling?'class=highlight':'').'  >best selling</a>'.
	'<a href="products.php?cheapest=true" '.($cheapest?'class=highlight':'').'  >cheapest</a>'.
	'</td>'.
	'<td>'.
	'<a class=td_order href="products.php?discount=true" '.($discount?'class=highlight':'').'  >discount</a>'.
	'<a href="products.php?latest=true" '.($latest?'class=highlight':'').'  >latest</a>'.
	'</td>'.
	(isset($_SESSION['company_id'])?'<td class=begin ><a href="products.php?company='.$_SESSION['company_id'].'" '.($company!=''?'class=highlight':'').'  >company</a></td>':'').
	'</tr></table>'.
	'</div>';
	
	$hide_s = ($s*40>=$s_t);
  
	echo
	'<div class=nav >'.
    (!$hide_s?'<a class=more href="products.php?s='.($s+1).'#current" > load more </a>':'').
	'</div></div>';
?>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
<div id=left_pane_1 >
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four_affiliate.php'); ?>
</div>
<div id=right_pane_1 >
<?php 
include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/option/index.php';
?>
</div>
<div id=left_pane_2 style="display:none;" >
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/relationship.php'); ?>
</div>
</div>
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
