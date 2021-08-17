<?php

$config = require 'config_server.php';

$request = json_decode(file_get_contents('php://input'), true);

//echo json_encode($request);
//return;

if (isset($request['old_page']) and isset($request['new_page'])){
    $file = $config['base_dir'] . $request['old_page'];
    $new_file = $config['base_dir'] . $request['new_page'];

    if (file_exists($file)){
        rename($file, $new_file);
        echo json_encode(['success' => 'Успешно'], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }else{
        echo json_encode(['error' => 'Файла с таким именем не найдено'], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }
}else {
    echo json_encode(['error' => 'Не указано имя файла.'], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

