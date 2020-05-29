<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);
$lista = $usuarioDao->selectAll();
?>

<a href="adicionar.php">[Adicionar Usuário]</a>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($lista as $u){
            echo '<tr>
                <td>'.$u->getId().'</td>
                <td>'.$u->getName().'</td>
                <td>'.$u->getEmail().'</td>
                <td><a href="editar.php?id='.$u->getId().'">[Editar]</a><a href="excluir.php?id='.$u->getId().'" onclick="return confirm(\'Tem certeza que deseja excluir?\')">[Excluir]</a></td>
            </tr>';
        }?>
    </tbody>
</table>