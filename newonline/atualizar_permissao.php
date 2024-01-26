<?php
require 'app/models/Conexao.php';
require 'app/controllers/PaginaController.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pag_codigo = $_POST['pag_codigo'];
    $usu_codigo = $_POST['usu_codigo'];
    $valor = $_POST['valor'];
    echo "pag_codigo: $pag_codigo, usu_codigo: $usu_codigo, valor: $valor";

    $exPermissaoPg = new PaginaController();

    $sucesso = $exPermissaoPg->editarPermissao($pag_codigo, $usu_codigo, $valor);

    if ($sucesso) {
        echo json_encode(['sucesso' => true]);
    } else {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao editar permissão no banco de dados.']);
    }
} else {
    // Resposta inválida
    echo json_encode(['sucesso' => false, 'mensagem' => 'Método de requisição inválido']);
}
