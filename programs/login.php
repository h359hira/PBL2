<?php
$d = mysqli_connect("host", "pbl2", "pbl2") or die("接続失敗");
print("接続成功<BR>");
mysqli_select_db("user_table", $d);
mysqli_select_db("SELECT ")
mysqli_close($d) or die("切断失敗");
print ("切断成功")  
?>