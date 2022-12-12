<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">

<title>ホーム画面</title>
<link rel="stylesheet" href="./detail_css/main_tag.css">
<link rel="stylesheet" href="./detail_css/border.css">
<link rel="stylesheet" href="./detail_css/tab.css">

<style>

</style>



</head>

<body>

  <nav>
    <ul>
      <li><a class=”current” href=”#”> Home </a></li>
      <li><a href=”#”> Search </a></li>
      <li><a href=”#”> Community </a></li>
      <li><a href=”#”> Profile </a></li>
    </ul>
  </nav>

  <!--
  ファイル・データ読み込み系コード
  -->
  <?php
    // 指定したキーに対応する値を基準に、配列をソートする
    function sortByKey($key_name, $sort_order, $array) {
      foreach ($array as $key => $value) {
          $standard_key_array[$key] = $value[$key_name];
      }
      array_multisort($standard_key_array, $sort_order, $array);
      return $array;
    }

    $filename = './track_point.txt';

    $file = file($filename);//1行ずつ配列として格納

    //曲のタイトルと得点を分割して配列に格納
    foreach( $file as $line ){
      $dat = explode(',', rtrim($line));//,で分割
      $data[] = array(
        'title' => $dat[0],
        'point' => $dat[1]
      );
    }

    echo 'ソート前<br>';
    print_r($data);
    echo '<br><br>';

    //得点をキーに点が高い順にソート
    $sorted_array = sortByKey('point', SORT_DESC, $data);

    echo 'ソート後<br>';
    //print_r($sorted_array);
    var_dump($sorted_array);

  ?>

    <h1>ランキング</h1>

    <h3>楽曲ランキング</h3>
      <div id="track_ranking">
        <?php
          foreach( $sorted_array as $key => $value ){
            echo $key+1 . '. ' . $value['title'].'<br>';
          }
        ?>
      </div>

    <h3>ユーザーランキング</h3>
      <div id="user_ranking">
        1.<br>
        2.<br>
        3.<br>
      </div>
</body>
</html>
