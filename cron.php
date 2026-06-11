<?php

date_default_timezone_set(
'Asia/Jakarta'
);

$config = json_decode(
    file_get_contents("config.json"),
    true
);

$data = json_decode(
    file_get_contents($config['api_url']),
    true
);

$jam = $data['send_time'];

$today = date('d');

$current = date('H:i');

if($today != '01'){
    exit('Bukan tanggal 1');
}

if($current != $jam){
    exit('Belum waktunya');
}

$file = 'lastsend.txt';

$bulan = date('Y-m');

if(file_exists($file)){

    $last =
    trim(file_get_contents($file));

    if($last == $bulan){
        exit('Sudah terkirim');
    }
}

include 'sender.php';

file_put_contents(
    $file,
    $bulan
);

echo 'Berhasil';