<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>登録画面</title>
    </head>
    <body>
        <header>
            <h1">新規登録</h1>
        </header>

        <?php
        $user_id = $_POST["user_id"]; 
        $password = $_POST["password1"];
        $password1 = $_POST["password2"];   //２回目のパスワード
        $user_name = $_POST["user_name"];
        $age = $_POST["age"];
        $sex = $_POST["sex"];
        $favorite = $_POST["favorite"];

        if($password == $password1){
            $db = new pdo("mysql:host=localhost;dbname=pbl2", "pbl2", "pbl2");
            $ps=$db->query("SELECT * FROM user_table");
            while($r=$ps->fetch()){
                if($r[0] == $user_id){
                    echo "<p>このユーザーIDは既に使用されています。</p>";
                    echo '<a href ="regi_form.html"><button>戻る</button></a>';
                    exit;
                }
            }
            $sql=$db->prepare(("INSERT INTO user_table VALUE (:user_id, :user_name, :password, :age, :sex, :favorite)"));
            $sql->bindParam( ':user_id', $user_id, PDO::PARAM_STR);
            $sql->bindParam( ':user_name', $user_name, PDO::PARAM_STR);
            $sql->bindParam( ':password', $password, PDO::PARAM_STR);
            $sql->bindParam( ':age', $age, PDO::PARAM_STR);
            $sql->bindParam( ':sex', $sex, PDO::PARAM_STR);
            $sql->bindParam( ':favorite', $favorite, PDO::PARAM_STR);
            $sql->execute();
            echo "<p>登録成功しました。</p>";
            echo '<a href ="login_form.html"><button>ログインページに戻る</button></a>';
            $db = null;
        }else{
            echo "<p>入力したパスワードが異なります。</p>";
            echo '<a href ="regi_form.html"><button>戻る</button></a>';
            exit;
        }
        ?>
    </body>
</html>