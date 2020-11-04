<?php
session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$LOCATION = 'services/sell/products/product_shipping.php';

if(!ISSET($_SESSION['company_id'])){
header('Location:/services/sell/company_general.php');
	
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Productlists | Product Shipping</title>
<link rel=stylesheet href=https://productlists.co.za/bootstrap.min.css />
<link rel=stylesheet href=https://productlists.co.za/style.css />
<link rel=stylesheet href=https://productlists.co.za/mobstyle.css />
<link rel=stylesheet href=https://productlists.co.za/input_style.css />
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
<script src=https://productlists.co.za/api.js ></script>
<script src=https://productlists.co.za/verification.js ></script>
<script src=https://productlists.co.za/feature/search/api.js ></script>
<script src=https://productlists.co.za/feature/sign/api.js ></script>
<script src=https://productlists.co.za/services/sell/products/product_image_input_api.js ></script>
<script src=https://productlists.co.za/services/sell/products/product_shipping_api.js ></script>
<script src=https://productlists.co.za/services/sell/products/feature/option/api.js ></script>

<div class=scroll_master >
<div id=container class=container >

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

$sql = 'SELECT id,measurement,shipment_cost,category FROM product WHERE id='.$_GET['product_id'];
$result = $conn->query($sql);
if($result){
$row = $result->fetch_assoc();
}
}else{
	header('Location:/services/sell/products/index.php');
}
?>
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
<h4>Shipping</h4>
<div>
<div id=measurement >
<span>Weight</span>
<input type=text onfocus="v_open(this,3);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row['measurement']?explode(';',$row['measurement'])[0]:''); ?>" placeholder="kg" onblur=editfield_2("services/sell/products/update_product.php","<?php echo $row['id'] ?>","measurement",'"'+collect_measurement()+'"',check_measurement()); />
<span>Width</span>
<input type=number onfocus="v_open(this,3);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row['measurement']?explode(';',$row['measurement'])[1]:''); ?>" placeholder="cm" onblur=editfield_2("services/sell/products/update_product.php","<?php echo $row['id'] ?>","measurement",'"'+collect_measurement()+'"',check_measurement()); />
<span>Length</span>
<input type=number onfocus="v_open(this,3);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row['measurement']?explode(';',$row['measurement'])[2]:''); ?>" placeholder="cm" onblur=editfield_2("services/sell/products/update_product.php","<?php echo $row['id'] ?>","measurement",'"'+collect_measurement()+'"',check_measurement()); />
<span>Height</span>
<input type=number onfocus="v_open(this,3);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row['measurement']?explode(';',$row['measurement'])[3]:''); ?>" placeholder="cm" onblur=editfield_2("services/sell/products/update_product.php","<?php echo $row['id'] ?>","measurement",'"'+collect_measurement()+'"',check_measurement()); />
</div>
<span>Flat Shipment Cost</span>
<input type=number onfocus="v_open(this,4);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row['shipment_cost']?$row['shipment_cost']:''); ?>" placeholder="optional" onblur=editfield_2("services/sell/products/update_product.php","<?php echo $row['id'] ?>","shipment_cost","\""+this.value+"\"",digit_field(this)); />
</div>
</div>
<div id=error_msg class=verification >
</div>

</div>
</div>
<div class=nav >
<a class="btn btn-primary back" href="product_general.php?product_id=<?php echo $_GET['product_id']; ?>"  >general</a>
<?php
if($row['category']=='grocery'){
echo '<a class="btn btn-primary back" href="product_supplier.php?product_id='.$_GET['product_id'].'"  >supplier</a>';
}else{
echo '<a class="btn btn-primary next" href=product_general.php >new product</a>';	
}
?>
</div>
</div>

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
