<?php

require_once 'models/Usuario.php';

class UsuarioDaoMysql implements UsuarioDAO {

    private $pdo;
    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }

    public function create(Usuario $u){
        $sql = $this->pdo->prepare("INSERT INTO usuarios (name, email) VALUES (:nome, :email)");
        $sql->bindValue(':nome', $u->getName());
        $sql->bindValue(':email', $u->getEmail());
        $sql->execute();
        $u->setId($this->pdo->lastInsertId());
        return $u;
    }

    public function selectAll(){
        $array = [];
        $sql = $this->pdo->query("SELECT * FROM usuarios");
        if($sql->rowCount() > 0){
            $data = $sql->fetchAll();
            foreach($data as $item){
                $u = new Usuario();
                $u->setId($item['id']);
                $u->setName($item['name']);
                $u->setEmail($item['email']);
                $array[] = $u;
            }
        }
        return $array;
    }

    public function selectById($id){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount() > 0){
            $data  = $sql->fetch();
            $u = new Usuario();
            $u->setId($data['id']);
            $u->setName($data['name']);
            $u->setEmail($data['email']);
            return $u;
        }else{
            return false;
        }
    }

    public function selectByEmail($e){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(':email', $e);
        $sql->execute();
        if($sql->rowCount() > 0){
            $data  = $sql->fetch();
            $u = new Usuario();
            $u->setId($data['id']);
            $u->setName($data['name']);
            $u->setEmail($data['email']);
            return $u;
        }else{
            return false;
        }
    }

    public function update(Usuario $u){
        $sql = $this->pdo->prepare("UPDATE usuarios SET name = :name, email = :email WHERE id = :id");
        $sql->bindValue(':name', $u->getName());
        $sql->bindValue(':email', $u->getEmail());
        $sql->bindValue(':id', $u->getId());
        $sql->execute();
        return true;
    }

    public function remove($id){
        $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}