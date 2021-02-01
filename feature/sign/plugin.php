  <div class=space >
        <script>
         
         
    function plugin_new(name,email,image){
    var f = new FormData();
     f.append('name',name);
      f.append('email',email);
      f.append('p_p',image);
     f.append('date_added',getFormatedDate());
     
   var res = sendform('/feature/sign/plugin_new.php',f);
  res.onload = function(){
    document.location = 'https://www.productlists.co.za/'+location_before_sign;
        };
         }
         
         //--------------------google
         
    function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
    plugin_new(profile.getName(),profile.getEmail(),profile.getImageUrl());
    }
       
        //--------------------facebook
        
        function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    FB.api('/me', function(response) {
        plugin_new(response.name,response.email,response.data.url);
     
    });
  }
  
    (function(d, s, id) {                      // Load the SDK asynchronously
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

      
        
    </script>
    
    <div class="space row" style="padding-top:10px;padding-bottom:10px;">
        <div class=col-sm-6 >
            <div class="g-signin2" data-onsuccess="onSignIn"></div>
        </div>
        <div class=col-sm-6 >
            <div class="fb-login-button" data-width="" data-size="medium" data-button-type="login_with" data-auto-logout-link="false" data-use-continue-as="false"></div>
        </div>
        
    </div>
    
    </div>