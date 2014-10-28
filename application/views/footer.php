        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script>
            // Define base url
            localStorage.setItem('base_url', '<?php echo $base_url ?>');

            // This is called with the results from from FB.getLoginStatus().
            function statusChangeCallback(response) {

                // The response object is returned with a status field that lets the
                // app know the current login status of the person.
                // Full docs on the response object can be found in the documentation
                // for FB.getLoginStatus().
                if (response.status === 'connected') {
                    // Logged into your app and Facebook.
                    getUserData(response.authResponse.userID, response.authResponse.accessToken);
                } else if (response.status === 'not_authorized') {
                    // The person is logged into Facebook, but not your app.
                    document.getElementById('status').innerHTML = 'Please log ' +
                    'into this app.';
                } else {
                    // The person is not logged into Facebook, so we're not sure if
                    // they are logged into this app or not.
                    document.getElementById('status').innerHTML = 'Please log ' +
                    'into Facebook.';
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
                    appId      : '293592524173381',
                    cookie     : true,  // enable cookies to allow the server to access 
                                    // the session
                    xfbml      : true,  // parse social plugins on this page
                    version    : 'v2.1' // use version 2.1
                });

                // Now that we've initialized the JavaScript SDK, we call 
                // FB.getLoginStatus().  This function gets the state of the
                // person visiting this page and can return one of three states to
                // the callback you provide.  They can be:
                //
                // 1. Logged into your app ('connected')
                // 2. Logged into Facebook, but not your app ('not_authorized')
                // 3. Not logged into Facebook and can't tell if they are logged into
                //    your app or not.
                //
                // These three cases are handled in the callback function.

                FB.getLoginStatus(function(response) {
                    statusChangeCallback(response);
                });

            };

            // Load the SDK asynchronously
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            // Here we run a very simple test of the Graph API after login is
            // successful.  See statusChangeCallback() for when this call is made.
            function testAPI() {
                console.log('Welcome!  Fetching your information.... ');
                FB.api('/me', function(response) {
                  console.log('Successful login for: ' + response.name);
                    document.getElementById('status').innerHTML =
                    'Thanks for logging in, ' + response.name + '!';
                });
            }

            /**
             * Get facebook user data using Graph API
             * @param {string} fb_user_id 
             * @param {string} access_token 
             */
            function getUserData(fb_user_id, access_token) {
                var fb_user_data = {};
                FB.api(fb_user_id, function(response) {
                    if(response.id){
                        fb_user_data['id'] = response.id;
                        fb_user_data['first_name'] = response.first_name;
                        fb_user_data['last_name'] = response.last_name;
                        fb_user_data['email'] = response.email;
                        fb_user_data['gender'] = response.gender;
                        fb_user_data['access_token'] = access_token;

                        addFacebookUser(fb_user_data);
                    }
                });
            }// getUserData

            /**
             * Add Facebook user to database using AJAX
             * @param {array} data 
             */
            function addFacebookUser(user_data){
                var url = localStorage.getItem('base_url') + 'index.php/iteration_1_test/save_fb_user';
 
                $.post(
                    url,
                    user_data,
                    function(response){
                        console.log(response);
                    }// response
                );
            }// addFacebookUser

        </script>

    </body>
</html>