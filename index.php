<?php

//https://www.yoncu.com/apiler/domain/get/sorgula.php?aa=domainadi.com

function sorgula(){
  $curl = curl_init();

  curl_setopt($curl, CURLOPT_URL, 'https://www.yoncu.com/apiler/domain/get/sorgula.php');
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, "aa=domainadi.com");

  $result = curl_exec($curl);

  curl_close($curl);

  return $result;
}
$donendeger = array();
$donendeger = json_decode(sorgula(),true);

$kontrol = $donendeger[1]['domainadi.com'];

// echo $kontrol;

if($kontrol!="DOLU" || $kontrol=="BOS" || $kontrol=="BOŞ"){

  require("mesajgonder/send.php");

}

?>
