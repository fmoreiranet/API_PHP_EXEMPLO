<?php
class Usuario
{
    public $id;
    public $nome;
    public $senha;
    public $data_nasc;
    public $email;
    public $foto_perfil;
    public $tel;
    public $cpf;
    public $ativo;

    public function getAll(){
        try{
            $dao = new DAO;
            $sql = "select * from usuario";
            $conn = $dao->conecta();
            $stman = $conn->prepare($sql);
            //$stman = $dao->conecta()->prepare($sql);
            $stman-> execute();
            $result = $stman->fetchAll();
            return $result;
        }catch(Exception $e){
            throw new Exception("Erro ao listar os usuarios: ". $e->getMessage());
        }
    } 

}