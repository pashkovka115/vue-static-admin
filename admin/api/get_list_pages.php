<?php
//require 'config_server.php';
//header('Content-Type: application/json');


//$request = json_decode(file_get_contents('php://input'), true);
$config = require 'config_server.php';

$files = glob($config['base_dir'] . '*.html');
$files_html = [];
foreach ($files as $file){
    $f = basename($file);
    if ($f !== 'editor-landing-page.html'){
        $files_html['data']['files'][] = $f;
    }
}

if (count($files_html) > 0){
    echo json_encode($files_html);
}else{
    echo json_encode(['error' => 'Файлы для редактирования не найдены.']);
}

