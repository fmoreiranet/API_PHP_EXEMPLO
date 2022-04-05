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

    public function get($id){
        try{
            $sql = "select * from usuario where id = :id";
            $dao = new DAO;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":id", $id);
            $stman->execute();
            $result = $stman->fetchALL();
            return $result;
         }catch(Exception $e){
            throw new Exception("Erro ao pegar o usuario: ". $e->getMessage());
        }
    }

    public function add(){
        try{
            $sql = "INSERT INTO usuario 
                    (id, nome, senha, data_nasc, email, fotoPerfil, tel, cpf, ativo) 
                    VALUES
                    (null, :nome, :senha, :data_nasc, :email, :foto_perfil, :tel, :cpf, :ativo)";
            $dao = new DAO;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":nome", $this->nome);
            $stman->bindParam(":senha", md5($this->senha));
            $stman->bindParam(":data_nasc", formatDateBD($this->data_nasc));
            $stman->bindParam(":email", $this->email);
            $stman->bindParam(":foto_perfil", $this->foto_perfil);
            $stman->bindParam(":tel", $this->tel);
            $stman->bindParam(":cpf", $this->cpf);
            $stman->bindParam(":ativo", $this->ativo);
            $stman->execute();            
          }catch(Exception $e){
            throw new Exception("Erro ao cadastra o usuario: ". $e->getMessage());
        }
    }

    private  function  formatDateBD($date){ // Entrada: DD/MM/YYYY -> YYYY/MM/DD
        $partDate = explode("/", $date);
        return new DateTime($partDate[2]."-". $partDate[1]."-".$partDate[0]);
    }
   
    
}