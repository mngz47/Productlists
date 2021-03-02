<?php
$sql = 'SELECT refs FROM product WHERE id='.$product_id;
$result = $conn->query($sql);

if($result){
$row = $result->fetch_assoc();
$refs = explode('|',$row['refs']);
for($a=0;$a<count($refs)-1;$a++){
$p = explode('>',$refs[$a]);
echo '<a href="'.$p[1].'" target=blank ><div class=block >'.$p[0].'</div></a>';
}
}
?>
