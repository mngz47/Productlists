<?php

include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/config.php');

function httpGet($url){
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
));
return curl_exec($curl);
curl_close($curl);
}


echo httpGet('https://'.$HOME_.'/services/sell/products/feature/group_four.php?forward='.$_GET['index']);

?>
