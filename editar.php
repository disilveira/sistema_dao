<?php

require 'config.php';
require 'dao/UsuarioDaoMysql.php';
$usuarioDao = new UsuarioDaoMysql($pdo);

$usuario = false;
$id = filter_input(INPUT_GET, 'id');

if($id){
    $usuario = $usuarioDao->selectById($id);
} 

if($usuario === false) {
    header("Location: index.php");
    exit;
}

if(isset($_POST['Gravar'])){

    $id     = filter_input(INPUT_POST, 'id');
    $name   = filter_input(INPUT_POST, 'name');
    $email  = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    
    if($id && $name && $email){ 
        $user = new Usuario();
        $user->setId($id);
        $user->setName($name);
        $user->setEmail($email);
        $usuarioDao->update($user);
        header("Location: index.php");
        exit;
    } else {
        header("Location: editar.php");
        exit;
    }
}

?>

<h1>Editar Usuário</h1>

<a href="index.php">[Voltar]</a><br /><br />
<form method="POST">
    <input type="hidden" name="id" id="id" value="<?php echo $usuario->getId();?>"/>
    <label for="name">
        Nome:<br />
        <input type="text" name="name" id="name" value="<?php echo $usuario->getName();?>"/>
    </label><br /><br />
    <label for="email">
        Email:<br />
        <input type="email" name="email" id="email" value="<?php echo $usuario->getEmail();?>"/>
    </label><br /><br />
    <input type="submit" name="Gravar"/>
</form>