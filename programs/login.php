<?php
$user_id = $_POST["user_id"];
$password = $_POST["password"];

$db = new pdo("mysql:host=localhost;dbname=pbl2", "pbl2", "pbl2");
$ps=$db->query("SELECT * FROM user_table");
while($r=$ps->fetch()){
    if($r[0] == $user_id){
        echo "ユーザーID発見<BR>";
        if($r[2] == $password){
            echo "ログイン成功<BR>";
            session_start();
            $_SESSION["user_id"] = $user_id;
            print "ユーザーID:" . $_SESSION["user_id"] . "<BR>";
            echo '<a href ="login_test.php"><button>ログインテストをする</button></a>';
            exit;
        }
        else {
            echo "パスワードが違います<BR>";
            exit;
        }
    }
}
echo "ユーザーIDが見つかりませんでした。<BR>";
?>