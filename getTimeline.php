<?php


require_once __DIR__ . '/TwitterOAuth/TwitterOAuth.php';
require_once __DIR__ . '/TwitterOAuth/Exception/TwitterException.php';


use TwitterOAuth\TwitterOAuth;

function getTimelineFrom($user, $time){

	date_default_timezone_set('UTC');

	$config = array(
	    'consumer_key' => '2OnxwQrJikLZI7YCx1FIHqhTU',
	    'consumer_secret' => 'jRv9QS7GEDCMojFlwsbMrCVs5gQ8IviV8ViYK86J2evMjMag6u',
	    'oauth_token' => '43135464-otST3o88CTCTTZXtAsV9WPCzdUufsbsElHeEsL9Tm',
	    'oauth_token_secret' => 'w5UiN3rFGvj3kq62pD66LvBQtgoNea2XzVIxUtI2GerV8',
	    'output_format' => 'array'
	);

	$tw = new TwitterOAuth($config);

	$params = array(
	    'screen_name' => $user,
	    'count' => 5,
	    'exclude_replies' => true
	);

	$response = $tw->get('statuses/user_timeline', $params);

	$result = array();
	foreach ($response as $message) {
		$m = array();
		$m['created'] = $message['created_at'];
		$m['text'] = $message['text'];
		$m['id'] = $message['id_str'];
		$m['name'] = $message['user']['name'];
		$m['handle'] = $message['user']['screen_name'];
		$m['rt_count'] = $message['retweet_count'];
		$m['fav_count'] = $message['favorite_count'];
		if(array_key_exists("media", $message)){
			$media = array();
			foreach ($message['media'] as $med) {
				$thismedia = array();
				$thismedia['url'] = $med['media_url'];
				$thismedia['w'] = $med['sizes']['medium']['w'];
				$thismedia['h'] = $med['sizes']['medium']['h'];
				array_push($media, $thismedia);
			}
			$m['media'] = $media;	
		}
		array_push($result, $m);
		
	}
	return $result;
}

echo json_encode(getTimelineFrom("shivammax", "2014"));
?>