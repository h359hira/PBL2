<?php
error_reporting(0);

session_start();
if ($_SESSION["user_id"] != NULL){
    print "ログイン成功<BR>";
    print "ユーザーID:" . $_SESSION["user_id"] . "<BR>";
    echo '<a href ="logout.php"><button>ログアウトする</button></a>';
}
else{
    print "ログイン失敗";
}
?>