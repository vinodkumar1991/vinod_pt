<?php

require_once  Yii::app()->basePath . '/extensions/PHPMailer/class.phpmailer.php';
class SMTPConfiguration {
    public static function getSMTPConfig(){
            $mail=new PHPMailer();            
            $mail->IsSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = Yii::app()->params['smtp_config']['smtp_auth'];;
            $mail->SMTPSecure =Yii::app()->params['smtp_config']['smtp_secure'];
            $mail->Host = Yii::app()->params['smtp_config']['smtp_host'];
            $mail->Port = Yii::app()->params['smtp_config']['smtp_port'];
            $mail->Username = Yii::app()->params['smtp_config']['username'];
            $mail->Password = Yii::app()->params['smtp_config']['password'];
            $mail->SetFrom(Yii::app()->params['smtp_config']['from_mail'],'MetrePerSecond');
            $mail->isHTML(true);
            $mail->Encoding = Yii::app()->params['smtp_config']['encoding'];
            return $mail;
    }   
}
