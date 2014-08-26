<?php
    $clientid = "c997d8b3da2443f18cf1643d146bf4f6"; // get one at http://instagram.com/developer/clients/manage/
    $url = "https://api.instagram.com/v1/tags/weareimd/media/recent?client_id=".$clientid;
	
    /* CURL allows us to make requests to a web server using various protocols
		the following are popular options to set when making a request, here is a great guide to get started: http://codular.com/curl-with-php
		CURLOPT_RETURNTRANSFER  	return response as a string instead of printing it to screen
		CURLOPT_URL  				what URL to send the request to
		CURLOPT_POST  				send the request as a POST
		CURLOPT_POSTFIELDS			array of data to post 
		CURLOPT_SSL_VERIFYPEER		disable the SSL certificate check (not recommended)
	*/
	
    $request = curl_init(); 								// initialize a new CURL request
    curl_setopt($request, CURLOPT_URL, $url); 				// set the url to call
    curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);		// don't print, but return the result
    curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);	// don't check the SSL certificate (better to install it)
	if(! $instastash = curl_exec($request))					// execute the request
	{
		die('Error: "' . curl_error($request) . '" - Code: ' . curl_errno($request));
	}

	$instastash = json_decode($instastash);

	//echo "<pre>";
	//print_r($instastash);
	//echo "</pre>";

	curl_close($request);									// close the request
?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Interactive Multimedia Design - Thomas More Mechelen</title>
	<link rel="stylesheet" href="bower_components/normalize-css/normalize.css">
	<link href='http://fonts.googleapis.com/css?family=Vollkorn:400italic,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Voces' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css">
	<meta name="viewport" content="width=device-width">
</head>
<body>
	<header>
		<h1>Web. Design. Development.</h1>
		<p>Ga je <strong>verder studeren</strong> en ben je net als ons helemaal zot van pixels en programmeren?
		In de professionele bachelor-opleiding <a href="http://www.thomasmore.be/interactive-multimedia-design-imd">Interactive Multimedia Design</a> leer je de volledige mix tussen web design en development.
		</p>
		<p>Leer moderne webapplicaties, mobile apps en interactieve campagnes ontwerpen en ontwikkelen. #WeAreIMD, enkel in Mechelen bij <a href="http://www.thomasmore.be/interactive-multimedia-design-imd">Thomas More</a>
	

	<div class="facebook">
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=528896287219721";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div class="fb-like" data-href="http://www.facebook.com/weareimd" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
	</div>

	</header>

	<div id="thisIsImd">
	<h2>Zo ziet onze opleiding eruit</h2>

	<?php
		foreach ($instastash->data as $insta) {
			echo "<figure>";
			echo "<a href='".$insta->link."'>";
			echo "<img src='" . $insta->images->standard_resolution->url . "' alt='" . htmlspecialchars($insta->caption->text) . "' />";
			echo "</a>";
			echo "<figcaption>" . htmlspecialchars($insta->caption->text) . "</figcaption>";
			echo "</figure>";
		}	
	?>
	</div>
</body>
</html>