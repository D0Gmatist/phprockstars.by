<?php

$root = __DIR__;
$loader = require $root.'/vendor/autoload.php';
$loader->add('', $root.'/classes/');

$pixie = new \App\Pixie();
$pixie->bootstrap($root);

use Abraham\TwitterOAuth\TwitterOAuth;

$api = new TwitterOAuth(
    $pixie->config->get('twitter.consumer_key'),
    $pixie->config->get('twitter.consumer_secret'),
    $argv[1],
    $argv[2]
);

$devs = $pixie->config->get('devs');

foreach ($devs as $dev) {
    $res = $api->post('friendships/create', array('screen_name' => $dev['twitter']));
}
