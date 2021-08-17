<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header('Location: /editor-landing-page.html');
    exit();
}

require 'headers_for_json.php';

$request = json_decode(file_get_contents('php://input'), true);
$config = require 'config_server.php';
$query = explode('/admin/api/', $_SERVER['REQUEST_URI'])[1];

$headers = getallheaders();

//echo json_encode($headers);
//return;

if (isset($headers['Authorization'])){
    $token = explode(' ', $headers['Authorization']);
}else{
    $token = [1,2];
}

/*
$data = [
    'file_exists' => file_exists('_token.txt'),
    'token_0'=> $token[0],
    'token_1'=> $token[1],
    'token.txt' => md5($config['login'] . $config['password'])
];
*/

/*echo json_encode([
    'request'=>$request,
    'query'=>$query,
    'token' => $token
]);
return;*/

if (
    (
        $token[0] == 'Bearer' and
        $token[1] == md5($config['login'] . $config['password'])
    ) or
    $query == 'config.json'
) {
    if (file_exists($query . '.php')) {
        require $query . '.php';
    } else {
        header('HTTP/1.0 400 Bad Request');
        header('Error: File not found');
    }
}else{
//    header('Location: /admin/api/login');
    require 'login.php';
}

/*
if (
    (
    file_exists('_token.txt') and
    $token[0] == 'Bearer' and
    $token[1] == md5($config['login'] . $config['password'])
    ) or
    $query == 'config.json'
){
    if (file_exists($query . '.php')) {
        require $query . '.php';
    } else {
        header('HTTP/1.0 400 Bad Request');
        header('Error: File not found');
    }
}else{
    require 'login.php';
}*/





