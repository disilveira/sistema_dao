<?php

if(isset($_POST['Gravar'])){

    require 'config.php';
    require 'dao/UsuarioDaoMysql.php';
    $usuarioDao = new UsuarioDaoMysql($pdo);

    $name  = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    
    if($name && $email){

        if($usuarioDao->selectByEmail($email) === false){
            
            $user = new Usuario();
            $user->setName($name);
            $user->setEmail($email);
            $usuarioDao->create($user);

            header("Location: index.php");
            exit;

        }else{

            header("Location: adicionar.php");
            exit;
            
        }

    } else {
        header("Location: adicionar.php");
        exit;
    }

}

?>

<h1>Adicionar Usuários</h1>

<a href="index.php">[Voltar]</a><br /><br />
<form method="POST">
    <label for="name">
        Nome:<br />
        <input type="text" name="name" id="name" />
    </label><br /><br />
    <label for="email">
        Email:<br />
        <input type="email" name="email" id="email" />
    </label><br /><br />
    <input type="submit" name="Gravar"/>
</form>