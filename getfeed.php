<?php 
require 'vendor/autoload.php';


session_start();
$fb = new Facebook\Facebook([
  'app_id' => '1214799411888113',
  'app_secret' => '286f08b36691768f859a70e788f4ceda',
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional
	
try {
	if (isset($_SESSION['facebook_access_token'])) {
		$accessToken = $_SESSION['facebook_access_token'];
	} else {
  		$accessToken = $helper->getAccessToken();
	}
} catch(Facebook\Exceptions\FacebookResponseException $e) {	
	 // When Graph returns an error
 	echo 'Graph returned an error: ' . $e->getMessage();
  	exit;

} catch(Facebook\Exceptions\FacebookSDKException $e) {
 	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
  	exit;
 }

if (isset($accessToken)) {
	if (isset($_SESSION['facebook_access_token'])) {
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	} else {
		// getting short-lived access token
		$_SESSION['facebook_access_token'] = (string) $accessToken;

	  	// OAuth 2.0 client handler
		$oAuth2Client = $fb->getOAuth2Client();

		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);

		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

		// setting default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}

	// redirect the user to the profile page if it has "code" GET variable
	// if (isset($_GET['code'])) {
	// 	header('Location: profile.php');
	// }

	// getting basic info about user


	$linkData = [
  'link' => 'http://www.cloudways.com',
  'message' => 'User provided message',
  ];
	try {
		$profile_request = $fb->api('/me/feed', 'POST', $linkData);
		// $response = $profile_request->execute();
//         $graphObject = $profile_request->getGraphEdge();
// echo "<pre>";
// 		print_r($graphObject);
// 		echo "</pre>";
		

		
// 		exit();
		
	
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		// redirecting user back to app login page
		header("Location: ./");
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
}
	
// } else {
// 	// replace your website URL same as added in the developers.facebook.com/apps e.g. if you used http instead of https and you used non-www version or www version of your website then you must add the same here
// 	$loginUrl = $helper->getLoginUrl('http://phpstack-21306-56790-161818.cloudwaysapps.com', $permissions);
// 	echo '<a href="' . $loginUrl . '"><img src="fb-button.png"></img></a>';
// }


 ?>


//   <?php 
// require 'vendor/autoload.php';

// $appID = '1214799411888113';
// $appSecret = '286f08b36691768f859a70e788f4ceda';
 
// //Create an access token using the APP ID and APP Secret.
// $accessToken = $appID . '|' . $appSecret;
 
// //The ID of the Facebook page in question.
// $id = '1783123478577419';
 
// //Tie it all together to construct the URL
// $url = "https://graph.facebook.com/$id/posts?access_token=$accessToken";
 
// //Make the API call
// $result = file_get_contents($url);
 
// //Decode the JSON result.
// $decoded = json_decode($result, true);
 
// //Dump it out onto the page so that we can take a look at the structure of the data.
// var_dump($decoded);
// ?>