<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">

<title>ホーム画面</title>
<link rel="stylesheet" href="./detail_css/main_tag.css">
<link rel="stylesheet" href="./detail_css/border.css">
<link rel="stylesheet" href="./detail_css/tab.css">

<?php
 session_start();
 require '../methods/api_request.php';
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
      <li><a href=profiel.php> Profile </a></li>
    </ul>
  </nav>

  <!--
  ファイル・データ読み込み系コード
  -->
  <?php
    //セッションが空なら1を入れる
    if(!isset($_SESSION['comm_id'])){
      $_SESSION['comm_id'] = 1;
    }

    //DBインスタンス生成
    $db_review = new GetReview();
    //get_score( type, communitie_id ) typeはtrueが曲、falseがユーザー
    //曲のIDと平均点取得（ spotify_id, AVE(score) ）
    $track_score = $db_review->get_score( true, $_SESSION['comm_id'] );
    //ユーザーのIDと平均点取得（ spotify_id, AVE(score) ）
    $user_score = $db_review->get_score( false, $_SESSION['comm_id'] );

    //不要～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～
    /*
    //曲を評価順に並べた配列を一挙表示
    var_dump($track_id_rank);
    echo '<br><br>';
    //ユーザーを評価順に並べた配列を一挙表示
    var_dump($user_id_rank);
    echo '<br><br>';

    //曲情報取得,関連情報一挙表示
    $track_info_test = get_track_info($track_id_rank[0]['spotify_id']);
    echo $track_info_test->tracks[0]->album->name;
    //echo '<br><br>';
    //var_dump($track_info_test->tracks[0]);
    */

    /*
    //URLとIDを結合
    $id_tmp = $track_id_rank[0]['spotify_id'];
    $spotify_url = "https://open.spotify.com/embed/track/"."$id_tmp";

    //spotifyの枠で表示
    echo "<iframe src=".$spotify_url."
    width=\"30%\"
    height=\"123\"
    frameborder=\"0\"
    allowtransparency=\"true\"
    allow=\"encrypted-media\"></iframe>";
    */
    //不要～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～


  ?>

    <div class="border" style="text-align: center">
    <h2>ランキング</h2>

    <hr>

      <h3>楽曲ランキング</h3>
        <div id="track_ranking">
          <?php
            //データベースに情報がない場合
            if(empty($track_score)){
              echo "曲のレビューを投稿してみましょう！<br>";
            }else{
              //曲ランキングソート
              $track_id_rank = sortByKey( 'AVG(score)', SORT_DESC, $track_score );

              //ソート結果を順番に表示するコード
              foreach( $track_id_rank as $key => $value ){
                if( $key >= 3 ) break; //3個目まで表示して終了
                //URLとIDを結合
                $id_tmp = $value['spotify_id'];
                $spotify_url = "https://open.spotify.com/embed/track/"."$id_tmp";

                //ランキング配列内の曲情報取得
                $track_info = get_track_info($track_id_rank[$key]['spotify_id']);

                //順位表示
                echo $key+1 . '. ';

                //曲詳細画面へのリンク表示
                echo "<a href=\"./detail_song.php?spotify_id=".$id_tmp."\">"
                .$track_info->tracks[0]->album->name.
                "</a>";

                //曲のスコア表示
                echo ', '. $value['AVG(score)'] . '<br>';

                //spotifyの枠で表示
                echo "<iframe src=".$spotify_url."
                width=\"60%\"
                height=\"123\"
                frameborder=\"0\"
                allowtransparency=\"true\"
                allow=\"encrypted-media\"></iframe><br>";
              }
            }

          ?>
        </div>

      <h3>ユーザーランキング</h3>
        <div id="user_ranking">
          <?php
          //データベースに情報がない場合
          if(empty($user_score)){
            echo "ユーザーのレビューを投稿してみましょう！<br>";
          }else{
            //ユーザーランキングソート
            $user_id_rank = sortByKey('AVG(score)', SORT_DESC, $user_score );

            //ソート結果を順番に表示するコード
            foreach( $user_id_rank as $key => $value ){
              if( $key >= 3 ) break; //3個目まで表示して終了
              echo $key+1 . '. ' . $value['subject_user_id']. ', '. $value['AVG(score)'] . '<br>';
            }
          }

          ?>
        </div>

      </div>
</body>
</html>
