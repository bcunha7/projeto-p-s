<?php
require 'app/controllers/ClienteController.php';

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $clienteId = $_POST['id'];

    $exClientePg = new ClienteController();

    $sucesso = $exClientePg->excluirCliente($clienteId);


    echo json_encode(['sucesso' => $sucesso]);
} else {

    echo json_encode(['sucesso' => false, 'mensagem' => 'ID de cliente inválido.']);
}

