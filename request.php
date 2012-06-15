<?php

$privateKey = 'caa68fb2160b428bd1e7d78fcf0ce2d5';
$publicKey  = '01fa456c4e2a2bc13e5c0c4977297fbb';

//$data = '{"test":"testing this"}';

$data = file_get_contents('php://input');
$hash = hash_hmac('sha256',$data,$privateKey);

$headers = array(
    'X-Auth: '.$publicKey,
    'X-Auth-Hash: '.$hash
);

//-------------------------

$ch = curl_init('http://chipdin.localhost:8080/speaker/enygma');

curl_setopt($ch,CURLOPT_HEADER,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
//curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

$result = curl_exec($ch);

curl_close($ch);

// split off the headers
$split = explode("\r\n\r\n",$result);

echo $split[1];