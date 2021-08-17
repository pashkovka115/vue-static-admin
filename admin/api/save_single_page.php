<?php
$config = require 'config_server.php';

$request = json_decode(file_get_contents('php://input'), true);


//echo json_encode(['data' => $request]);
//return;

if (isset($request['data'])) {

    if (isset($request['page'])) {
        $file = $config['base_dir'] . $request['page'];

        file_put_contents($file, $request['data']);

        echo json_encode(['file' => $file]);
        return;

        if (file_exists($file)) {
        //    file_put_contents($file, $request['data']['data']);
        } else {
            echo json_encode(['error' => 'Файл с таким именем не найден.']);
        }
    } else {
        echo json_encode([
            'error' => 'Не указано имя файла.',
            'request' => $request
        ]);
    }


}else{
    echo json_encode(['error' => 'Не указаны данные.']);
}
