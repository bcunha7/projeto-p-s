<?php
    include 'menu.php';
    include 'app/controllers/UsuarioController.php';

    $usuarioController = new UsuarioController();

    $formDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($formDados) {
        $usuarioController->processarCadastro($formDados);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de usuário</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="main-content">
            <div class="container">
                <div class="header-title">
                    <h2>Cadastro de Usuário</h2>
                </div>
                <form name="CadUsuarioPg" action="" class="form" method="POST">
                    <div class="input-box">    
                        <label>Nome: </label>
                        <input type="text" name="usu_nome" placeholder="Nome do usuario" required><br><br>
                    </div>
                        <div class="input-box">
                        <label>E-mail: </label>
                        <input type="text" name="usu_email" placeholder="E-mail do usuario" required><br><br>
                    </div>
                    <div class="input-box">
                        <label>Senha: </label>
                        <input type="password" id="senha" name="usu_senha" placeholder="Senha do usuario" required><br><br>
                        <i class="bi bi-eye-fill" id="btn-senha" onclick="mostrarSenha()"></i>
                    </div>
                    <button type="submit" value="Cadastrar" name="SendCadUsuarioPg">Cadastrar</button>
                </form>
            </div>
        </div> 
    </body>
</html>