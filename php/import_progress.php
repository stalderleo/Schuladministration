<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$file = "../res/data/log.txt";
$data = file($file);
$line = $data[count($data)-1];

echo "data: $line\n\nretry: 50\n\n";
ob_flush();
flush();


