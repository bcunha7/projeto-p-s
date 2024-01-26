<?php
    include 'menu.php';
    require_once 'app/controllers/ClienteController.php';
    $cliente = new ClienteController();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="public/css/estilo-pesquisa.css"/>
        <script src="https://kit.fontawesome.com/6bef072b61.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $(".button-cadastrar").on("click", function() {
                    window.location.href = "cadastrar_cliente.php";
                });

                $(".cliente-row").on("click", function() {
                    $(".cliente-row").removeClass("table-clicked-row");
                    $(this).addClass("table-clicked-row");
                });

                $(".cliente-row").on("dblclick", function() {
                    var clienteId = $(this).data("id");
                    window.location.href = "editar_cliente.php?pes_codigo=" + clienteId;
                });

                $(".edit-link").on("click", function(e) {
                    e.preventDefault();
                    var clienteId = $(this).closest(".cliente-row").data("id");
                    window.location.href = "editar_cliente.php?pes_codigo=" + clienteId;
                });

                $(".button-pesquisar").on("click", function() {
       
                    $("#filtroForm input, #filtroForm select").each(function() {
                        if ($(this).val() === '') {
                            $(this).prop('disabled', true);
                        }
                    });

          
                    $("#filtroForm").submit();
                });

                $("#filtrar-button").click(function() {
                  
                    $("#filtroForm").submit();
                });

                $("#limpar-filtros-button").click(function() {
               
                    $("input[name='pesquisar']").val('');

               
                    $(".cliente-row").removeClass("table-clicked-row");
                    
                  
                        var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
                        history.replaceState({}, document.title, newURL);

                       
                        location.reload(true);
                });

                document.querySelectorAll(".button-deletar").forEach(function(btn) {
                    btn.addEventListener("click", function() {
                        var clienteId = this.getAttribute("data-id");
                        var confirmacao = confirm("Tem certeza que deseja excluir esse cliente?");

                        if (confirmacao) {
                            fetch("excluir_cliente.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded",
                                },
                                body: "id=" + clienteId
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.sucesso) {
                                    location.reload();
                                } else {
                                    console.error("Erro ao excluir cliente:", data.mensagem);
                                }
                            })
                            .catch(error => console.error("Erro ao excluir cliente:", error));
                        } else {
                  
                        }
                    });
                });
            });
        </script>
        <title>Clientes</title>
    </head>
    <body>
        <div class="main-content">
            <div class="header-wrapper">
                <div class="header-title">
                    <span>Pesquisa de </span>
                    <h2>Clientes</h2>
                </div>
                <div class="search-wrapper">
                    <form action="" method="GET" id="pesquisaForm" class="search-form">                 
                        <div class="search-bar-wrapper">    
                            <input class="search-bar" type="text" name="pesquisar" class="form-control" placeholder="Digite aqui" value="<?php if (isset($_GET['pesquisar'])) { echo $_GET['pesquisar']; } ?>">
                            <button type="button" class="button-search-limpar" id="limpar-filtros-button"><i class="fas fa-times"></i></button>
                        </div>
                        <button class="button-pesquisar" id="button-pesquisar"><i class="fa-solid fa-magnifying-glass" style="color: #826afb;"></i></button>
                    </form>
                </div>        
                <button type="button" name="button-cadastrar" class="button-cadastrar">Cadastrar</button>
            </div>
            <div class="tabela-wrapper">
                <h3 class="main-title">  </h3>
                <div class="container">
                    <div class="tabela-container">
                        <?php $cliente->listarCliente() ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
