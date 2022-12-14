<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">

<title>ホーム画面</title>
<link rel="stylesheet" href="./detail_css/main_tag.css">
<link rel="stylesheet" href="./detail_css/border.css">
<link rel="stylesheet" href="./detail_css/tab.css">

<?php
 require '../methods/db_m.php';
 require '../methods/sortByKey.php';
?>

<style></style>


</head>

<body>

  <nav>
    <ul>
      <li><a class=”current” href=home.php> Home </a></li>
      <li><a href=search.html> Search </a></li>
      <li><a href=communitie.php> Community </a></li>
      <li><a href=”#”> Profile </a></li>
    </ul>
  </nav>

  <!--
  ファイル・データ読み込み系コード
  -->
  <?php
    // 指定したキーに対応する値を基準に、配列をソートする
    /*
    function sortByKey($key_name, $sort_order, $array) {
      foreach ($array as $key => $value) {
          $standard_key_array[$key] = $value[$key_name];
      }
      array_multisort($standard_key_array, $sort_order, $array);
      return $array;
    }
    */

    //テキストファイルテストコード
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

    //曲の平均点ランキング取得
    //$track_ave = ;
    //$track_rank = sortByKey('AVE(score)', SORT_DESC, $track_ave);

    //ユーザーの平均点ランキング取得
    //$user_ave = ;
    //$user_rank = sortByKey('AVE(score)', SORT_DESC, $user_ave);

  ?>

    <h1>ランキング</h1>

    <h3>楽曲ランキング</h3>
      <div id="track_ranking">
        <?php
          //ソート結果を順番に表示するコード
          foreach( $sorted_array as $key => $value ){
            echo $key+1 . '. ' . $value['title'].'<br>';
          }
          /*
          //ソート結果を順番に表示するコード
          foreach( $track_rank as $key => $value ){
           if( $key >= 3 ) break; //3個目まで表示して終了
           echo $key+1 . '. ' . $value['spotify_id']. ', '. $value['AVE(score)'] . '<br>';
          }
          */
        ?>
      </div>

    <h3>ユーザーランキング</h3>
      <div id="user_ranking">
        1.<br>
        2.<br>
        3.<br>
        <?php
        /*
        //ソート結果を順番に表示するコード
        foreach( $user_rank as $key => $value ){
         if( $key >= 3 ) break; //3個目まで表示して終了
         echo $key+1 . '. ' . $value['subject_user_id']. ', '. $value['AVE(score)'] . '<br>';
        }
        */
        ?>
      </div>
</body>
</html>
