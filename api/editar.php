<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' OR $_SERVER['REQUEST_METHOD'] === 'PUT') {

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/conexao.php';
    include_once 'empregados.php';

    $database = new Database();

    $db = $database->pegaConexao();

    $data = new Empregados($db);

    $dados_brutos = file_get_contents("php://input");
    $dados_decodificados = json_decode($dados_brutos, true);

    $data->id = isset($dados_decodificados['id']) ? $dados_decodificados['id'] : die();
    $data->nome = $dados_decodificados['nome'];
    $data->email = $dados_decodificados['email'];
    $data->setor = $dados_decodificados['setor'];
    $data->modificado = date('Y-m-d H:i:s');
    if ($data->updateEmpregados()) {
        echo json_encode("Empregado Atualizado.");
    } else {
        echo json_encode("Houve um erro estranho...");
    }
}else{
    http_response_code(405);
    echo json_encode("METODO NÃO AUTORIZADO");
}