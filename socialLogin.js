// Initialize the Facebook SDK
window.fbAsyncInit = function() {
  FB.init({
    appId      : 'YOUR_FACEBOOK_APP_ID',
    cookie     : true,
    xfbml      : true,
    version    : 'v10.0'
  });
  FB.AppEvents.logPageView();   
};

// Load the Facebook SDK asynchronously
(function(d, s, id){
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "https://connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Google Sign-In
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId());
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail());
  // Send the ID token to your server
  var id_token = googleUser.getAuthResponse().id_token;
  console.log('ID Token: ' + id_token);
}

// Facebook Login
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}

function statusChangeCallback(response) {
  if (response.status === 'connected') {
    FB.api('/me', {fields: 'name,email'}, function(response) {
      console.log('Successful login for: ' + response.name);
      console.log('Email: ' + response.email);
      // Send the access token to your server
      var accessToken = FB.getAuthResponse().accessToken;
      console.log('Access Token: ' + accessToken);
    });
  } else {
    console.log('User not authenticated');
  }
}

// Attach event listeners to the buttons
document.getElementById('googleSignUp').addEventListener('click', function() {
  gapi.auth2.getAuthInstance().signIn().then(onSignIn);
});

document.getElementById('googleLogin').addEventListener('click', function() {
  gapi.auth2.getAuthInstance().signIn().then(onSignIn);
});

document.getElementById('facebookSignUp').addEventListener('click', function() {
  FB.login(checkLoginState, {scope: 'public_profile,email'});
});

document.getElementById('facebookLogin').addEventListener('click', function() {
  FB.login(checkLoginState, {scope: 'public_profile,email'});
});
