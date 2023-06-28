<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
    $dataInput = json_decode(file_get_contents('php://input'), true);

    $data->nome = $dataInput['nome'];
    $data->email = $dataInput['email'];
    $data->setor = $dataInput['setor'];
    $data->criado = date('Y-m-d H:i:s');
    if ($data->createEmpregados()) {
        echo 'Empregado Cadastrado com sucesso.';
    } else {
        echo 'Houve algum erro estranho...';
    }
}else{
    http_response_code(405);
    echo json_encode("METODO NÃO AUTORIZADO");
}