<?php

function isRepeat($v1,$v2,$v3,$v4){
    
    if(ISSET($_SESSION['GF_slide_end1'])){
         if($_SESSION['GF_slide_end1']==$v1 && 
    $_SESSION['GF_slide_end2']==$v2 && 
    $_SESSION['GF_slide_end3']==$v3 && 
    $_SESSION['GF_slide_end4']==$v4){
        $index = 0;
    }}
    
    {
$_SESSION['GF_slide_end1'] = $v1;
$_SESSION['GF_slide_end2'] = $v2;
$_SESSION['GF_slide_end3'] = $v3;
$_SESSION['GF_slide_end4'] = $v4;
    }
}


$index;

if(ISSET($_SESSION['GF_index'])){

$index = $_SESSION['GF_index'];

}else if(ISSET($_GET['forward'])){

$index = $_GET['forward'];

}


$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$gf_best_selling = '';
$gf_latest = '';
$gf_cheapest = '';
$gf_discount = '';

$length_1;

$sql = 'SELECT DISTINCT COUNT(p.id) AS length,COUNT(t.product_id) AS rank FROM product p INNER JOIN transaction t ON p.id=t.product_id'.
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[0]?' WHERE category="'.explode(';',$_COOKIE['auto'])[0].'"':'':'').
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[1]?' '.(explode(';',$_COOKIE['auto'])[0]?' AND':' WHERE').' UPPER(SUBSTRING(title,1,1))="'.explode(';',$_COOKIE['auto'])[1].'"':'':'').
' ORDER BY rank DESC';
$result = $conn->query($sql);

if($result){
$row = $result->fetch_assoc();
if($row['rank']>0){
$length_1 = $row['length'];
}else{
$length_1 = 0;    
}
}

//product_id represents no of transactions linked to product

$sql = 'SELECT DISTINCT p.id,COUNT(p.id) AS length,p.title,p.price,COUNT(t.product_id) AS rank FROM product p INNER JOIN transaction t ON p.id=t.product_id'.
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[0]?' WHERE category="'.explode(';',$_COOKIE['auto'])[0].'"':'':'').
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[1]?' '.(explode(';',$_COOKIE['auto'])[0]?' AND':' WHERE').' UPPER(SUBSTRING(title,1,1))="'.explode(';',$_COOKIE['auto'])[1].'"':'':'').
' ORDER BY rank DESC';
$result = $conn->query($sql);

if($result){
	$count = 0;
	$out = false;
while($row = $result->fetch_assoc()){
if($index<$length_1){
if($row['id'] && $count==$index){
	$out = true;
}
}else if($count==($length_1-1)){
	$out = true;
}
if($out){
	$sql = 'SELECT url FROM product_image WHERE product_id='.$row['id'];
	$result = $conn->query($sql);
	$row2 = $result->fetch_assoc();
	$gf_best_selling = ($row['rank']>0?'<a href="https://www.productlists.co.za/services/sell/products/open.php?product_id='.$row['id'].'"  style="background-image:url('.(strpos($row2['url'],'//')!==false?$row2['url']:'https://www.productlists.co.za/services/sell/products/product_images/'.$row2['url']).');" ><div class=tint >'.(strlen($row['title'])>8?substr($row['title'],0,8).'...':$row['title']).'</div></a><span class=price >R'.$row['price'].'</span>':'');

	break;
}
$count+=1;
}

}
		
//-------------------------------------------------------------------------------------------------
		
$length_2;

$sql = 'SELECT COUNT(p.id) AS length FROM'.
' product p'.
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[0]?' WHERE category="'.explode(';',$_COOKIE['auto'])[0].'"':'':'').
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[1]?' '.(explode(';',$_COOKIE['auto'])[0]?' AND':' WHERE').' UPPER(SUBSTRING(title,1,1))="'.explode(';',$_COOKIE['auto'])[1].'"':'':'').
' ORDER BY date_added DESC';
$result = $conn->query($sql);
if($result){
$row = $result->fetch_assoc();
$length_2 = $row['length'];
}		
		
$sql = 'SELECT p.id,p.title,p.price FROM'.
' product p'.
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[0]?' WHERE category="'.explode(';',$_COOKIE['auto'])[0].'"':'':'').
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[1]?' '.(explode(';',$_COOKIE['auto'])[0]?' AND':' WHERE').' UPPER(SUBSTRING(title,1,1))="'.explode(';',$_COOKIE['auto'])[1].'"':'':'').
' ORDER BY date_added DESC';
$result = $conn->query($sql);

if($result){
$count = 0;
$out = false;	
while($row = $result->fetch_assoc()){

if($index<$length_2){
if($count==$index){
	$out = true;
}
}else if($count==($length_2-1)){
	$out = true;
}
if($out){
	$sql = 'SELECT url FROM product_image WHERE product_id='.$row['id'];
	$result = $conn->query($sql);
	$row2 = $result->fetch_assoc();
	$gf_latest = '<a href="https://www.productlists.co.za/services/sell/products/open.php?product_id='.$row['id'].'"  style="background-image:url('.(strpos($row2['url'],'//')!==false?$row2['url']:'https://www.productlists.co.za/services/sell/products/product_images/'.$row2['url']).');" ><div class=tint >'.(strlen($row['title'])>8?substr($row['title'],0,8).'...':$row['title']).'</div></a><span class=price >R'.$row['price'].'</span>';

	break;
}
$count+=1;

}
}
	
//-------------------------------------------------------------------------------------------------	
	
$length_3;	
	
$sql = 'SELECT COUNT(p.id) AS length FROM'.
' product p'.
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[0]?' WHERE category="'.explode(';',$_COOKIE['auto'])[0].'"':'':'').
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[1]?' '.(explode(';',$_COOKIE['auto'])[0]?' AND':' WHERE').' UPPER(SUBSTRING(title,1,1))="'.explode(';',$_COOKIE['auto'])[1].'"':'':'').
' ORDER BY price ASC';
$result = $conn->query($sql);
if($result){
$row = $result->fetch_assoc();
$length_3 = $row['length'];
}	
	
	
$sql = 'SELECT p.id,p.title,p.price FROM'.
' product p'.
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[0]?' WHERE category="'.explode(';',$_COOKIE['auto'])[0].'"':'':'').
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[1]?' '.(explode(';',$_COOKIE['auto'])[0]?' AND':' WHERE').' UPPER(SUBSTRING(title,1,1))="'.explode(';',$_COOKIE['auto'])[1].'"':'':'').
' ORDER BY price ASC';
$result = $conn->query($sql);

if($result){
$count = 0;
$out = false;	
	while($row = $result->fetch_assoc()){
		
if($index<$length_3){
if($count==$index){
	$out = true;
}
}else if($count==($length_3-1)){
	$out = true;
}
if($out){
	$sql = 'SELECT url FROM product_image WHERE product_id='.$row['id'];
	$result = $conn->query($sql);
	$row2 = $result->fetch_assoc();
	$gf_cheapest = '<a href="https://www.productlists.co.za/services/sell/products/open.php?product_id='.$row['id'].'"  style="background-image:url('.(strpos($row2['url'],'//')!==false?$row2['url']:'https://www.productlists.co.za/services/sell/products/product_images/'.$row2['url']).');" ><div class=tint >'.(strlen($row['title'])>8?substr($row['title'],0,8).'...':$row['title']).'</div></a><span class=price >R'.$row['price'].'</span>';

	break;
}
$count+=1;

	}
}

//--------------------------------------------------------------------------------------------------	
	
$length_4;	
	
$sql = 'SELECT COUNT(p.id) AS length FROM'.
' product p'.
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[0]?' WHERE category="'.explode(';',$_COOKIE['auto'])[0].'"':'':'').
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[1]?' '.(explode(';',$_COOKIE['auto'])[0]?' AND':' WHERE').' UPPER(SUBSTRING(title,1,1))="'.explode(';',$_COOKIE['auto'])[1].'"':'':'').
' ORDER BY discount DESC';
$result = $conn->query($sql);

if($result){
$row = $result->fetch_assoc();
$length_4 = $row['length'];
}	
	
$sql = 'SELECT p.id,p.title,p.price FROM'.
' product p'.
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[0]?' WHERE category="'.explode(';',$_COOKIE['auto'])[0].'"':'':'').
(ISSET($_COOKIE['auto'])?explode(';',$_COOKIE['auto'])[1]?' '.(explode(';',$_COOKIE['auto'])[0]?' AND':' WHERE').' UPPER(SUBSTRING(title,1,1))="'.explode(';',$_COOKIE['auto'])[1].'"':'':'').
' ORDER BY discount DESC';
$result = $conn->query($sql);

if($result){
$count = 0;
$out = false;		
	while($row = $result->fetch_assoc()){
	
if($index<$length_4){
if($count==$index){
	$out = true;
}
}else if($count==($length_4-1)){
	$out = true;
}
if($out){
	$sql = 'SELECT url FROM product_image WHERE product_id='.$row['id'];
	$result = $conn->query($sql);
	$row2 = $result->fetch_assoc();
	$gf_discount = '<a href="https://www.productlists.co.za/services/sell/products/open.php?product_id='.$row['id'].'"  style="background-image:url('.(strpos($row2['url'],'//')!==false?$row2['url']:'https://www.productlists.co.za/services/sell/products/product_images/'.$row2['url']).');" ><div class=tint >'.(strlen($row['title'])>8?substr($row['title'],0,8).'...':$row['title']).'</div></a><span class=price >R'.$row['price'].'</span>';

	break;
}
$count+=1;

	}
}
	
	$l_length = 0;
	
	if($length_1>=$l_length){
		$l_length = $length_1;
	}if($length_2>=$l_length){
		$l_length = $length_2;
	}if($length_3>=$l_length){
		$l_length = $length_3;
	}if($length_4>=$l_length){
		$l_length = $length_4;
	}
	
	if($index<$l_length){
		
	}else{
		setcookie('group_four_index',0,time() + (86400 * 365),'/');
	}
	
//--------------------------------------------------------------------------------------------------	
            
            isRepeat($gf_discount,$gf_cheapest,$gf_cheapest,"");

echo
'<div class="group_4" ><div class="row" >'.
'<div class="col-sm-5 block sharp_two" >'.$gf_discount.'discount</div>'.
'<div class="col-sm-5 block sharp_two" >'.$gf_cheapest.'cheapest</div>'.
'</div>'.
'<div class="row" >'.
'<div class="col-sm-5 block sharp_two" >'.$gf_cheapest.'latest</div>'.
($gf_best_selling?'<div class="col-sm-5 block sharp_two" >'.$gf_best_selling.'best selling</div>':'').
'</div></div>';

?>
<script>
    
function sendreq_22(url,target){
var req = new XMLHttpRequest();

document.domain = window.location.hostname;

var full_path = "https://"+window.location.hostname+"/"+url;

req.open("GET",full_path,true);

target.className+=' loader';
req.send();
req.onload = function(){
target.className = target.className.replace(' loader','');
target.innerHTML = req.responseText;
};
}

function in_forward(url,type){
    sendreq_22(url,e(type));
}
    
</script>


<div class=forward >
    <a href=# id=four_forward onclick="in_forward('group_four_engine.php?index=<?php
     
     echo ($index+1);
   
     $_SESSION['GF_index'] = ($index+1);
    
    ?>','left_pane_1');return false;" class=block >  </a>
    <script>
    setInterval(function(){e('four_forward').click();},14000);
    </script>
</div>
