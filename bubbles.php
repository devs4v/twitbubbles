<?php
	require_once('TwitterAPIExchange.php');
	/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	$settings = array(
	'oauth_access_token' => "w5UiN3rFGvj3kq62pD66LvBQtgoNea2XzVIxUtI2GerV8",
	'oauth_access_token_secret' => "43135464-otST3o88CTCTTZXtAsV9WPCzdUufsbsElHeEsL9Tm",
	'consumer_key' => "2OnxwQrJikLZI7YCx1FIHqhTU",
	'consumer_secret' => "jRv9QS7GEDCMojFlwsbMrCVs5gQ8IviV8ViYK86J2evMjMag6u"
	);
	$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
	$requestMethod = "GET";
	if (isset($_GET['user']))  {$user = $_GET['user'];}  else {$user  = "iagdotme";}
	if (isset($_GET['count'])) {$user = $_GET['count'];} else {$count = 20;}
	$getfield = "?screen_name=$user&count=$count";
	$twitter = new TwitterAPIExchange($settings);
	$twitter->setGetfield($getfield);
	$twitter->buildOauth($url, $requestMethod);
	$string = json_decode($twitter->performRequest(),$assoc = TRUE);
	if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}
	foreach($string as $items)
	    {
	        echo "Time and Date of Tweet: ".$items['created_at']."<br />";
	        echo "Tweet: ". $items['text']."<br />";
	        echo "Tweeted by: ". $items['user']['name']."<br />";
	        echo "Screen name: ". $items['user']['screen_name']."<br />";
	        echo "Followers: ". $items['user']['followers_count']."<br />";
	        echo "Friends: ". $items['user']['friends_count']."<br />";
	        echo "Listed: ". $items['user']['listed_count']."<br /><hr />";
	    }
?>