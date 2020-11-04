<?php
session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$LOCATION = 'services/sell/products/product_parameters.php';

if(!ISSET($_SESSION['company_id'])){
header('Location:/services/sell/company_general.php');
	
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Productlists | Product Parameters</title>
<link rel=stylesheet href=https://productlists.co.za/bootstrap.min.css />
<link rel=stylesheet href=https://productlists.co.za/style.css />
<link rel=stylesheet href=https://productlists.co.za/mobstyle.css />
<link rel=stylesheet href=https://productlists.co.za/input_style.css />
<link rel=stylesheet href=https://productlists.co.za/services/sell/products/input_style.css />
<link rel=stylesheet href=https://productlists.co.za/verification_style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/sign/style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/search/style.css />

<link rel="shortcut icon" type="image/png" href="https://productlists.co.za/logo.png" />
<meta name="viewport" content="width=device-width" />
<meta name="description" content="" />
<meta name="keywords" content="productlists,product,sell,discount,cheap,latest,best selling,local,mzansi,south africa,pietermaritzburg,kzn,online shopping,technology,share files,music,documents,content,learn,education,information" />
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
<script src=https://productlists.co.za/api.js ></script>
<script src=https://productlists.co.za/verification.js ></script>
<script src=https://productlists.co.za/feature/search/api.js ></script>
<script src=https://productlists.co.za/feature/sign/api.js ></script>
<script src=https://productlists.co.za/services/sell/products/product_image_input_api.js ></script>
<script src=https://productlists.co.za/services/sell/products/product_general_api.js ></script>
<script src=https://productlists.co.za/services/sell/products/feature/option/api.js ></script>
<div class=scroll_master >
<div id=container class=p_cont >

	<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/header_3.php'; ?>
	
<div class="body row" >
<div class="col-sm-3" >
<div id=left_pane class="left_pane" >
<div id=left_pane_1 >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four.php'; ?>
</div>
<div id=left_pane_3 >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four_control.php'; ?>
</div>
	
<div id=left_pane_2 style="display:none;" >
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/relationship.php'; ?>
</div>
</div>
</div>
<div class="content col-sm-6" >
<a name=main ></a>
<div id="main" class=main >
<script>

var product_id = <?php echo ISSET($_GET["product_id"])?$_GET["product_id"]:'-1'; ?>;

</script>
<?php
$row = '';

if(ISSET($_GET['product_id'])){

$sql = 'SELECT id,title,quantity,price,brand,gender,health_table,parameters,refs,specification,category,category_type FROM product WHERE id='.$_GET['product_id'];
$result = $conn->query($sql);
if($result){
$row = $result->fetch_assoc();
}
}
?>
<a href=https://www.productlists.co.za/services/sell/products/products.php?product_id=<?php echo $_GET['product_id']; ?> >View Product</a>
<form id=input method=post action="<?php echo (!$row?'new_product.php':'') ?>" enctype="multipart/form-data" onsubmit=setDate("date_added"); >
<div id=new_product class="input" >
<div class="row" >
<div class="col-sm-5" >
<div id=images class=images >

<span>Image Url</span>
<textarea id=url type=text onblur=importImage(this.value); placeholder="https://www.productlists.co.za/my_image.png" ></textarea>
<a href=# onclick="addImage();return false;" >add image</a>
<?php
if($row){
$sql = 'SELECT id,url FROM product_image WHERE product_id='.$_GET['product_id'];
$result = $conn->query($sql);
if($result){
while($row2 = $result->fetch_assoc()){
echo '<div><a href=# class=close onclick="deleteProductImage(this,\''.$row2['id'].'\');return false;" >X</a><img src="'.(strpos($row2['url'],'http')!==false?$row2['url']:'product_images/'.$row2['url']).'" /></div>';
}
}
}
?>

</div>
</div>
<div id=slides class="col-sm-7" >
<div class="slide" >
<h4>Parameters</h4>
<div>

<span>Parameters</span>
<a href=# onclick="addParameter();return false;" >add parameter</a>
<div id=params class=params >
<?php
if($row){
echo '<script> var parameters = "'.$row['parameters'].'"; </script>';
	
$params = explode('/',$row['parameters']);
		   for($a=0;$a<count($params)-1;$a++){
		   echo 
		   '<div class=param >'.
		   '<a href=# class=close onclick="removeParameter('.$row['id'].',parameters,\''.$params[$a].'\',this.parentNode);return false;" >x</a>'.
		   '<span>'.explode('>',$params[$a])[0].'</span>';
		   echo 
		   '<select>';
		    $param_values = explode(';',explode('>',$params[$a])[1]);
		  
		   for($aa=0;$aa<(count($param_values)-1);$aa++){
		   echo '<option>'.$param_values[$aa].'</option>';
		   }
		   
		   echo 
		   '</select>'.
		   '</div>';
		   } 
}
?>
</div>
<span>References</span>
<a href=# onclick="addReference();return false;" >add reference</a>
<div id=refs class=refs >
<?php
if($row){
echo '<script> var refs = "'.$row['refs'].'"; </script>';

$refs = explode('|',$row['refs']);

		   for($a=0;$a<count($refs)-1;$a++){
		  
		   echo '<div class=ref >'.
		        '<a href=# class=close onclick="removeRef('.$row['id'].',\''.$row['refs'].'\',\''.$refs[$a].'\',this.parentNode);return false;" >x</a>'.
				'<span>'.explode('>',$refs[$a])[0].'</span>'.
		        explode('>',$refs[$a])[1].
		        '</div>';
		   }
}
?>
</div>
<span>Specification</span>
<textarea name=specification onfocus="v_open(this,2000);" onkeydown="return (len(this,null)?true:false);" onblur=<?php echo ($row?'editfield_3("services/sell/products/update_product_2.php","'.$row['id'].'","specification","\""+this.value+"\"",specification_v(this));':'specification_v(this);'); ?> ><?php echo ($row?$row['specification']:''); ?></textarea>
<script> var options = [
<?php 
    $sql = 'SELECT DISTINCT category FROM product';
    $result = $conn->query($sql);
    $options = '';
    if($result){
    while($row2 = $result->fetch_assoc()){
     $options.='"'.$row2['category'].'",';
	}	
	echo substr($options,0,strlen($options)-1);
    }
?>
]; </script>
<span>Category</span>
<input type=text name=category  onfocus="v_open(this,50);" onkeyup=auto_correct(options,"Category",this); onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row?$row['category']:''); ?>" onblur=<?php echo ($row?'editfield_2("services/sell/products/update_product.php","'.$row['id'].'","category","\""+this.value+"\"",auto_correct(options,"category",this));':'auto_correct(options,"category",this);'); ?> autocomplete=false />
<script> var sub_category = [
<?php 
    $sql = 'SELECT DISTINCT category_type FROM product';
    $result = $conn->query($sql);
    $options = '';
    if($result){
    while($row2 = $result->fetch_assoc()){
     $options.=($row2['category_type']?'"'.$row['category_type'].'",':'');
	}	
	echo substr($options,0,strlen($options)-1);
    }
?>
]; </script>
<span>Sub Category</span>
<input type=text name=category_type onfocus="v_open(this,50);" onkeyup="auto_correct(sub_category,'Sub Category',this);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row?$row['category_type']:''); ?>" placeholder="optional" onblur='<?php echo ($row?'editfield_2("services/sell/products/update_product.php","'.$row['id'].'","category_type","\""+this.value+"\"",auto_correct(sub_category,"Sub Category",this));':'auto_correct(sub_category,"Sub Category",this);'); ?>' autocomplete=false />

</div>
</div>

<div id=error_msg class=verification >
</div>

</div>
</div>
<div class=nav >
<?php
echo
(ISSET($_GET['product_id'])?
'<a class="btn btn-primary next" href="product_shipping.php?product_id='.$_GET['product_id'].'" >shipping</a>':
'<button class="btn btn-primary next" type=submit >save</button>');
?>
</div>
</div>
</form>
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
</div>
</body>
</html>
<?php
$conn->close();
?>
