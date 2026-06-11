<?php

$config = json_decode(
    file_get_contents("config.json"),
    true
);


echo "URL API:<br>";
echo $config['api_url'];

echo "<hr>";

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

curl_setopt(
    $ch,
    CURLOPT_HEADER,
    true
);


$result = curl_exec($ch);


echo "<pre>";

if(curl_errno($ch)){

    echo "CURL ERROR: ";
    echo curl_error($ch);

}else{

    echo $result;

}

echo "</pre>";


curl_close($ch);
