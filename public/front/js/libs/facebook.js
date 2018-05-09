
var language_code = "en_US";

window.fbAsyncInit = function() {
    FB.init({
      appId      : '399832397024935',
      xfbml      : true,
      version    : 'v2.8'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/"+language_code+"/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));