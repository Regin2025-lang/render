<?php

$config = json_decode(
    file_get_contents("config.json"),
    true
);


$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,$config['api_url']);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

$response = curl_exec($ch);

curl_close($ch);


$data = json_decode(
    $response,
    true
);


if(!isset($data['message'])){

    echo "API gagal:";
    echo "<pre>";
    print_r($response);
    echo "</pre>";
    exit;
}


$message=$data['message'];


$url=
"https://api.telegram.org/bot".
$config['telegram_token'].
"/sendMessage";


$post=[
"chat_id"=>$config['chat_id'],
"text"=>$message
];


$ch=curl_init();

curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);


echo curl_exec($ch);

curl_close($ch);
