<?php
include_once "./config/config.php";

require_once "./app/services/DAO.php";
require_once "./app/models/usuario.php";

//phpinfo();
 try{     
    if (count($_REQUEST) == 0) throw new Exception();
     
    $method = $_SERVER["REQUEST_METHOD"];
    
    $url = explode("/", $_GET["url"]);
    //localhost/api/usuario/list
    //localhost/api/usuario/get/1
    //var_dump($url);

    //Pesquisa
    if ($method == "GET"){      
        header("Content-Type: application/json; charset=UTF-8");   
        $result = null;

        switch ($url[0]) {
            case "usuario":
                switch($url[1]){
                    case "get":{
                        if(!isset($url[2])) throw new Exception();
                        $user = new Usuario;
                        $result = $user->get($url[2]);
                    }
                    break;

                    case "list":{
                        $user = new Usuario;
                        $result = $user->getAll();
                    }
                    break;

                    default:
                        throw new Exception();
                    break;
                }
            break;

            case "produto":
            break;
            
            default:
                throw new Exception();
            break;
        }

        http_response_code(200);
        echo json_encode($result);
    }

    //Cadastros e Atualizações
    if ($method == "POST"){ 
        header("Content-Type: application/json; charset=UTF-8");
        switch ($url[0]) {
            case "usuario":
                switch ($url[1]){
                    case "add":{
                        $dadosUser = json_encode(file_get_contents('php://input'));
                        var_dump($dadosUser);
                        $user = new Usuario;
                        var_dump($user);
                        //$result = $user->add();
                    }
                    break;

                    default:
                        throw new Exception();
                    break;
                }
            break;
            
            default:
                throw new Exception();
            break;
        }
        
        http_response_code(200);
        echo "Entra de um POST";
    }

} catch(Exception $e){
    http_response_code(404);
    echo json_encode(array("mensagem" => "Pagina não encontrada!"));
}


