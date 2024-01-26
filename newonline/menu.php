<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/estilo.css"/>
    <script src="https://kit.fontawesome.com/6bef072b61.js" crossorigin="anonymous"></script>
    <?php
    require 'app/models/Conexao.php';
    require 'app/controllers/PaginaController.php';
    
    session_start();
    if (isset($_SESSION['usu_codigo'])) {
        $usu_codigo = $_SESSION['usu_codigo'];
        $pagina = new PaginaController();
        $paginasUsuario = $pagina->consultarPermissoes($usu_codigo);
        $_SESSION['permissoesUsuario'] = $paginasUsuario;
    
     
        $paginasMapeadas = [
            'Home' => ['url' => 'index.php', 'icone' => 'fa-house'],
            'Chamados' => ['url' => 'pesquisa_chamado.php', 'icone' => 'fa-ticket'],
            'Clientes' => ['url' => 'pesquisa_cliente.php', 'icone' => 'fa-people-group'],
            'Usuários' => ['url' => 'pesquisa_usuario.php', 'icone' => 'fa-user'],
            'Agendamentos' => ['url' => 'agendamentos.php', 'icone' => 'fa-calendar'],
            'Indicadores' => ['url' => 'indicadores.php', 'icone' => 'fa-gauge'],
            'Configurações' => ['url' => 'configuracoes_acesso.php', 'icone' => 'fa-gear'],
        ];
    } else {
   
        header('Location: /index.php');
        exit();
    }
    ?>
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <?php foreach ($paginasMapeadas as $nomePagina => $dadosPagina): ?>
                <?php if (in_array($nomePagina, $paginasUsuario, true)): ?>
                    <li class="item-menu">
                        <a href="<?php echo $dadosPagina['url']; ?>">
                            <i class="fa-solid <?php echo $dadosPagina['icone']; ?>" style="color: #ffffff;"></i>
                            <span><?php echo $nomePagina; ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>

            <li class="logout">
                <a href="app/controllers/LogoutController.php">
                    <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                    <span class="txt-link">Sair</span>
                </a>
            </li>
        </ul>
    </div>
</body>
</html>
