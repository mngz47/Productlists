<?php
if(ISSET($_GET['top'])){

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');
    $sql = 'SELECT id,title,price FROM product ORDER BY date_added DESC';
    $result = $conn->query($sql);
 
    $target = '';
    
    $inject = '';
    
    $c = 1;
    
    if($result){
    while($row = $result->fetch_assoc()){	
        if($c>$_GET['top'] && $c<($_GET['top']+40)){
        $conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');
              $sql = 'SELECT url FROM product_image WHERE product_id='.$row['id'];
    $result2 = $conn->query($sql);
    if($result2){
            if($row2 = $result2->fetch_assoc()){
            
            if($c%3==0){
    $conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists_columns');
    $sql = 'SELECT id,title,cover_image FROM col ORDER BY date_added DESC';
    $result3 = $conn->query($sql);
    if($result3){
        
        $cc = 1;
        
    while($row3 = $result3->fetch_assoc()){
           if($cc==$c/3){
              
                
               $inject.=
              '<a href="https://'.$HOME_.'/services/build_your_brand/columns.php?product_id='.$row3['id'].'" >'.
             '<div class="block block_purple" style="min-height:200px;" >'.
             '<img src="https:/'.$HOME_.'/services/build_your_brand/images/'.$row3['cover_image'].'" width=100% />'.
             '<span style="font-size:1em;" >'.$row3['title'].'</span>'.
             '</div>'.
             '</a>'.($c%2==0 ?'</div>'.($c%12==0?'</div><div class="row tml_row" >':'').'<div class="col-sm-6 row" >':'');
                
                $c+=1;
               break;
           }
           $cc+=1;
    }
    } 
            }
        
             $inject.=
             '<a href="https://'.$HOME_.'/services/sell/products/products.php?product_id='.$row['id'].'" >'.
             '<div class="block '.($c%4==0?'block_purple':'').' tml_p" >'.
             '<span class=highlight_green >R'.$row['price'].'</span>'.
             '<img src="'.(strpos($row2['url'],'//')>-1?$row2['url']:'https://'.$HOME_.'/services/sell/products/product_images/'.$row2['url']).'" width=100% />'.
             '<span style="font-size:1em;" >'.$row['title'].'</span>'.
             '</div>'.
             '</a>';
             
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
