<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>曲詳細画面</title>
  <link rel="stylesheet" href="./detail_css/main_tag.css">
  <link rel="stylesheet" href="./detail_css/border.css">
  <link rel="stylesheet" href="./detail_css/tab.css">
  <?php
  //review
  //require '../methods/db_m.php';

  //$db = new GetReview();

  //$res1 = $db->get_all_user_review('john1234');
  //$res2 = $db->get_all_track_review('7iN1s7xHE4ifF5povM6A48');
  
  //detail_song
  require '../vendor/autoload.php';
  require '../methods/api_request.php';

  $result = get_track_info($_GET['spotify_id']);
  $result1 = get_artist_info($result->tracks[0]->album->artists[0]->id);

  ?>
</head>

<body>
  <nav>
    <ul>
      <li><a class=”current” href=”#”>Home</a></li>
      <li><a href=”http://localhost/pbl2_work/programs/views/search.html”>Search</a></li>
      <li><a href=”#”>Community</a></li>
      <li><a href=”#”>Profile</a></li>
    </ul>
  </nav>

  <div class="border" style="text-align: center">
    <h3><?= $result->tracks[0]->name?></h3>
    <hr>

    <div class="area">
      <input type="radio" name="tab_name" id="tab1" checked>
      <label class="tab_class" for="tab1">曲情報</label>
      <div class="content_class">
        <p>
          <?php
          echo "アーティスト名：" .$result->tracks[0]->artists[0]->name. "<br>";
          echo "収録アルバム名：" .$result->tracks[0]->album->name. "<br>";
          echo "アルバムリリース日：" .$result->tracks[0]->album->release_date. "<br>";
          echo "ジャンル：" .$result1->genres[0]. "<br>";

          //foreach( $res2 as $e ){
            //echo "評価：".$e['score']."点<br>";
            //echo "コメント<br>";
            //echo $e['comment']."<br>";
          //}
          ?>
        </p>
        <iframe src="https://open.spotify.com/embed/track/<?=$_GET['spotify_id']?>"
            width="70%"
            height="123"
            frameborder="0"
            allowtransparency="true"
            allow="encrypted-media">
        </iframe>
      </div>
      <input type="radio" name="tab_name" id="tab2">
      <label class="tab_class" for="tab2">レビューする</label>
      <div class="content_class">
        <p>
          評価：<input type="number" min="0" max="100" name="eva" size=20>
        </p>

        <br>

        <p>
          レビュー:<textarea name="review" rows=3 cols=40></textarea>
        </p>

        <br><br>

        <p>
          <input type="hidden" name="spotify_id" value="<?=$_GET['spotify_id']?>">
          <input type="submit" value=" 送信 ">
        </p>



      </div>
    </div>



  </div>



</body>

</html>