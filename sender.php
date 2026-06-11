<?php

$config = json_decode(
    file_get_contents("config.json"),
    true
);


// Ambil data dari InfinityFree

$ch = curl_init();

curl_setopt(
    $ch,
    CURLOPT_URL,
    $config['api_url']
);

curl_setopt(
    $ch,
    CURLOPT_RETURNTRANSFER,
    true
);

$response = curl_exec($ch);


if(curl_errno($ch)){

    die("API ERROR: ".curl_error($ch));

}

curl_close($ch);


// tampilkan untuk cek

$data = json_decode(
    $response,
    true
);


if(!isset($data['message'])){

    echo "Response API:";
    echo "<pre>";
    print_r($response);
    echo "</pre>";

    exit;

}


$message = $data['message'];



// Kirim Telegram

$url =
"https://api.telegram.org/bot".
$config['telegram_token'].
"/sendMessage";


$post = [

    "chat_id" => $config['chat_id'],
    "text" => $message

];


$ch = curl_init();


curl_setopt(
    $ch,
    CURLOPT_URL,
    $url
);

curl_setopt(
    $ch,
    CURLOPT_POST,
    true
);

curl_setopt(
    $ch,
    CURLOPT_POSTFIELDS,
    $post
);

curl_setopt(
    $ch,
    CURLOPT_RETURNTRANSFER,
    true
);


$result = curl_exec($ch);


if(curl_errno($ch)){

    echo "Telegram ERROR: ".curl_error($ch);

}else{

    echo $result;

}


curl_close($ch);
