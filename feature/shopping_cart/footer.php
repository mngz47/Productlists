<div class="group_4" id=affiliate >
<div class="row" >
<div class="column_footer_half sharp_two" ><strong>Select Payment Method</strong></div>
<div class="column_footer_half sharp_two" ><strong>Select Delivery Method</strong></div>
</div>
<div class="row" >
<div class="column_footer_half block sharp_two payment" id=balance selected=false onclick=<?php echo (ISSET($_SESSION['customer_id'])?'select(1,this);':(ISSET($_COOKIE['has_account'])?'signInFocus();':'document.location="https://www.productlists.co.za/member/signup_main.php";')); ?> >
<p>Use My Balance</p>
<?php
if(ISSET($_SESSION['customer_id'])){
	$sql = 'SELECT balance FROM customer WHERE id='.$_SESSION['customer_id'];
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	
	if($total_cost>$row['balance']){
	echo 'You have insufficient funds you will be redirected to balance update feature upon checkout.';
	}
	echo '<h3 class="'.($total_cost>$row['balance']?'highlight':'highlight_green').'" >R'.$row['balance'].'</h3>';
	
}else{
	if(ISSET($_COOKIE['has_account'])){
		echo '<p class=big >Sign In</p>';
	}else{
		echo '<p class=big >Sign Up</p>';
	}
}
?>
<strong>Recommended</strong>
</div>
<div class="column_footer_half block sharp_two delivery" id=post_office selected=false onclick=select(0,this); ><p class=big >Post Office</p><strong>Recommended</strong></div>
</div>
<div class="row" >
<div class="col-sm-5 block sharp_two payment" id=paypal selected=false onclick=select(1,this); ><p class=big >PayPal</p></div>
<div class="col-sm-5 block sharp_two delivery" id=courier_it selected=false onclick=select(0,this); ><p class=big >Courier It</p></div>
</div>
<div class="row" >
<div class="column_footer_half block sharp_two payment" id=cc selected=false onclick=select(1,this); ><p class=big >Credit Card</p></div>
<div class="column_footer_half block sharp_two delivery" id=fed_ex selected=false onclick=select(0,this); ><p class=big >Fed Ex</p></div>
</div>


</div>
<div class="row shopping_cart" >
   
<a href="#" onclick="transport_handle(this);return false;" class="btn btn-primary btn_cont" >check out</a>

</div>

<script>
<?php
if(ISSET($_COOKIE['active_checkout_payment'])){
	echo 'select(1,e("'.$_COOKIE['active_checkout_payment'].'"));'.
	     'select(0,e("'.$_COOKIE['active_checkout_delivery'].'"));';
}
?>
</script>
