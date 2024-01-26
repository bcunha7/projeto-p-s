<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuário</title>
</head>
<body>
    <div class="main-content">
        <div class="container">
            <div class="header-title">
                <h2>Editar Usuário</h2>
            </div>
            <form name="EditUsuarioPg" action="#" class="form" method="POST">
                    <div class="input-box">    
                        <label>Nome: </label>
                        <input type="text" name="usu_nome" placeholder="Nome do usuario" value="<?php echo $dados_usuario['usu_nome']; ?>" required>
                    </div>
                    <div class="input-box">
                        <label>E-mail: </label>
                        <input type="text" name="usu_email" placeholder="E-mail do usuario" value="<?php echo $dados_usuario['usu_email']; ?>" required>
                    </div>
                    <div class="input-box">
                        <label>Senha: </label>
                        <input type="password" id="senha" name="usu_senha" placeholder="Senha do usuario" value="<?php echo $dados_usuario['usu_senha']; ?>" required>
                        <i class="bi bi-eye-fill" id="btn-senha" onclick="mostrarSenha()"></i>
                    </div>
                    <button type="submit" value="Salvar" name="SendEditUsuarioPg">Salvar</button>
                </form>
        </div>
    </div>
</body>
</html>
