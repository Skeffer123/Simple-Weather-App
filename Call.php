<?php
use Kesit\Latihanpweb\Weather;
require_once __DIR__ . '/vendor/autoload.php';

if ($argc < 2) {
    echo "Penggunaan Yang Benar : php Call.php <nama_kota>\n";
    exit(1);
}

$weather = new Weather();
$city = $argv[1];
echo "Mendapatkan data cuaca untuk $city ...\n";

$result = $weather->getweather($city);
echo "Data cuaca untuk $city:\n";
echo "Kota : " . $result['city'] . "\n";
echo "Suhu : " . $result['temperature'] . "°C\n";
echo "Deskripsi : " . $result['description'] . "\n";
echo "Kelembapan : " . $result['humidity'] . "%\n";