<?php

$config = json_decode(
    file_get_contents("config.json"),
    true
);


$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,$config['api_url']);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

curl_setopt($ch,CURLOPT_HEADER,true);

$response = curl_exec($ch);


echo "<pre>";
echo $response;
echo "</pre>";


curl_close($ch);
