<?php

class CommonFunctions {

    /**
     * @author Ctel
     * @param integer $intMin
     * @param integer $intMax
     * @return integer It will return an integer response
     */
    public static function cryptoRandSecure($intMin, $intMax) {
        $intRanage = $intMax - $intMin;
        if ($intRanage < 1) {
            return $intMin;
        }
        $intLog = ceil(log($intRanage, 2));
        $intBytes = (int) ($intLog / 8) + 1;
        $intBits = (int) $intLog + 1;
        $intFilter = (int) (1 << $intBits) - 1;
        do {
            $intRnd = hexdec(bin2hex(openssl_random_pseudo_bytes($intBytes)));
            $intRnd = $intRnd & $intFilter;
        } while ($intRnd >= $intRanage);
        return $intMin + $intRnd;
    }

    /**
     * @author Ctel
     * @param integer $intLength
     * @param string $strTokenSoliders
     * @return string It will return a token string response
     */
    public static function getToken($intLength, $strTokenSoliders = NULL) {
        $strToken = "";
        if (!empty($strTokenSoliders)) {
            $strCodeAlphabet = $strTokenSoliders;
        } else {
            $strCodeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $strCodeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
            $strCodeAlphabet .= "0123456789";
        }
        $intMaxNumber = strlen($strCodeAlphabet) - 1;
        for ($i = 0; $i < $intLength; $i++) {
            $strSecure = self::cryptoRandSecure(0, $intMaxNumber);
            $strToken .= $strCodeAlphabet[$strSecure];
        }
        return $strToken;
    }

    /**
     * @author Ctel
     * @return string It will return a device name
     * @ignore Need to change
     */
    public static function getDevice() {
        $userAgent = $_SERVER["HTTP_USER_AGENT"];
        $devicesTypes = array(
            "computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
            "tablet" => array("tablet", "android", "ipad", "tablet.*firefox"),
            "mobile" => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
            "bot" => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
        );
        foreach ($devicesTypes as $deviceType => $devices) {
            foreach ($devices as $device) {
                if (preg_match("/" . $device . "/i", $userAgent)) {
                    $deviceName = $deviceType;
                }
            }
        }
        return ucfirst($deviceName);
    }

    /**
     * @author Ctel 
     * @param string $strDevice
     * @return integer It will return device id
     */
    public static function getDeviceId($strDevice) {
        $intDevice = 1;
        $arrDeviceInfo = DeviceTypes::getDeviceTypes($strDevice);
        if (!empty($arrDeviceInfo)) {
            $intDevice = $arrDeviceInfo->id;
        }
        return $intDevice;
    }

    /**
     * @author Ctel
     * @param integer $intLength
     * @return string It will return a token string
     */
    public static function getNumberToken($intLength = 6) {
        $strNumber = "0123456789";
        $strToken = self::getToken($intLength, $strNumber);
        return $strToken;
    }

    /**
     * @author Ctel
     * @param integer $intLength
     * @return string It will return a token string
     */
    public static function getSamllAlphaToken($intLength = 12) {
        $strSmall = "abcdefghijklmnopqrstuvwxyz";
        $strToken = self::getToken($intLength, $strSmall);
        return $strToken;
    }

    /**
     * @author Ctel
     * @param integer $intLength
     * @return string It will return a token string
     */
    public static function getBigAlphaToken($intLength = 12) {
        $strBig = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $strToken = self::getToken($intLength, $strBig);
        return $strToken;
    }

    /**
     * @author Ctel
     * @param string $strPassword
     * @param boolean $booleanInput
     * @return string It will return a strong password
     */
    public static function generatePassword($strPassword, $booleanInput = TRUE) {
        $strStrongPwd = NULL;
        $strPwd = Yii::app()->params['secureToken'] . $strPassword . '##@!';
        $strMD5Pwd = md5($strPwd);
        $strSHAPassword = sha1($strMD5Pwd);
        $strStrongPwd = $strSHAPassword;
        return $strStrongPwd;
    }

    /**
     * @author Ctel
     * @param integer $intLength
     * @param string $strCustomSolider
     * @return string It will return a string
     */
    public static function getCustomToken($strCustomSolider, $intLength = 6) {
        $strToken = self::getToken($intLength, $strCustomSolider);
        return $strToken;
    }

    /**
     * @author Ctel
     * @param array $arrErrors
     * @return object It will return an object
     */
    public static function formatErrors($arrErrors) {
        $arrFaults = NULL;
        if (!empty($arrErrors)) {
            foreach ($arrErrors as $objKey => $objValue) {
                $arrFaults[$objKey] = $objValue[0];
            }
        }
        return $arrFaults;
    }
    
    public static function getDateDifferences($strStartDate, $strEndDate) {
        $arrDateDiffInfo = array();
        $strTimestampStartDate = strtotime($strStartDate);
        $strTimestampEndDate = strtotime($strEndDate);
        $doubleTimeInterval = abs($strTimestampStartDate - $strTimestampEndDate);
        $arrDateDiffInfo['seconds'] = round($doubleTimeInterval);
        $arrDateDiffInfo['minutes'] = round($doubleTimeInterval / 60);
        return $arrDateDiffInfo;
    }

}
