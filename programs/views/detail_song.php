<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>曲詳細画面</title>
  <link rel="stylesheet" href="./detail_css/main_tag.css">
  <link rel="stylesheet" href="./detail_css/border.css">
  <link rel="stylesheet" href="./detail_css/tab.css">
  <?php
  session_start();
  require '../vendor/autoload.php';
  require '../methods/api_request.php';
  require '../methods/db_m.php';
  require '../methods/sortByKey.php';

  $db = new GetReview();

  $res2 = $db->get_all_track_review($_GET['spotify_id'], $_SESSION['comm_id']);
  $user_score = $db->get_score(false, $_SESSION['comm_id']);
  $user_sorted = sortByKey("AVG(score)", SORT_DESC, $user_score);

  $result = get_track_info($_GET['spotify_id']);
  $result1 = get_artist_info($result->tracks[0]->album->artists[0]->id);

  ?>
</head>

<body>
  <nav>
    <ul>
      <li><a class=”current” href="home.php"> Home </a></li>
      <li><a href="search.html"> Search </a></li>
      <li><a href="communitie.php"> Community </a></li>
      <li><a href="profiel.php"> Profile </a></li>
  </nav>

  <div class="border" style="text-align: center">
    <h3><?= $result->tracks[0]->name ?></h3>
    <hr>

    <div class="area">
      <input type="radio" name="tab_name" id="tab1" checked>
      <label class="tab_class" for="tab1">曲情報</label>
      <div class="content_class">
        <p>
          <?php
          echo "アーティスト名：" . $result->tracks[0]->artists[0]->name . "<br>";
          echo "収録アルバム名：" . $result->tracks[0]->album->name . "<br>";
          echo "アルバムリリース日：" . $result->tracks[0]->album->release_date . "<br>";
          echo "ジャンル：" . $result1->genres[0] . "<br>";
          ?>
        </p>
        <iframe src="https://open.spotify.com/embed/track/<?= $_GET['spotify_id'] ?>" width="70%" height="123" frameborder="0" allowtransparency="true" allow="encrypted-media">
        </iframe>
        <?php
        foreach ($res2 as $review) {
          foreach ($user_sorted as $user)
            if ($review['user_id'] == $user['subject_user_id']) {
              echo "評価：" . $review['score'] . "<br>";
              echo "コメント：" . $review['comment'] . "<br>";
            }
        }
        ?>
      </div>
      <input type="radio" name="tab_name" id="tab2">
      <label class="tab_class" for="tab2">レビューする</label>
      <div class="content_class">
      <form method="POST" action="../methods/song_eva.php">
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
        </form>



      </div>
    </div>



  </div>



</body>

</html>