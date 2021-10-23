<?php
if(ISSET($_GET['top'])){

include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/config.php';
 
    
    $sql = 'SELECT id,title,price FROM product WHERE draft=0 ORDER BY date_added DESC';
    $result = $conn->query($sql);
 
    $target = '';
    
    $inject = '';
    
    $c = 1;
    
    if($result){
    while($row = $result->fetch_assoc()){
	    
        if($c>$_GET['top'] && $c<($_GET['top']+40)){
     
    $sql = 'SELECT url FROM product_image WHERE product_id='.$row['id'];
    $result2 = $conn->query($sql);
    if($result2){
            if($row2 = $result2->fetch_assoc()){
            
       
             $inject.=
             '<a href="open.php?product_id='.$row['id'].'" >'.
             '<div class="block '.($c%4==0?'block_purple':'').' tml_p" >'.
             '<span class=highlight_green >R'.$row['price'].'</span>'.
             '<img src="'.(strpos($row2['url'],'//')!==false?$row2['url']:'https://'.$HOME_.'/services/sell/products/product_images/'.$row2['url']).'" width=100% />'.
             '<span style="font-size:1em;" >'.$row['title'].'</span>'.
             '</div>'.
             '</a>';
			 
			 if($row = $result->fetch_assoc()){
				 $sql = 'SELECT url FROM product_image WHERE product_id='.$row['id'];
    $result2 = $conn->query($sql);
    if($result2){
	if($row2 = $result2->fetch_assoc()){
		
		$inject.=
             '<a href="open.php?product_id='.$row['id'].'" >'.
             '<div class="block '.($c%4==0?'block_purple':'').' tml_p" >'.
             '<span class=highlight_green >R'.$row['price'].'</span>'.
             '<img src="'.(strpos($row2['url'],'//')!==false?$row2['url']:'https://'.$HOME_.'/services/sell/products/product_images/'.$row2['url']).'" width=100% />'.
             '<span style="font-size:1em;" >'.$row['title'].'</span>'.
             '</div>'.
             '</a>'.($c%2==0 ?'</div>'.($c%12==0?'</div><div class="row tml_row" >':'').'<div class="col-sm-6 row" >':'');
		
	}} 
			}
             
       if($c%2==0){
                 $target .= 
                 '<div class="col-sm-6 row" >'.
                 $inject.
                 '</div>';
                 $inject='';
             }
             
             if($c%4==0){
                 $target = 
                 '<div class="row tml_row" >'.
                 $target.
                 '</div>';
                echo
                $target;
                $target='';
             }
            }
    }else{
        echo
        'error: '.
        mysqli_error($conn);
    }
        }     
            
       $c+=1; 
    }
    }else{
        echo
        'error: '.
        mysqli_error($conn);
    }
}
?>
