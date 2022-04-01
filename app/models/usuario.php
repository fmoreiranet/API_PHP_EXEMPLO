<?php

require_once "./../services/DAO.php";

class Usuario()
{
    public id;
    public nome;
    public senha;
    public data_nasc;
    public email;
    public foto_perfil;
    public tel;
    public cpf;
    public ativo;

    public function getAll(){
        $dao = new DAO;
        $conn = $dao->conecta();
        $sql = "select * from usuario";
        $stman = $conn->prepare($sql);
        $stman-> execute();
        $result = $stman->fetchAll();
        return $result;
    } 

}