<?php
include 'menu.php';
require 'app/controllers/UsuarioController.php';

$usuarioController = new UsuarioController();

if (isset($_GET['usu_codigo'])) {
    $usu_codigo = $_GET['usu_codigo'];
    $dados_usuario = $usuarioController->buscarUsuarioPorCod($usu_codigo);
    if ($dados_usuario) {
        include 'formulario_editar_usuario.php';
    } else {
        echo "Usuário não encontrado.";
    }
} else {
    echo "ID do usuário não especificado.";
}

$formDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($formDados['SendEditUsuarioPg'])) {
    $valor = $usuarioController->editarUsuario($usu_codigo);
    if ($valor) {
        echo "<script>alert('Usuário editado com sucesso!'); window.location.href='pesquisa_usuario.php';</script>";
    } else {
        echo "<script>alert('Erro: Falha ao editar usuário!');</script>";
    }
}

