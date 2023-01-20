<?php
 require '../methods/login_method.php';
 $_SESSION["user_id"];
 $_GET['spotify_id'];
 if(login_check()){
    $db_ins = new DataIns();
    $db_ins->track_eva($user_id, $spotify_id, $communitie_id, $score, $comment);
 }else{
    header("Location:login_form.html");
 }
?>