<?php
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://control.msg91.com/api/sendotp.php?template={otp} is your otp&otp_length=5&authkey=246841AksEh7XND5be6c5e0&message={otp:21099}&sender=MTROTP&mobile=9705999270&otp=21099&otp_expiry=1&email=vinodkumarmeda1991@gmail.com",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "",
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}