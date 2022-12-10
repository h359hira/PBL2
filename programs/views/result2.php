<!DOCTYPE html>
<html lang="ja">
<head>
<?php

require '../vendor/autoload.php';
require '../methods/api_request.php';

$result = search_track($_POST["search"]);
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