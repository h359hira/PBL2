<!DOCTYPE html>
<html lang="ja">

<head>
    <title>コミュニティ画面</title>
    <?php
    session_start();

    //フォームで送られてきたコミュニティIDをsessionに入れ，更新。
    if (isset($_POST['comm_id'])) {
        $_SESSION['comm_id'] = $_POST['comm_id'];
    }

    //sessionが空の場合，1「general」をいれておく
    if (!isset($_SESSION['comm_id'])) {
        $_SESSION['comm_id'] = '1';
    }

    //仮の値
    $communities = [
        '1' =>
        [
            'general',
            'This is general communitie for all users',
        ],
        '2' =>
        [
            '至極のバラードを決める',
            'バラード曲に投票してください'
        ],
        '3' =>
        [
            'HIPHOP好き',
            'HIPにHOP'
        ]
    ];

    //ボタン変数
    $now_button = "     <input type =\"submit\"  value =\"NOW ON IT\"><br>";
    $ava_button = "     <input type =\"submit\" value =\"AVAILABLE\"><br>";
    ?>
</head>

<body>
    <header>

    </header>

    <h1>コミュニティ選択</h1>

    <?php
    foreach ($communities as $key => $value) {
        //毎時form(IDを入れる)を出力
        echo "<form action=\"communitie.php\" method=\"post\">";
        echo "<input type = \"hidden\" name=\"comm_id\" value=\"$key\">";

        //コミュニティ名出力(id => name, description)
        echo "#" . $value[0];

        //sessionの値と 一致＝＞now button 不一致＝＞available button
        if ($_SESSION['comm_id'] == $key) {
            echo $now_button;
        } else {
            echo $ava_button;
        }

        //コミュニティ説明出力
        echo "DESCRIPPTION<br>" . $value[1] . "<br><br>";
        echo "</form>";
    }
    ?>
</body>

</html>