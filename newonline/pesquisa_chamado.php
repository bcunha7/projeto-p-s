<?php 
    include('menu.php');
    require_once 'app/controllers/ClienteController.php';
    require_once 'app/controllers/UsuarioController.php';
    require_once 'app/controllers/StatusController.php';
    require 'app/controllers/ChamadoController.php';

    $clienteController = new ClienteController();
    $clienteId = isset($_GET['pes_codigo']) ? intval($_GET['pes_codigo']) : '';

    $dadosClientes = $clienteController->obterClientes();
    
    
    $tecnicoController = new UsuarioController();
    
    $usuarios = $tecnicoController->obterUsuarios(); 
    $tecnico = $_GET['usu_codigo'] ?? '';
    $statusController = new StatusController();

    $chamadoController = new ChamadoController();
?>
<!DOCTYPE html>
    <html lang="pt-br">
        <head>
            <meta charset="utf-8">
            <link rel="stylesheet" href="public/css/estilo-pesquisa.css"/>

            <script src="https://kit.fontawesome.com/6bef072b61.js" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script>
                $(document).ready(function() {
                    $(".button-cadastrar").on("click", function() {
                        window.location.href = "cadastrar_chamado.php";
                    });
                    $(".button-filtros").on("click", function() {
                        $("#headerFilter").toggle("flex");
                    });
                });
				
                document.addEventListener('DOMContentLoaded', function () {
                var table = document.querySelector('table');
                
                table.addEventListener('click', function (e) {
                    var targetRow = e.target.closest('tr');
                    
                    if (targetRow) {
   
                        var clickedRow = table.querySelector('.table-clicked-row');
                        if (clickedRow) {
                            clickedRow.classList.remove('table-clicked-row');
                        }
                        
    
                        targetRow.classList.add('table-clicked-row');
                    }
                });

                    $(".chamado-row").on("dblclick", function() {
                        var chamadoId = $(this).data("id");
                        window.location.href = "editar_chamado.php?cha_codigo=" + chamadoId;
                    });

                    $(".edit-link").on("click", function(e) {
                        e.preventDefault();
                        var chamadoId = $(this).closest(".chamado-row").data("id");
                        window.location.href = "editar_chamado.php?cha_codigo=" + chamadoId;
                    });
                    $(".button-pesquisar").on("click", function() {
            
                        // Remover campos vazios antes de enviar o formulário
                        $("#filtroForm input, #filtroForm select").each(function() {
                            if ($(this).val() === '') {
                                $(this).prop('disabled', true);
                            }
                        });

 
                    $("#filtroForm").submit();
                });

                    $("#filtrar-button").click(function() {
                        $("#filtroForm input, #filtroForm select").each(function() {
                            if ($(this).val() === '') {
                                $(this).prop('disabled', true);
                            }
                        });

                        $("#filtroForm").submit();
                    });

                    $("#limpar-filtros-button").click(function() {
                        // Limpar valores dos campos do formulário
                        $("input[name='pesquisar']").val('');
                        $("select[name='pes_codigo']").val('');
                        $("select[name='usu_codigo']").val('');
                        $("select[name='cha_status']").val('');
                        $("#cha_dataabertura").val('');

                        // Remover classes de filtro da tabela
                        $(".chamado-row").removeClass("table-clicked-row");

                        // Atualizar a URL sem recarregar a página
                        var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
                        history.replaceState({}, document.title, newURL);

                        // Recarregar a página
                        location.reload(true);
                    });

                    document.querySelectorAll(".button-deletar").forEach(function(btn) {
                btn.addEventListener("click", function() {
                    var chamadoId = this.getAttribute("data-id");
                    var confirmacao = confirm("Tem certeza que deseja excluir o chamado?");
                    
                    if (confirmacao) {
                        // Utiliza fetch para enviar uma solicitação POST para excluir_chamado.php
                        fetch("excluir_chamado.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded",
                            },
                            body: "id=" + chamadoId,
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.sucesso) {
                                location.reload();
                            } else {
                                console.error("Erro ao excluir chamado:", data.mensagem);
                            }
                        })
                        .catch(error => console.error("Erro ao excluir chamado:", error));
                    } else {
                        // Cancelou a exclusão, não faz nada
                    }
                });
            });

        });
    </script>

            <title>Pesquisa de Chamados</title>
        </head>
        <body>
            <?php 
                $cliente = isset($_GET['pes_codigo']) ? intval($_GET['pes_codigo']) : '';
                $tecnico = isset($_GET['usu_codigo']) ? intval($_GET['usu_codigo']) : '';
                $status = isset($_GET['cha_status']) ? intval($_GET['cha_status']) : '';

            ?>
            <div class="main-content">
                <div class="header-wrapper">
                    <div class="header-title">
                        <span>Pesquisa de </span>
                        <h2>Chamados</h2>
                    </div>  
                    <div class="search-wrapper">
                        <form action="" method="GET" id="pesquisaForm" class="search-form">
                            <div class="search-bar-wrapper">
                                <input class="search-bar form-control" type="text" name="pesquisar" id="pesquisar" placeholder="Digite aqui" value="<?php if (isset($_GET['pesquisar'])) { echo $_GET['pesquisar']; } ?>">
                               <!-- <button type="button" class="button-search-limpar" id="limpar-filtros-button"><i class="fas fa-times"></i></button>-->
                            </div>
                            <button class="button-pesquisar" id="button-pesquisar"><i class="fa-solid fa-magnifying-glass" style="color: #826afb;"></i></button>
                            <!--<button class="button-filtros" id="button-filtros"><i class="fa-solid fa-filter"></i></button>-->
                        </form>
                    </div>
                        <button type="button" name="button-cadastrar" class="button-cadastrar">Cadastrar</button>
                </div>
                <div class="header-filter" id="headerFilter">
                    <h3>Filtros</h3>
                    <form action="" method="GET" id="filtroForm">
                        <label for="cha_dataabertura" class="label">Data de abertura:</label>
                        <input type="date" class="date-selector" id="cha_dataabertura" name="cha_dataabertura" placeholder="" value="<?php echo isset($_GET['cha_dataabertura']) ? $_GET['cha_dataabertura'] : ''; ?>">
                        <label for="pes_codigo" class="label">Cliente:</label>
                            <select name="pes_codigo" class="filtro-dropdown">
                                <option value="">Selecionar cliente</option> 
                                <?php foreach ($dadosClientes as $option) { ?>
                                    <option value="<?php echo $option['value'] ?>" <?php echo ($clienteId == $option['value']) ? 'selected' : ''; ?>>
                                        <?php echo $option['label'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                        
                        <label for="usu_codigo" class="label">Técnico responsável:</label>
                        <select name="usu_codigo" class="filtro-dropdown">
                            <option value="">Selecionar técnico</option> <!-- Opção em branco -->
                            <?php foreach ($usuarios as $option) : ?>
                                <option value="<?php echo $option['value'] ?>" <?php echo ($tecnico == $option['value']) ? 'selected' : ''; ?>>
                                    <?php echo $option['label'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php                  
   
                            $statusController->renderizarStatusSelect($status);
                        ?>
                        <button type="button" class="button-filtrar" id="filtrar-button">Filtrar</button>
                        <button type="button" class="button-limpar" id="limpar-filtros-button">Limpar</button>
                    </form>
                </div>
                <div class="container">
                    <?php                  
                        $chamadoController->listarChamados();
                    ?>
                </div>
            </div>
        </body>
    </html>