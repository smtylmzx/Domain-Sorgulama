<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$domainName = 'facebook.com'; // Domain name
$emailAddress = 'sametyilmazx@gmail.com'; // Gmail address
$mailPassword = 'xxxs123xxx..'; // Gmail password

function domainControl($domainName)
{
    $apiAddress = 'https://www.yoncu.com/apiler/domain/get/sorgula.php';

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $apiAddress);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, 'aa=' . $domainName);

    $result = curl_exec($curl);
    curl_close($curl);

    // Exp $result = '[true,{"facebook.com":"DOLU"}]';
    return $result;
}

$domainStatus = json_decode(domainControl($domainName), true);
$domainStatusResult = $domainStatus[1][$domainName];

if ($domainStatusResult !== 'DOLU' || $domainStatusResult === 'BOS' || $domainStatusResult === 'BOŞ') {

    $mail = new PHPMailer(true);

    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->Username = $emailAddress;
    $mail->Password = $mailPassword;

    try {
        $mail->setFrom($emailAddress, 'Domain Control Service');
        $mail->addAddress($emailAddress, 'Domain Control Service');
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Domain Control Service';
        $mail->msgHTML('Heyyy!!! ' . $domainName . ' is purchasable!!');
        $mail->Send();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
