<?php

// ambil config Render
$config = json_decode(
    file_get_contents("config.json"),
    true
);

// ambil data dari InfinityFree
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://urakurak.site.je/config.json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);
$error = curl_error($ch);

curl_close($ch);

if($error){
    die("CURL ERROR: ".$error);
}

if(!$response){
    die("EMPTY RESPONSE FROM INFINITYFREE");
}

// decode JSON
$data = json_decode($response, true);

if(!isset($data['message'])){
    echo "RAW RESPONSE:<br><pre>";
    echo $response;
    echo "</pre>";
    exit;
}

$message = $data['message'];

// kirim ke Telegram
$tg = "https://api.telegram.org/bot".$config['telegram_token']."/sendMessage";

$post = [
    "chat_id" => $config['chat_id'],
    "text" => $message
];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $tg);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

curl_close($ch);

echo $result;
