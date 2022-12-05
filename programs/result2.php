<!DOCTYPE html>
<html lang="ja">
<head>
<?php

require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    'e3b54d636bfc4563847d04e832bf8f3d',
    '312b2e31c1b94754b86c6d686e14f991'
);

$api = new SpotifyWebAPI\SpotifyWebAPI();

$session->requestCredentialsToken();
$accessToken = $session->getAccessToken();
$api->setAccessToken($accessToken);

$name = $_POST["search"];

$query = $name;
$type = array('track','artist');
$options = array();

$options += array('market'=>'JP');

$result = $api->search($query, $type, $options);

?>
</head>


<body>
    <h1>検索結果</h1>

    <?php
    $name = $_POST["search"];
    echo $name;
    echo '<br>';
    echo '<br>';
    foreach ($result->tracks->items as $track) {
        print '<a href="http://google.co.jp">'.$track->name.'<br>';
        echo '<br>';
    }
    ?>
</body>
</html>