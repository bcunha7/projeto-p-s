<?php
require 'app/controllers/ChamadoController.php';

    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $usuarioId = $_POST['id'];

    $chamadoController = new ChamadoController();

    $sucesso = $chamadoController->excluirChamado($chamadoId);

    echo json_encode(['sucesso' => $sucesso]);
} else {

    echo json_encode(['sucesso' => false, 'mensagem' => 'ID de cliente inválido.']);
}