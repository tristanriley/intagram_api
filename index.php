
<?php 
	//Configuration for PHP server
	set_time_limit(0);
	ini_set('default_socket_timeout', 300);
	//starts session
	session_start();
	//Make Constants using define
	define('client_ID', 'c73d173254d884b89d8117954f97d9ee');
	define('client_Secret', '971776cd8c4f4af7b7a6ff36f32b68b0');
	define('redirectURI', 'http://localhost/Instagram_api/index.php');
	define('ImageDirectory', 'pics/');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="viewport" content="width098, intitial-scale = 1">
		<title>InstApi</title>
		<meta rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<!-- Creating a login for people to go and give approval for our web app to access their Instagram Account
			 After getting aprroval we are now going to have the information so that we can play with it.
		 -->
		<a href="https:api.instagram.com/oauth/authorize/?client_id = <?php echo clientID; ?> & redirect_uri = <?php echo redirectURI; ?> & response_type=code">LOGIN</a>
		<script src="js/main.js"></script>
	</body>
</html>