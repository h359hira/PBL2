<?php
$user_id = $_POST['user_id'];
$password = $_POST['password'];

$db = new pdo('mysql:host=localhost;dbname=pbl2', 'pbl2', 'pbl2');
$ps=$db->query('SELECT * FROM user_table');

//ユーザーID探し
while($r=$ps->fetch()){
    if($r[0] == $user_id){
        if($r[2] == $password){
            session_start();
            $_SESSION['user_id'] = $user_id;
            echo '<p>ユーザーID:' . $_SESSION['user_id'] . '</p>';
            echo '<p>**本来ならこのページを表示せずに、ログイン後のページに遷移する**</p>';
            echo '<a href ="login_test.php"><button>ログインテストをする</button></a>';
            exit;
        }
        else {
            echo '<p>ユーザーIDかパスワードが間違っています。</p>';
            echo '<a href ="login_form.html"><button>戻る</button></a>';
            exit;
        }
    }
}
echo '<p>ユーザーIDかパスワードが間違っています。</p>';
echo '<a href ="login_form.html"><button>戻る</button></a>';
?>