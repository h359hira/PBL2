<?php
require '../vendor/autoload.php';

function get_track_info($spo_ids){

    $session = new SpotifyWebAPI\Session(
        'e3b54d636bfc4563847d04e832bf8f3d',
        '312b2e31c1b94754b86c6d686e14f991'
    );
    
    $api = new SpotifyWebAPI\SpotifyWebAPI();
    
    $session->requestCredentialsToken();
    $accessToken = $session->getAccessToken();
    $api->setAccessToken($accessToken);

    $res = $api->getTracks($spo_ids);

    return $res;
}

function search_track($query){
    $session = new SpotifyWebAPI\Session(
        'e3b54d636bfc4563847d04e832bf8f3d',
        '312b2e31c1b94754b86c6d686e14f991'
    );
    
    $api = new SpotifyWebAPI\SpotifyWebAPI();
    
    $session->requestCredentialsToken();
    $accessToken = $session->getAccessToken();
    $api->setAccessToken($accessToken);
    
    $type = array('track','artist');
    $options = array();

    $options += array('market'=>'JP');
    $res = $api->search($query, $type, $options);

    return $res;
}
?>