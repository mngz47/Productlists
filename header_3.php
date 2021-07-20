<div id=header class="header row" style="rgba(0,0,0,0.2);
box-shadow: -1px -1px 7px 0px rgba(0,0,0,0.2);" >
<div class="col-sm-3" >
<div>
<a href=https://<?php echo $HOME_; ?>/index.php class="logo logo_start" ></a>
<a href=https://<?php echo $HOME_; ?>/index.php class="title logo" >Productlists</a>
<a href="#" onclick="toggleUpperScroll();return false;" class="toggleUpperScroll highlight" ></a>
<a href="#" onclick="toggleSignIn();return false;" class="toggleSignIn highlight" ></a>
</div>
</div>
<div class="col-sm-6" >
    
<div class="upper_scroll row" >
    <div class=col-sm-6 >
       <input style="width:100%;height:30px;border:0px;padding:4px;" onfocus=s_in(); onblur=s_out(this); type=search onkeyup="search(this.value);" class=" shadow" id=search placeholder="search" />   
    </div>
  <div class=col-sm-6 style="padding-top:25px;font-size:1.2em;">
<a class=space href=https://<?php echo $HOME_; ?>/products.php >All Products</a>
  </div>
</div>

<?php include (str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/sign/signin_body.php'); ?>

</div>
<div id=header_right class="col-sm-3">
<?php include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/feature/sign/signin_pane.php'; ?>
</div>
</div>
