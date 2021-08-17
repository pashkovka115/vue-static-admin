<?php
$config = require 'config_server.php';

$request = json_decode(file_get_contents('php://input'), true);


//echo json_encode(['data' => $request]);
//return;

if (
    isset($request['login']) and
    isset($request['password']) and
    md5($config['login'] . $config['password']) == md5($request['login'] . $request['password'])
){
    echo json_encode(['token' => md5($config['login'] . $config['password'])]);
}else {
    echo json_encode([
        'auth' => false,
        'debug' =>[
            'login' => isset($request['login']),
            'password' => isset($request['password']),
            'server_pass == client_pass' => md5($config['login'] . $config['password']) == md5($request['login'] . $request['password'])
        ]
    ]);
}

