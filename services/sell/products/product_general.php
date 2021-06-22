<?php

include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/config.php');

$LOCATION = 'services/sell/products/product_general.php';

if(!ISSET($_SESSION['company_id'])){
header('Location:/services/sell/company_general.php');
	
}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Productlists | Product General</title>
	
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/p_styles.php'); ?>
	
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
	
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/p_scripts.php'); ?>
	
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

$sql = 'SELECT id,title,quantity,price,brand,gender,health_table,parameters,refs,specification,category,category_type,bulk,draft FROM product WHERE id='.$_GET['product_id'];
$result = $conn->query($sql);
if($result){
$row = $result->fetch_assoc();
}
}
?>

<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/services/sell/products/csv/face.php"; ?>

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
<h4>General</h4>
<div>
<span>Title</span>
<input type=text name=title onfocus="v_open(this,200);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row?$row['title']:(ISSET($_SESSION['product_general_cache'])?explode(';',$_SESSION['product_general_cache'])[0]:'')); ?>" onblur=<?php echo ($row?'editfield_2("services/sell/products/update_product.php","'.$row['id'].'","title","\""+this.value+"\"",general_field(this));':'general_field(this);'); ?>  />
<span>Price</span>
<input type=text name=price onfocus="v_open(this,10);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row?$row['price']:(ISSET($_SESSION['product_general_cache'])?explode(';',$_SESSION['product_general_cache'])[1]:'')); ?>" onblur=<?php echo ($row?'editfield_2("services/sell/products/update_product.php","'.$row['id'].'","price","\""+this.value+"\"",digit_field(this));':'digit_field(this);'); ?> />
<span>Quantity</span>
<input type=number name=quantity onfocus="v_open(this,10);" onkeydown="return (len(this,null)?true:false);" value="<?php echo ($row?$row['quantity']:(ISSET($_SESSION['product_general_cache'])?explode(';',$_SESSION['product_general_cache'])[2]:'')); ?>" onblur=<?php echo ($row?'editfield_2("services/sell/products/update_product.php","'.$row['id'].'","quantity","\""+this.value+"\"",digit_field(this));':'digit_field(this);'); ?> />
<script> var brands = [
<?php 
    $sql = 'SELECT DISTINCT brand FROM product;';
    $result = $conn->query($sql);
    $options = '';
    if($result){
    while($row2 = $result->fetch_assoc()){
     $options.='"'.$row2['brand'].'",';
	}	
	echo substr($options,0,strlen($options)-1);
    }
?>
]; </script>
<span>Brand</span>
<input type=text name=brand onfocus="v_open(this,50);" onkeydown="return (len(this,null)?true:false);" onkeyup=auto_correct(brands,"Brand",this); value="<?php echo ($row?$row['brand']:(ISSET($_SESSION['product_general_cache'])?explode(';',$_SESSION['product_general_cache'])[3]:'')); ?>" onblur=<?php echo ($row?'editfield_2("services/sell/products/update_product.php","'.$row['id'].'","brand","\""+this.value+"\"",auto_correct(brands,"Brand",this));':'auto_correct(brands,"Brand",this);'); ?>  autocomplete=false />
<span>Gender</span>
<select name=gender <?php echo ($row?'onchange=editfield("services/sell/products/update_product.php","'.$row['id'].'","gender","\""+this.value+"\"");':''); ?> >
<option value="-1" >optional</option>
<option value="1" <?php echo ($row && $row['gender']===1?'selected':(ISSET($_SESSION['product_general_cache'])?(explode(';',$_SESSION['product_general_cache'])[4]=='1'?'selected':''):'')); ?> >male</option>
<option value="2" <?php echo ($row && $row['gender']===2?'selected':(ISSET($_SESSION['product_general_cache'])?(explode(';',$_SESSION['product_general_cache'])[4]=='2'?'selected':''):'')); ?> >female</option>
</select>
<span>Grocery Health Table</span>
<select name=health_table <?php echo ($row?'onchange=editfield("services/sell/products/update_product.php","'.$row['id'].'","health_table","\""+this.value+"\"");':''); ?> >
<option value="-1" >optional</option>
<option value="1" <?php echo ($row && $row['health_table']==1?'selected':(ISSET($_SESSION['product_general_cache'])?(explode(';',$_SESSION['product_general_cache'])[5]=='1'?'selected':''):'')); ?> >bread, cereals, potatoes</option>
<option value="2" <?php echo ($row && $row['health_table']==2?'selected':(ISSET($_SESSION['product_general_cache'])?(explode(';',$_SESSION['product_general_cache'])[5]=='2'?'selected':''):'')); ?> >fruit, Vegetables</option>
<option value="3" <?php echo ($row && $row['health_table']==3?'selected':(ISSET($_SESSION['product_general_cache'])?(explode(';',$_SESSION['product_general_cache'])[5]=='3'?'selected':''):'')); ?> >milk, cheese, dairy</option>
<option value="4" <?php echo ($row && $row['health_table']==4?'selected':(ISSET($_SESSION['product_general_cache'])?(explode(';',$_SESSION['product_general_cache'])[5]=='4'?'selected':''):'')); ?> >meat, fish, alternatives</option>
<option value="5" <?php echo ($row && $row['health_table']==5?'selected':(ISSET($_SESSION['product_general_cache'])?(explode(';',$_SESSION['product_general_cache'])[5]=='5'?'selected':''):'')); ?> >fats, oils, sweets</option>
</select>

<span><input name=bulk type=checkbox <?php echo ($row?'onchange=editfield("services/sell/products/update_product.php","'.$row['id'].'","bulk",'.($row['bulk']?'0':'1').');':''); ?>  <?php echo ($row['bulk']?'checked':''); ?> />Bulk</span>
<span><input name=draft type=checkbox <?php echo ($row?'onchange=editfield("services/sell/products/update_product.php","'.$row['id'].'","draft",'.($row['draft']?'0':'1').');':''); ?>  <?php echo ($row['draft']?'checked':''); ?> />Draft</span>
	
<input id=date_added type=text name=date_added hidden=true />	
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
'<a class="btn btn-primary next" href="product_parameters.php?product_id='.$_GET['product_id'].'" >parameters</a>':
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
