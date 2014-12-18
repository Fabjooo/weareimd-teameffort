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
	
	$ignore_users = array('tomylin_sk', 'live_free_tally');

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

	<div class="partners">
		<h2 class="center">Onze partners, waar jij na je studies misschien ook wel gaat werken.</h2>

		<figure class="logo">
			<a href="http://www.district01.be" title="District01">
				<img src="img/partners/district01.png" alt="District01">
			</a>
		</figure>

		<figure class="logo">
			<a href="http://appstrakt.com" title="Appstrakt">
				<img src="img/partners/appstrakt.png" alt="Appstrakt">
			</a>
		</figure>

		<figure class="logo">
			<a href="http://www.intracto.com/" title="Intracto">
				<img src="img/partners/intracto.png" alt="Intracto">
			</a>
		</figure>

		<figure class="logo">
			<a href="http://www.prophets.be" title="Prophets">
				<img src="img/partners/prophets.png" alt="Prophets">
			</a>
		</figure>

		<figure class="logo">
			<a href="http://www.thomasmore.be" title="Thomas More">
				<img src="img/partners/thomasmore.png" alt="Thomas More">
			</a>
		</figure>

		<figure class="logo">
			<a href="http://www.wieni.be" title="Wieni">
				<img src="img/partners/wieni.png" alt="Wieni">
			</a>
		</figure>

		<figure class="logo">
			<a href="http://telenetidealabs.be" title="Telenet Idealabs">
				<img src="img/partners/idealabs.png" alt="Telenet Idealabs">
			</a>
		</figure>

		<figure class="logo">
			<a href="http://innovation.vrt.be" title="VRT">
				<img src="img/partners/vrt.png" alt="VRT">
			</a>
		</figure>

		<figure class="logo">
			<a href="http://www.nascom.be" title="Nascom">
				<img src="img/partners/nascom.png" alt="Nascom">
			</a>
		</figure>

		<figure class="logo">
			<a href="http://www.wijs.be" title="Wijs">
				<img src="img/partners/wijs.png" alt="Wijs">
			</a>
		</figure>

		<figure class="logo">
			<a href="http://www.thesedays.be" title="Thesedays Y&R">
				<img src="img/partners/thesedays.png" alt="Thesedays Y&R">
			</a>
		</figure>

		<figure class="logo">
			<a href="http://www.iminds.be" title="iMinds">
				<img src="img/partners/iminds.png" alt="iMinds">
			</a>
		</figure>

		<br class="clearfix"/>		

	</div>

	<div class="thisIsImd">
		<h2 class="center">Hoe onze opleiding eruit ziet? Zo.</h2>

		<?php


			foreach ($instastash->data as $insta) {
				if(!in_array($insta->user->username, $ignore_users))
				{
					echo "<figure>";
					echo "<a href='".$insta->link."'>";
					echo "<img src='" . $insta->images->standard_resolution->url . "' alt='" . htmlspecialchars($insta->caption->text) . "' />";
					echo "</a>";
					echo "<figcaption>" . htmlspecialchars($insta->caption->text) . "</figcaption>";
					echo "</figure>";
				}
			}	
		?>
	</div>
</body>
</html>