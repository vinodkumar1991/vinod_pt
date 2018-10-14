<?php

/**
 * @author Ctel
 * @ignore It will handle sms operations
 */
class SMSManager {

    public $strAuthKey;
    public $strSender;
    public $intRoute;
    public $strSecureURL;
    public $mobile;
    public $message;

    /**
     * @author Ctel
     * @param array $arrSmsData
     */
    public function __construct($arrSmsData) {
        $this->strAuthKey = $arrSmsData['key'];
        $this->strSender = $arrSmsData['sender'];
        $this->intRoute = $arrSmsData['route'];
        $this->strSecureURL = $arrSmsData['url'];
        $this->mobile = $arrSmsData['mobile'];
        $this->message = $arrSmsData['message'];
    }

    /**
     * @author Ctel
     * @return string It will return a token response upon sms success
     */
    public function fireSMS() {
        $strSMS = self::send($this->getData());
        return $strSMS;
    }

    /**
     * @author Ctel
     * @return array It will return sms data
     */
    public function getData() {
        return array(
            'authkey' => $this->strAuthKey,
            'mobiles' => $this->mobile,
            'message' => $this->message,
            'sender' => $this->strSender,
            'route' => $this->intRoute,
            'url' => $this->strSecureURL
        );
    }

    /**
     * @author Ctel
     * @return string It will return a token upon sms success
     */
    public static function send($arrSMS) {
        $strSMS = NULL;
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $arrSMS['url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $arrSMS,
                //CURLOPT_FOLLOWLOCATION => true
        ));
        //To ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $strSMS = curl_exec($ch);
        return $strSMS;
    }

    
//    $url='http://api.smscountry.com/SMSCwebservice_bulk.aspx?User=chandu4130&passwd=Metre@2016&mobilenumber=9705999270&message=hiii&sid=smscntry&mtype=N&DR=Y';
//
// $ch = curl_init();
//        // Disable SSL verification
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        // Will return the response, if false it print the response
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        // Set the url
//        curl_setopt($ch, CURLOPT_URL, $url);
//        // Execute
//        $result = curl_exec($ch);
//        // Closing
//
//        curl_close($ch);
//print_r($result);

}
