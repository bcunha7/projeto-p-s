<?php
include 'menu.php';
require 'app/controllers/ClienteController.php';

$clienteController = new ClienteController();

if (isset($_GET['pes_codigo'])) {
    $pes_codigo = $_GET['pes_codigo'];
    $dados_cliente = $clienteController->buscarClientePorCod($pes_codigo);
    if ($dados_cliente) {
        include 'formulario_editar_cliente.php';
    } else {
        echo "Cliente não encontrado.";
    }
} else {
    echo "ID do cliente não especificado.";
}

$formDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($formDados['SendEditClientePg'])) {
    $valor = $clienteController->editarCliente($pes_codigo);
    if ($valor) {
        echo "<script>alert('Cliente editado com sucesso!'); window.location.href='pesquisa_cliente.php';</script>";
    } else {
        echo "<script>alert('Erro: Falha ao editar cliente!');</script>";
    }
}