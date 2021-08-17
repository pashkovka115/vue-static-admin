<?php
$config = require 'config_server.php';

unset($config['login']);
unset($config['password']);
unset($config['base_dir']);

echo json_encode(['data' => $config]);
