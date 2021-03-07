<div class=timeline id=timeline >
    <?php

$conn = new mysqli($HOST_,$USER_,$PASS_,$DATABASE_);
    $sql = 'SELECT id,title,price FROM product WHERE draft=0 ORDER BY date_added DESC';
    $result = $conn->query($sql);
 
    $target = '';
    
    $inject = '';
    
    $c = 1;
    
    if($result){
    while($row = $result->fetch_assoc()){	
        if($c<40){
              $sql = 'SELECT url FROM product_image WHERE product_id='.$row['id'];
    $result2 = $conn->query($sql);
    if($result2){
            if($row2 = $result2->fetch_assoc()){
            
            if($c%3==0){
   
    $sql = 'SELECT id,title,price FROM product WHERE draft=0 ORDER BY date_added DESC';
    $result3 = $conn->query($sql);
    
	if($result3){
        
        $cc = 1;
        
    while($row3 = $result3->fetch_assoc()){
		
           if($cc==$c/3){
              
				$sql = 'SELECT url FROM product_image WHERE product_id='.$row3['id'];
					$result4 = $conn->query($sql);
					if($result4){
					if($row4 = $result4->fetch_assoc()){
						
						 $inject.=
             '<a href="https://www.productlists.co.za/services/sell/products/open.php?product_id='.$row3['id'].'" >'.
             '<div class="block '.($c%4==0?'block_purple':'').' tml_p" >'.
             '<span class=highlight_green >R'.$row3['price'].'</span>'.
             '<img src="'.(strpos($row4['url'],'//')!==false?$row4['url']:'https://www.productlists.co.za/services/sell/products/product_images/'.$row4['url']).'" width=100% />'.
             '<span style="font-size:1em;" >'.$row3['title'].'</span>'.
             '</div>'.
             '</a>'.($c%2==0 ?'</div>'.($c%12==0?'</div><div class="row tml_row" >':'').'<div class="col-sm-6 row" >':'');
              
						
					}}
				
                $c+=1;
               break;
           }
           $cc+=1;
    }
    } 
            }
			
      //---------------------------------------------
	  
             $inject.=
             '<a href="https://www.productlists.co.za/services/sell/products/open.php?product_id='.$row['id'].'" >'.
             '<div class="block '.($c%4==0?'block_purple':'').' tml_p" >'.
             '<span class=highlight_green >R'.$row['price'].'</span>'.
             '<img src="'.(strpos($row2['url'],'//')!==false?$row2['url']:'https://www.productlists.co.za/services/sell/products/product_images/'.$row2['url']).'" width=100% />'.
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

   
    ?>
</div>
<style>
@media only screen and 
(max-width: 768px) {
.timeline {
padding-left:20px;
}
}
</style>
<div class=nav >
    <script>
        function appendTimeline(top){
            var res = sendreq('feature/timeline/index.php?top='+top);
            res.onload = function(){
              e('timeline').innerHTML+=res.responseText;
            };
        }
    </script>
    
<a class=more href="#" onclick="appendTimeline(e('timeline').getElementsByClassName('tml_p').length);return false;" > load more </a>
</div>
