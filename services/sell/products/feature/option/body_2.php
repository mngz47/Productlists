<?php

    $sql = 'SELECT DISTINCT category FROM product';
    $result2 = $conn->query($sql);

    if($result2){
   
    while(($row2 = $result2->fetch_assoc())){
	    
	 $five_brands = 0;
	    
		echo ('<a href="products.php?category='.$row2['category'].'" ><h2>'.$row2['category'].'</h2></a>');
		echo '<div class=row style="overflow-x:auto;" >';
	    
	if($result3=($conn->query("SELECT id,title FROM product WHERE category='".$row2['category']."' ORDER BY date_added DESC"))){
		while($row3 = $result3->fetch_assoc()){
		if($five_brands<10){
				
			if($result4=($conn->query('SELECT url FROM product_image WHERE product_id='.$row3['id']))){
		    	if($row4 = $result4->fetch_assoc()){
				 
			echo 
			 '<a class="col-sm-2" style="background-position:0 20;background-repeat:no-repeat;background-size:100%;background-image:url('.(strpos($row4['url'],'//')!==false?$row4['url']:'https://www.productlists.co.za/services/sell/products/product_images/'.str_replace (' ','%20',$row4['url'])).');display:block;height:150px;margin:3px;" '.
			 ' href="open.php?product_id='.$row3['id'].'" ><span class=tint >'.$row3['title'].
			 '</span></a>';
			}
	        	}	
		}
			$five_brands+=1;
		}
	}
    	
	    echo '</div>';
    } 
    }
?>
