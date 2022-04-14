  
<?php

function generateJWT($dados)
{
    //Application Key
    $key = "ff08e69475562803be134abe13fbd09f27356cfd14944353e789a9afa4661a70"; // loja - exemplo

    //Header Token
    $header = [
        'typ' => 'JWT',
        'alg' => 'HS256'
    ];

    //Payload - Content
    $payload = [
        'exp' => (new DateTime("now"))->getTimestamp(),
        'uid' => $dados->id,
        'email' => $dados->email,
    ];

    //JSON
    $header = json_encode($header);
    $payload = json_encode($payload);

    //Base 64
    $header = base64_encode($header);
    $payload = base64_encode($payload);

    //Sign
    $sign = hash_hmac('sha256', $header . "." . $payload, $key, true);
    $sign = base64_encode($sign);

    //Token
    $token = $header . '.' . $payload . '.' . $sign;

    return $token;
}

function valideJWT($token)
{
    $key = "ff08e69475562803be134abe13fbd09f27356cfd14944353e789a9afa4661a70";

    $token =  str_replace(["Bearer", " "], "", $token);

    $partes = explode(".", $token);

    $header = $partes[0];
    $payload = $partes[1];
    $sign = $partes[2];

    $signVerfi = base64_encode(hash_hmac('sha256', $header . "." . $payload, $key, true));

    if ($sign === $signVerfi) {
        //$header = json_encode(base64_decode($header));
        $payload = json_encode(base64_decode($payload));
        return $payload;
    }
    return false;
}
