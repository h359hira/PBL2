<?php
$db_name = 'mysql:host=localhost;dbname=pbl2';
$db_user = 'root';
$db_pass = '';

$user_id = $_POST['user_id'];
$password = $_POST['password'];

$db = new pdo($db_name, $db_user, $db_pass);
$ps=$db->query('SELECT * FROM user_table');

//ユーザーID探し
while($r=$ps->fetch()){
    if($r[0] == $user_id){
        if($r[2] == $password){
            session_start();
            $_SESSION['user_id'] = $user_id;

            header("Location:home.php");
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