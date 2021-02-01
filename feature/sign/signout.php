<?php
session_start();

if(ISSET($_SESSION['company_id'])){
$_SESSION['company_id'] = null;	
}else{
$_SESSION['customer_id'] = null;	
}

if(!ISSET($_SESSION['sign_plugin'])){
header('Location:/'.(ISSET($_SESSION['location_before_sign'])?$_SESSION['location_before_sign']:'index.php'));
}else{
    $_SESSION['sign_plugin'] = null;
}

?>
<html>
  <head>
    <title>Sign Out</title>
 <meta name="google-signin-client_id" content="644981683202-gq3ogqsu0g8i9kb2uj7setjcl9nal28c.apps.googleusercontent.com">
   
</head>
<body>
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v5.0&appId=838292889616021&autoLogAppEvents=1"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<a href="https://www.productlists.co.za/index.php" >Home Page</a>
<script>
  
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      alert('Successfully Signed Out');
    });
    
    
    FB.logout(function(response) {
   
   });
   
</script>
</body>
</html>