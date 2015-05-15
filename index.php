<!DOCTYPE html>
<html>
	<head>
	<header id="header">
			<h1 class="head">Pics of da Fam</h1>
		</header>
			<link rel="stylesheet" type="text/css" href="css/main.css"> 
			<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
			<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
			<meta name="viewport" content="width=device-width">
			<meta name="viewport" content="width=320">
			<meta charset="UTF-8">
		<title>tristansRus</title>
		<!--<meta rel="author" href="humans.txt"> -->
	</head>
	<body>
		
	<?php 
	//Configuration for PHP server
	set_time_limit(0);
	ini_set('default_socket_timeout', 300);
	//starts session
	session_start();
	//Make Constants using define
	define('clientID', '1f275f40a7a0486f81287f75fd6b2e29');
	define('clientSecret', '61ce055ea2f34d3b963e4325afbe4f70');
	define('redirectURI', 'http://localhost/app_api/index.php');
	define('ImageDirectory', 'pics/');
	//connects to instagram
	function connectToInstagram($url){
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => 2,
		));
		$result = curl_exec($ch);
		//closes curl handler
		curl_close($ch);
		return $result;
	}
	//gets user id
	function getUserID($userName){
		$url = 'https://api.instagram.com/v1/users/search?q=' . $userName . '&client_id=' . clientID;
		$instagramInfo = connectToInstagram($url);
		$results = json_decode($instagramInfo, true);
		return $results['data'][0]['id'];
	}
	//prints images onto screen
	function printImages($userID){
		$url = 'https://api.instagram.com/v1/users/' . $userID . '/media/recent?client_id=' . clientID . '&count=6';
		$instagramInfo = connectToInstagram($url);
		$results = json_decode($instagramInfo, true);
		//parse through the info
		foreach ($results['data'] as $items) {
			//gives url for each picture in results
			$image_url = $items['images']['low_resolution']['url'];
			echo '<img src="' . $image_url . '" class="pic-style"><br>';
			//saves $img_url
			savePictures($image_url);
		}
	}
	function savePictures($image_url){
		return $image_url . '<br>';
		//echo $image_url . '<br>';
		//using php to store the emage uro in the variable $filename
		$filename = basename($image_url);
		//echo $filename . '<br>';
		//makes sure that the image isnt stored in the server
		$destination = ImageDirectory . $filename;
		//stores image file into server
		file_put_contents($destination, file_get_contents($image_url));
	}
	if (isset($_GET['code'])) {
		$code = $_GET['code'];
		$url = 'https://api.instagram.com/oauth/access_token';
		$access_token_settings = array('client_id' => clientID,
									   	'client_secret' => clientSecret,
										'grant_type' => 'authorization_code',
										'redirect_uri' => redirectURI, 
										'code' => $code);
		//cURL is a library that calls to other API's
		//setting curl session and insert $url
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, true);
		//sets the POSTFIELDS to the array
		curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings);
		//sets equal to 1
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		//verifies that the curl is really there
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		//stores above information
		$result = curl_exec($curl);
		curl_close($curl);
		//decodes information in $result
		$results = json_decode($result, true);
		$userName = $results['user']['username'];
		//echoes the decoded information 
		$userID = getUserID($userName);
		printImages($userID);
	}
	else{
	
?>



		
		<!-- Creating a login for people to go and give approval for our web app to access their Instagram Account
			 After getting aprroval we are now going to have the information so that we can play with it.
		 -->
		<div class="login"><a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code">Login</a></div>
		<!-- <script src="js/main.js"></script> -->
	</body>
</html>

<?php
}
?>