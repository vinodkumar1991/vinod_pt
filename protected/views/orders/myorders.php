<script>
  // Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '965036556905750', // App ID
      channelUrl : '//192.168.1.127/test/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional init code here
 
  };

  function login() {
    FB.login(function(response) {
      if (response.authResponse) {
        testAPI() ;
      } else {
        // cancelled
      }
    });
  }

	 function doLogin(){
	  alert("sfas");
    FB.getLoginStatus(function(response) {
      if (response.status === 'connected') {
    login();
      } else if (response.status === 'not_authorized') {
        // not_authorized
        login();
      } else {
        // not_logged_in
       login();
      }
    });
  }
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me',{fields: 'gender, first_name, last_name, email,name'}, function(response) {
      console.log(response);
	     $.post('<?php echo  $this->createUrl('Orders/fblogin');?>',{
											regemail:response.email,										
											uname:response.name,
											id:response.id
						  
						   
						   
										},
				 
										function(data)
										{
											
											if(data==1)
											{
												
											//window.location="<?php echo  $this->createUrl('mPSVEHICLES_DETAILS/AddVehicle');?>";
											}   
										}); 
	  
    });
  }

  // Load the SDK Asynchronously
  (function(d){
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {return;}
      js = d.createElement('script'); js.id = id; js.async = true;
      js.src = "//connect.facebook.net/en_US/all.js";
      ref.parentNode.insertBefore(js, ref);
  }(document));
</script>
<a href = "#" onClick = "doLogin()">Login</a>