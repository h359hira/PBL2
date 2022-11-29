<!DOCTYPE html>
<html lang="en">
<head>
<?php

require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    'ID',
    'KEY'
);

$api = new SpotifyWebAPI\SpotifyWebAPI();

$session->requestCredentialsToken();
$accessToken = $session->getAccessToken();
$api->setAccessToken($accessToken);


$query = 'The Beatles';
$type = array('track','artist');
$options = array();

$options += array('market'=>'JP');

$result = $api->search($query, $type, $options);

?>
</head>


<body>
    <h1>検索結果</h1>
    <h3>( q = 'The Beatles', filters = 'track' )</h3>

    <?php
    foreach ($result->tracks->items as $track) {
        echo $track->name.'<br>';
        echo 'spotify id = '.$track->id.'<br><br>';
    }
    ?>
</body>
</html>