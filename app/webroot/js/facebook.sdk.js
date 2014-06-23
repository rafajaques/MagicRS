// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
  //console.log('statusChangeCallback');
  //console.log(response);
  if (response.status === 'connected') {
    // Logged into your app and Facebook.
    //saveToken();
	console.log('Facebook OK');
  } else {
  	console.log('Facebook problem');
  }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}

window.fbAsyncInit = function() {
FB.init({
  appId      : '236270466582899',
  cookie     : true,  // enable cookies to allow the server to access the session
  xfbml      : true,  // parse social plugins on this page
  version    : 'v2.0' // use version 2.0
});

FB.getLoginStatus(function(response) {
  statusChangeCallback(response);
});

};

// Load the SDK asynchronously
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function saveToken() {
  FB.api('/me', function(response) {
    console.log('Login com sucesso de: ' + response.name);
  });
}