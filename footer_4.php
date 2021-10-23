<div class=row style="padding-bottom:20px;padding-left:20px;rgba(0,0,0,0.2);
box-shadow: -1px -1px 7px 0px rgba(0,0,0,0.2);" >
<div class="col-sm-2" >
<h3>Company</h3>
<ul style="list-style:none;" >
    <li><a href=https://<?php echo $HOME_; ?>/feature/support.php >Support</a></li>
    <li><a href=https://<?php echo $HOME_; ?>/about.php >About</a></li>
    <li><a href=https://agg-lite.herokuapp.com >Automatic</a></li>
    <li><a href=https://<?php echo $HOME_; ?>/invest.php >Invest</a></li>
  </ul>
</div>
<div class="col-sm-3" >
<h3>Customer Service</h3>
  <ul style="list-style:none;" >
    <li><a href=https://<?php echo $HOME_; ?>/customer_service/faq.php >FAQ</a></li>
    <li><a href=https://<?php echo $HOME_; ?>/customer_service/privacy_policy.php >Privacy Policy</a></li>
    <li><a href=https://<?php echo $HOME_; ?>/customer_service/terms_conditions.php >Terms & Conditions</a></li>
    <li><a href=https://<?php echo $HOME_; ?>/customer_service/shipping_returns.php >Shipping & Returns</a></li>
  </ul>
</div>
<div class="col-sm-2" >
<h3>Suppliers</h3>
  <ul style="list-style:none;" >
    <li><a href=https://<?php echo $HOME_; ?>/services/sell/index.php >Add Company</a></li>
    <li><a href=https://<?php echo $HOME_; ?>/services/sell/products/product_general.php >Sell Product</a></li>
    <li><a href=https://<?php echo $HOME_; ?>/services/sell/company_transactions.php >Transactions</a></li>
    <li><a href=https://<?php echo $HOME_; ?>/advertise.php >Advertise</a></li> 
  </ul>
</div>
<div class="col-sm-2" >
<h3>Members</h3>
<ul style="list-style:none;" >
    <li><a href=https://<?php echo $HOME_; ?>/member/signup_main.php >Account</a></li>
    <li><a href=https://<?php echo $HOME_; ?>/feature/shopping_cart/index.php >Shopping Cart</a></li>
    <li><a href=https://<?php echo $HOME_; ?>/member/customer_transaction.php >Transactions</a></li>
    <li><a href=https://productlists-services.herokuapp.com >Services</a></li>
  </ul>
</div>
<div class="col-sm-3" >
<h3>Newsletter</h3>
<form action="https://<?php echo $HOME_; ?>/feature/feedback/index.php" method=post onsubmit=setDate('date_added_n'); id=newsletter >
<a href=https://www.instagram.com/productlists ><img src=https://mngz47.github.io/productlists-resources/instagram.jpg width=20px /></a>
<a href=https://www.facebook.com/productlists.co.za ><img src=https://mngz47.github.io/productlists-resources/facebook.png width=20px /></a>
    <input name=email type=text class=form-control placeholder=email style="margin-bottom:10px;width:70%;display:inline-block;" onblur="newsletter_auto_send(this);" />
<script>
    function newsletter_auto_send(input){
        if(input.value){
            e('newsletter').submit();
        }
    }
</script>
    
    <input name=date_added_n type=text id=date_added class=invisible />
    <input name=text value="Newsletter" placeholder=message class=invisible />
</form>
    <div>
  <a href= "mailto:admin@productlists.co.za">admin@productlists.co.za</a><br>
  <a href= "tel:+2771 947 1009">+2771 947 1009</a><br>
        <span id=c_year ></span> © Productlists
        <script>
            e('c_year').innerHTML=(new Date().getFullYear());
        </script>
    </div>
</div>
</div>
