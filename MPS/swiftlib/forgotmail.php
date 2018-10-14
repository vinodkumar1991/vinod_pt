<?php
//swiftmailer code
$email='saritha@infinitelinked.com';
$transporter = Swift_SmtpTransport::newInstance('secure.emailsrvr.com',465,'ssl')
        ->setUsername('noreply@infinitelinked.com')
        ->setPassword('M@nt!$bt');
    $transporter->setLocalDomain('[127.0.0.1]');
    $mailer = Swift_Mailer::newInstance($transporter);
		$sLink="http://tools.infinitelinked.com/payslipbkp/resetpassword.php?q=".base64_encode($email);
		//echo $sLink;
		//exit;
//$mailer = Swift_Mailer::newInstance($smtp);
$message = Swift_Message::newInstance('payslip');
$message
  ->setTo($email)
   // 'user2@example.org' => 'User Two',
    //'user3@exmaple.org' => 'Another User Name'
  
  ->setFrom(array('noreply@infinitelinked.com' => 'Payslip'))
  
  ->setBody('Hi <i>'.$sUsername.'</i>,<br><br><i>Greetings!</i><br><br>We received a request to reset the password associated with this e-mail address. If you made this request, please <a href="'.$sLink.'">Click Here</a>&nbsp;reset password  using our secure server<br ><br>
  Thanks,<br> Team','text/html');
  //->addPart('hi once check the mail..', 'text/plain')
  

if ($mailer->send($message))
{
  echo "<script>alert('please check your mail.');</script>";
}
else
{
  echo "<script>alert('Message could not be sent.');</script>";
}
?>