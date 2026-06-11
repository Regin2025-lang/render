<?php

$config = json_decode(
    file_get_contents("config.json"),
    true
);


$response = file_get_contents(
    $config['api_url']
);


echo "<h3>Response InfinityFree:</h3>";

echo "<pre>";
var_dump($response);
echo "</pre>";


$data = json_decode(
    $response,
    true
);


echo "<h3>Hasil JSON:</h3>";

echo "<pre>";
var_dump($data);
echo "</pre>";

exit;
