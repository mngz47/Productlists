<?php

session_start();

$HOST_ = 'd6rii63wp64rsfb5.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';//localhost
$USER_ = 'muce70z5ukkwpv5d';//produc10_mng
$PASS_ = 'bqvn5jp04wlmxu64';//mngzpass636
$DATABASE_ = 'zyo1oodysira7ro5';//produc10_productlists
 
$conn = new mysqli($HOST_,$USER_,$PASS_,$DATABASE_);

$HOME_ = 'product--lists.heroku.com';
//$HOME_ = 'www.productlists.co.za';

?>
