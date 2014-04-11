<?php

require_once __DIR__ . '/TwitterOAuth/TwitterOAuth.php';
require_once __DIR__ . '/TwitterOAuth/Exception/TwitterException.php';


use TwitterOAuth\TwitterOAuth;

date_default_timezone_set('UTC');


/**
 * Array with the OAuth tokens provided by Twitter when you create application
 *
 * output_format - Optional - Values: text|json|array|object - Default: object
 */
$config = array(
    'consumer_key' => '2OnxwQrJikLZI7YCx1FIHqhTU',
    'consumer_secret' => 'jRv9QS7GEDCMojFlwsbMrCVs5gQ8IviV8ViYK86J2evMjMag6u',
    'oauth_token' => '43135464-otST3o88CTCTTZXtAsV9WPCzdUufsbsElHeEsL9Tm',
    'oauth_token_secret' => 'w5UiN3rFGvj3kq62pD66LvBQtgoNea2XzVIxUtI2GerV8',
    'output_format' => 'json'
);

/**
 * Instantiate TwitterOAuth class with set tokens
 */
$tw = new TwitterOAuth($config);


/**
 * Returns a collection of the most recent Tweets posted by the user
 * https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline
 */
$params = array(
    'screen_name' => 'shivammax',
    'count' => 5,
    'exclude_replies' => true
);

/**
 * Send a GET call with set parameters
 */
$response = $tw->get('statuses/user_timeline', $params);

var_dump($response);


/**
 * Creates a new list for the authenticated user
 * https://dev.twitter.com/docs/api/1.1/post/lists/create
 */
$params = array(
    'name' => 'TwOAuth',
    'mode' => 'private',
    'description' => 'Test List',
);

/**
 * Send a POST call with set parameters
 */
$response = $tw->post('lists/create', $params);

var_dump($response);
