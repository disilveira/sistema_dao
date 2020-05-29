<?php

class Usuario {

    private $id;
    private $name;
    private $email;

    public function getId(){
        return $this->id;
    }

    public function setId($i){
        $this->id = trim($i);
    }

    public function getName(){
        return $this->name;
    }

    public function setName($n){
        $this->name = ucwords(trim($n));
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($e){
        $this->email = strtolower(trim($e));
    }

}

interface UsuarioDAO {
    public function create(Usuario $u);
    public function selectAll();
    public function selectById($id);
    public function selectByEmail($e);
    public function update(Usuario $u);
    public function remove($id);
}