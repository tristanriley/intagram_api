<?php
//configuration for our PHP server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//makes constants using define
define('client_ID', 'c73d173254d884b89d8117954f97d9ee');
define('client_Secret', '971776cd8c4f4af7b7a6ff36f32b68b0');
define('redirectURI', 'c73d173254d884b89d8117954f97d9ee');
define('ImageDirectory', 'pics/');

if(isset($_Get))
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="">
	<title></title>
</head>
<body>
	<!-- create a login for people to go toInstagram API -->
	<!-- create a link to instagram using oauth/authorizing the account -->
	<!-- After setting client_id to blank in the beginning, along with redirect_uri then you have to echo it outfrom the constants.   -->
	<a href="https:api.instagram/oauth/authorize/?client_id=<?php echo client_ID; ?>&redirect_url=<? echo redirectURI; ?>&response_type=code">LOGIN</a>
	<script type="text/javascript"></script>
</body>
</html>