<?php

require 'vendor/autoload.php';


session_start();
$fb = new Facebook\Facebook([
  'app_id' => '1214799411888113',
  'app_secret' => '286f08b36691768f859a70e788f4ceda',
  'default_graph_version' => 'v2.5',
]);

if ($_SESSION['fb_id']) {
  $logoutUrl = $fb->getLogoutUrl();
} 

$url1 = 'phpstack-21306-56790-161818.cloudwaysapps.com';
$helper = $fb->getRedirectLoginHelper();
$token = $helper->getAccessToken();
$url = 'https://www.facebook.com/logout.php?next=' .$url1.'&access_token='.$token;
session_destroy();
header('Location: index.php');



// session_start();
// session_destroy();
// unset($_SESSION['login_user']);  
// header("Location: login.php");
// //    session_start();
// //    session_destroy();
// //    session_unset();
// //    if(session_destroy()) {
// //       header("Location: index.php");
// //    }
?>