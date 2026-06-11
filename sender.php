<?php

$config = json_decode(
    file_get_contents("config.json"),
    true
);


$response = file_get_contents(
    $config['api_url']
);


if($response === false){

    die("Tidak bisa ambil API InfinityFree");
}


$data = json_decode(
    $response,
    true
);


if(!isset($data['message'])){

    echo "Response InfinityFree:";
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    exit;
}


$message = $data['message'];


$url =
"https://api.telegram.org/bot".
$config['telegram_token'].
"/sendMessage";


$post = [
    "chat_id"=>$config['chat_id'],
    "text"=>$message
];


$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);


$result = curl_exec($ch);


if(curl_errno($ch)){

    echo curl_error($ch);

}else{

    echo $result;
}


curl_close($ch);
