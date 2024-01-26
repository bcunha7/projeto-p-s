<?php
    include 'menu.php';
    require 'app/controllers/ClienteController.php';
    require 'app/controllers/UsuarioController.php';
    include 'app/controllers/ChamadoController.php';

    $chamadoController = new ChamadoController();

    $formDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($formDados) {
        $chamadoController->processarCadastro($formDados);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de chamado</title>
</head>
<body>
    <div class="main-content">
        <div class="container">
            <div class="header-title">
                <h2>Abertura de chamado</h2>
                </div>       
                <form name="CadChamadoPg" action="" class="form" method="POST">
                    <table>
                        <tr>
                            <td>
                                <div class="input-box">
                                    <label for="cha_assunto" class="label">Assunto:</label>
                                    <input type="text" id="cha_assunto" name="cha_assunto" placeholder="Assunto" required>
                                </div>
                            </td>
                            <td>
                                <div class="input-box">
                                    <label for="cha_contato" class="label">Nome contato:</label>
                                    <input type="text" id="cha_contato" name="cha_contato" placeholder="Nome do contato" required>
                                </div>
                            </td>
                            <td>
                                <div class="input-box">
                                    <label for="cha_email" class="label">E-mail de contato:</label>
                                    <input type="text" id="cha_email" name="cha_email" placeholder="E-mail de contato" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-box">
                                    <label for="cha_telefone" class="label">Telefone de contato:</label>
                                    <input type="text" id="cha_telefone" name="cha_telefone" placeholder="Telefone de contato" required>
                                </div>
                            </td>              
                            <td>
                            <label for="pes_codigo" class="label">Cliente:</label>
                                <?php       
                                    $clienteController = new ClienteController();
                                    $cliente = $_GET['pes_codigo'] ?? '';
                                    $clienteController->renderizarClienteSelect($cliente);
                                ?>
                            </td>
                            <td>
                            <label for="usu_codigo" class="label">Técnico responsável:</label>
                                <?php                  
                                    $tecnicoController = new UsuarioController();
                                    $tecnico = $_GET['usu_codigo'] ?? '';
                                    $tecnicoController->renderizarTecnicoSelect($tecnico);
                                ?>
                            </td>
                        </tr>
                        <tr> 
                            <td colspan="2">                  
                                <div class="textarea">
                                    <label for="cha_detalhes" class="label">Descrição do problema:</label><br>
                                    <textarea id="cha_detalhes" name="cha_detalhes" required></textarea>
                                </div> 
                            </td>
                        </tr>
                        </table>

                        <div class="container-agendamento">

                            <div class="checkbox">
                                <label for="cha_agendado" class="label">Agendar chamado?</label><br> 
                                <input type="checkbox" id="cha_agendado" name="cha_agendado">
                            </div>

                            <div class="input-box">
                                <label for="cha_dataagendamento" class="label">Data e hora de agendamento:</label>
                                <input type="datetime-local" id="cha_dataagendamento" name="cha_dataagendamento">
                            </div>

                            <div class="textarea">
                                <label for="cha_obsagendamento" class="label">Observações:</label><br>
                                <textarea id="cha_obsagendamento" name="cha_obsagendamento" ></textarea>
                            </div> 

                        </div>
                        <button type="submit" value="Cadastrar" name="SendCadChamadoPg">Abrir chamado</button>

                </form>      
            </div>
        </div>    
    </body>
</html>