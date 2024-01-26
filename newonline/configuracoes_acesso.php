<?php
include 'menu.php';
require 'app/controllers/UsuarioController.php';

$usuarioController = new UsuarioController();
$paginaController = new PaginaController();

// Obtém $usuarios antes ou depois da submissão do formulário
$usuarios = $usuarioController->obterUsuarios();
$usu_codigo = isset($_POST['usu_codigo']) ? $_POST['usu_codigo'] : null;

if ($usu_codigo) {
    $paginas = $paginaController->consultarPermissaoPaginasPorUsuario((int)$usu_codigo);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/estilo-pesquisa.css" />
    <title>Configurações de Acesso</title>
    <script src="https://kit.fontawesome.com/6bef072b61.js" crossorigin="anonymous"></script>
    <script>
        function atualizarPermissao(pag_codigo) {
            var checkbox = document.getElementById("checkbox_" + pag_codigo);
            var usu_codigo = "<?php echo $usu_codigo; ?>";
            var valor = checkbox.checked ? 1 : 0;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "atualizar_permissao.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var resposta = JSON.parse(xhr.responseText);
                    if (!resposta.sucesso) {
                        alert("Erro ao atualizar permissão: " + resposta.mensagem);
                    }
                }
            };
            xhr.send("pag_codigo=" + pag_codigo + "&usu_codigo=" + usu_codigo + "&valor=" + valor);
        }

        function confirmarAtualizacaoPermissao(pag_codigo) {
            console.log("Início da função");
            var checkbox = document.getElementById("checkbox_" + pag_codigo);
            var usu_codigo = checkbox.getAttribute("data-usu-codigo");
            var valor = checkbox.checked ? 1 : 0;
            var confirmacao = confirm("Tem certeza de que deseja atualizar a permissão?");
            if (confirmacao) {
                atualizarPermissao(pag_codigo);
            } else {
                checkbox.checked = !checkbox.checked;
            }
        }
        
    </script>
</head>

<body>
    <div class="main-content">
        <div class="header-wrapper">
            <div class="header-title">
                <h2>Configurações</h2>
            </div>
        </div>
        <div class="header-filter">
            <h3>Permissões de página</h3>
            <br />
            <form action="" method="post" id="filtroForm">
                <label for="usu_codigo" class="label">Selecione um usuário:</label>
                <select name="usu_codigo" class="filtro-dropdown" required onchange="dropdownChanged()">
                    <?php
                    foreach ($usuarios as $opcoes) {
                        $selected = ($usu_codigo == $opcoes['value']) ? 'selected' : '';
                        echo '<option value="' . $opcoes['value'] . '" ' . $selected . '>' . $opcoes['label'] . '</option>';
                    }
                    ?>
                </select>
            </form>
        </div>

        <?php
            if (isset($paginas)) {
                ?>
                <div class="container">
                    <?php
                    // Adicione esta linha para chamar a função listarPaginas
                    $paginaController->listarPaginas((int)$usu_codigo);
                    ?>
                </div>
                <?php
            } else {
                echo 'Selecione um usuário para ver as configurações de acesso.';
            }

        ?>

        <script>
                function submitForm() {
        document.getElementById("filtroForm").submit();
    }

            // Adicione essa função para ser chamada quando o dropdown for alterado
            function dropdownChanged() {
                submitForm();
            }
        </script>
    </div>
</body>

</html>
