<?php
$config = require 'config_server.php';

$request = json_decode(file_get_contents('php://input'), true);


//echo json_encode(['data' => $request]);
//return;

if (isset($request['page'])){
    $file = $config['base_dir'] . $request['page'];

    if (file_exists($file)){
        $page = file_get_contents($file);
        echo json_encode(['data' => ['page' => $page]]);
    }else{
        echo json_encode(['error' => 'Файла с таким именем не найдено']);
    }
}else {
    echo json_encode(['error' => 'Не указано имя файла.']);
}

