<?php

/**
 * @author Ctel
 * @ignore It will handle fcm operations
 */
class FCMManager {

    public $strURL = NULL;
    public $strContent = NULL;
    public $strTo = NULL;
    public $arrHeader = array();
    public $strTitle = NULL;
    public $notification_type = NULL;

    /**
     * @author Ctel
     * @param array $arrSmsData
     */
    public function __construct($arrData) {
        $this->strURL = $arrData['url'];
        $this->strTo = $arrData['registration_ids'];
        $this->strContent = $arrData['template'];
        $this->arrHeader = array(
            'Content-Type:application/json',
            'Authorization:key=' . $arrData['key']
        );
        $this->strTitle = $arrData['title'];
        $this->notification_type = $arrData['notification_type'];
    }

    /**
     * @author Ctel
     * @return string It will return a token response upon sms success
     */
    public function fireFCM() {
        $arrFCM = self::send($this->getData());
        return $arrFCM;
    }

    /**
     * @author Ctel
     * @return array It will return sms data
     */
    public function getData() {
        return array(
            'url' => $this->strURL,
            'header' => $this->arrHeader,
            'data' => $this->strContent,
            'registration_ids' => array($this->strTo),
            'title' => $this->strTitle,
            'notification_type' => $this->notification_type,
        );
    }

    /**
     * @author Ctel
     * @return string It will return a token upon sms success
     */
    public static function send($arrData) {
        $arrResponse = NULL;
        $strContent = NULL;
        $strContent = json_encode(array('data' => array('content' => $arrData['data'], 'title' => $arrData['title']), 'registration_ids' => $arrData['registration_ids'], 'type' => $arrData['notification_type']));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $arrData['url']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrData['header']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strContent);
        $arrResponse = curl_exec($ch);
        if ($arrResponse === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $arrResponse;
    }

}
