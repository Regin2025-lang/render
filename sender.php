<?php

$config = json_decode(
    file_get_contents("config.json"),
    true
);

$data = json_decode(
    file_get_contents($config['api_url']),
    true
);

$message = $data['message'];

$url =
"https://api.telegram.org/bot".
$config['telegram_token'].
"/sendMessage";

$post = [
    'chat_id' => $config['chat_id'],
    'text' => $message
];

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

$result = curl_exec($ch);

curl_close($ch);

echo $result;