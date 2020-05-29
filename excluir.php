<?php

require 'config.php';
require 'dao/UsuarioDaoMysql.php';
$usuarioDao = new UsuarioDaoMysql($pdo);

$id = filter_input(INPUT_GET, 'id');

if($id){
    $usuarioDao->remove($id);
} 

header("Location: index.php");
exit;