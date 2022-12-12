<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>曲詳細画面</title>
    <link rel="stylesheet" href="main_tag.css">
    <link rel="stylesheet" href="border.css">
    <link rel="stylesheet" href="tab.css">
  </head>
  <body>
    <?php
    require 'db_m.php';
    $db_review = new GetReview();

    $res2 = $db_review->get_all_user_review('john1234');
    var_dump($res2);
    ?>
  
    <nav>
      <ul>
      <li><a class=”current” href=”#”>Home</a></li>
      <li><a href=”http://localhost/pbl2_git/pbl2/search.html”>Search</a></li>
      <li><a href=”#”>Community</a></li>
      <li><a href=”#”>Profile</a></li>
      </ul>
    </nav>

    <div class="border" style="text-align: center">
      <h3>ひまわりの約束</h3>
      <hr>

      <div class="area">
        <input type="radio" name="tab_name" id="tab1" checked>
        <label class="tab_class" for="tab1">タブ1</label>
        <div class="content_class">
          <p>タブ1のコンテンツを表示します</p>
        </div>
        <input type="radio" name="tab_name" id="tab2" >
        <label class="tab_class" for="tab2">レビューする</label>
        <div class="content_class">
          <p>
            評価：<input type="text" name="評価" size=10>
          </p>

          <br><br>

          <p>
            レビュー:<textarea name="レビュー" rows=3 cols=40></textarea>
          </p>

          <br><br>

          <p>
            <input type="submit" value=" 送信 ">
          </p>



        </div>
      </div>



    </div>
      


  </body>
</html>