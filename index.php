<?php
include_once "./config/config.php";
//require_once "./config/config.php";

//phpinfo();
 try{     
    if (count($_REQUEST) == 0) throw new Exception();
     
    $method = $_SERVER["REQUEST_METHOD"];

    if ($method == "GET"){ //Pesquisa
        $url = explode("/", $_GET["url"]);
        //localhost/api/usuario/list
        var_dump($url);

        switch ($url[0]) {
            case "usuario":
                switch($url[1]){
                    case "list":{

                    }
                }
            break;

            case "produto":
            break;
            
            default:
                throw new Exception();
            break;
        }



        http_response_code(200);
        echo "Entrada de um GET";
    }

    if ($method == "POST"){ //Cadastros e Atualizações
        http_response_code(200);
        echo "Entra de um POST";
    }

} catch(Exception $e){
    http_response_code(404);
    echo json_encode(array("mensagem" => "Pagina não encontrada!"));
}


