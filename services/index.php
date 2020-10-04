<?php

function video($url){
     return '<iframe width=150px onload="this.style.height=Math.round(this.style.width*220/400);" onresize="this.style.height=Math.round(this.style.width*220/400);" src="'.$url.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}

function image($url){
    return '<img width=150px; src="'.$url.'" />';
}

function isLocal($url){
    return (strpos($url,'http')<0);
}

session_start();

$LOCATION = 'services/index.php';

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Productlists Services</title>
<link rel=stylesheet href=https://productlists.co.za/bootstrap.min.css />
<link rel=stylesheet href=https://productlists.co.za/style.css />
<link rel=stylesheet href=https://productlists.co.za/mobstyle.css />
<link rel=stylesheet href=https://productlists.co.za/feature/sign/style.css />
<link rel=stylesheet href=https://productlists.co.za/feature/search/style.css />
<link rel=stylesheet href=https://www.productlists.co.za/scroll_style.css />


<link rel=stylesheet href=https://listro.co.za/style.css />

<link rel="shortcut icon" type="image/png" href="logo.png" />
<meta name="viewport" content="width=device-width" />
<meta name="description" content="Technology Firm - working towards solutions to free the youth. PRODUCTLISTS" />
<meta name="keywords" content="productlists,product,sell,discount,cheap,latest,best selling,local,mzansi,south africa,pietermaritzburg,kzn,online shopping,technology,share files,music,documents,content,learn,education,information" />
<meta name="autor" content="Mongezi Mafunda" />
</head>
<body>
<script>
<?php 

echo (ISSET($_GET['result'])?($_GET['result']?"alert('success');":"alert('failure');"):""); 

if(ISSET($_SESSION['response'])){
	echo 'alert("'.$_SESSION['response'].'");';
	$_SESSION['response'] = null;
}

?>
</script>
<script src=https://productlists.co.za/api.js ></script>
<script src=https://productlists.co.za/feature/search/api.js ></script>
<script src=https://productlists.co.za/feature/sign/api.js ></script>
<script src=https://productlists.co.za/services/sell/products/feature/option/api.js ></script>

<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/header_2.php'); ?>

<div class=p_cont >

<div class="body row" >
<div class="col-sm-3" >
<div id=left_pane class="left_pane" >
<div id=left_pane_1 >
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/services/sell/products/feature/group_four.php'); ?>
</div>
<div id=left_pane_2 style="display:none;" >
<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/relationship.php'); ?>
</div>
</div>
</div>
<div class="content col-sm-6" >
<a name=main ></a>
<div id="main" class=main >
    
    
    
  <?php
    $conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_services');
  
    $index = (ISSET($_GET['more'])?$_GET['more']:0);
    
    $sql = 'SELECT id,title,description FROM item ORDER BY date_added DESC';
    
    $result = $conn->query($sql);
    
    if($result){
        
        $c = 0;
        $min = $index*10;
        $max = $index*10+10;
        
    while(($row = $result->fetch_assoc()) && ($c>=$min && $c<$max)){
       
    echo
    '<div class="report space" style="margin-top:7px;" >'.
     '<div class="header" >'.
    '<table><tr><td>';
    
    
    $sql = 'SELECT id,media_type,url FROM item_media WHERE cover=1 AND item_id='.$row['id'];
    $result2 = $conn->query($sql);
    if($result2){
    if($row2 = $result2->fetch_assoc()){
        
        echo ($row2['media_type']==1?image( ( isLocal($row2['url'])?'https://www.productlists.co.za/services/image/images/'.$row2['url']:$row2['url']  )):video($row2['url']));
        
    }}

    echo
    '</td><td><a href=open.php?item_id='.$row['id'].' >'.
    '<strong style="font-size:1.2em;" class=space >'.$row['title'].'</strong></a>'.
    '<small>'.(strlen($row['description'])>20?substr($row['description'],0,20):$row['description']).'</small></td></tr></table>'.
    
    '</div>'.
    '</div>';
        $c+=1;
    }
    
    }
    
?>
<div class=nav >
<a class=more href="index.php?more=<?php echo ($index+1); ?>"  > load more </a>
</div>
<div class=block ><a href=list.php >new service</a></div>  
    
</div>
</div>
<div class="col-sm-3" >
<div id=right_pane class="right_pane" >
<div id=right_pane_6 >
<?php
if(!$in_product){
 include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT'])."/services/build_your_brand/feature/sharp_two.php"; 
}
 ?>
</div>

</div>
</div>
</div>


</div>

<?php
 include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/footer_3.php'); 
 ?>
</body>
</html>
<?php
$conn->close();
?>
