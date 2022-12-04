<?php
$d = mysql_connect("localhost", "root", "1234") or die("接続失敗");
print("接続成功<BR>");
mysql_close($d) or die("切断失敗");
print ("切断成功")  
?>