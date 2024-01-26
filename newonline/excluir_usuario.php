<?php
    require 'app/controllers/UsuarioController.php';

    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $usuarioId = $_POST['id'];
        
        $exUsuarioPg = new UsuarioController();
        $sucesso = $exUsuarioPg->excluirPermissaoPaginasPorUsuario($usuarioId);

        
        $sucesso = $exUsuarioPg->excluirUsuario($usuarioId);


        echo json_encode(['sucesso' => $sucesso]);
    } 
    else {
 
        echo json_encode(['sucesso' => false, 'mensagem' => 'ID de usuário inválido.']);
    }

