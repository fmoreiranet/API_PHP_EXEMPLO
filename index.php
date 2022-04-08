<?php
include_once "./config/config.php";

require_once "./app/services/DAO.php";
require_once "./app/models/usuario.php";
require_once "./app/controller/usuarioController.php";

//phpinfo();
try {
    if (count($_REQUEST) == 0) throw new Exception();

    $method = $_SERVER["REQUEST_METHOD"];

    $url = explode("/", $_GET["url"]);
    //localhost/api/usuario/list
    //localhost/api/usuario/get/1
    //var_dump($url);

    $result = null;
    //Pesquisa
    if ($method == "GET") {
        header("Content-Type: application/json; charset=UTF-8");

        switch ($url[0]) {
            case "usuario":
                switch ($url[1]) {
                    case "get": {
                            if (!isset($url[2])) throw new Exception();
                            $userController = new usuarioController;
                            $result = $userController->get($url[2]);
                        }
                        break;

                    case "list": {
                            $userController = new usuarioController;
                            $result = $userController->getAll();
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
    if ($method == "POST") {
        header("Content-Type: application/json; charset=UTF-8");
        switch ($url[0]) {
            case "usuario":
                switch ($url[1]) {
                    case "add": {
                            $dadosUser = json_decode(file_get_contents('php://input')); //tranformar JSON do body em Objetos
                            $user = new Usuario;
                            //Popular o objeto usuario ($dadosUser para $user)
                            $user->nome = $dadosUser->nome;   // "nome": "Silvia Cristina",
                            $user->email = $dadosUser->email; // "email": "sc@email.com",
                            $user->senha = $dadosUser->senha; // "senha": "123@123",
                            $user->data_nasc = $dadosUser->data_nasc; // "data_nasc": "12/05/2010",
                            $user->id = $dadosUser->id; //"id": null,
                            $user->foto_perfil = $dadosUser->foto_perfil; // "foto_perfil": "",
                            $user->tel = $dadosUser->tel;   // "tel": "5555-666666",
                            $user->cpf = $dadosUser->cpf;   // "cpf": "12312312344",
                            $user->ativo = $dadosUser->ativo; // "ativo": 1                                         
                            var_dump($user);
                            $userController = new usuarioController;
                            $result = $userController->add($user);
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
        //echo "Entra de um POST";
        echo json_encode($result);
    }
} catch (Exception $e) {
    http_response_code(404);
    echo json_encode(array("mensagem" => "Pagina não encontrada!"));
}
