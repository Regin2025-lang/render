<?php

$config = json_decode(
    file_get_contents("config.json"),
    true
);


// ambil langsung config dari InfinityFree

$remote = file_get_contents(
    "https://urakurak.site.je/config.json"
);


if($remote === false){

    die("Gagal ambil config InfinityFree");

}


$data = json_decode($remote, true);


if(!isset($data['message'])){

    echo "ERROR RESPONSE:";
    echo "<pre>";
    print_r($remote);
    echo "</pre>";
    exit;

}


$message = $data['message'];


// kirim ke Telegram

$tg = "https://api.telegram.org/bot".
$config['telegram_token'].
"/sendMessage";


$post = [
    "chat_id"=>$config['chat_id'],
    "text"=>$message
];


$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,$tg);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);


echo curl_exec($ch);

curl_close($ch);
