<?php

 //$nome = "Fabiano Moreira";
 //echo "<h2>$nome</h2>";
 //echo '<h2>$nome</h2>';
 //phpinfo();
 
 try{     
    if (count($_REQUEST) == 0) throw new Exception();
     
    $method = $_SERVER["REQUEST_METHOD"];

    if ($method == "GET"){ //Pesquisa
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


