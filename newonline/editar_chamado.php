<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="public/css/estilo.css">
        <title>Editar chamado</title>
    </head>
    <body>
        <?php
            include 'menu.php';
            require 'app/controllers/ChamadoController.php';
            require 'app/controllers/ClienteController.php';
            require 'app/controllers/UsuarioController.php';

            $chamadoController = new ChamadoController();
            $clienteController = new ClienteController();
            $usuarioController = new UsuarioController();

            $formDados = filter_input_array(INPUT_POST, FILTER_DEFAULT) ?? [];

            
                $cha_codigo = $_GET['cha_codigo'] ?? null;
                $dados_chamado = $chamadoController->buscarChamadoPorCod($cha_codigo);

                if ($dados_chamado) {
        ?>

<div class="main-content">
            <div class="container">
                <div class="header-title">
                    <h2>Editar chamado</h2>
                </div>
                
                <form name="EditChamadoPg" action="#" class="form" method="POST">
                <table>
                        <tr>
                            <td>
                                <label for="cha_status" class="label">Status:</label>
                                <select name="cha_status" class="select-box select-dropdown">
                                    <?php
                                    $statusOptions = array(
                                        0 => "NOVO",
                                        1 => "PENDENTE SUPORTE",
                                        2 => "PENDENTE CLIENTE",
                                        3 => "FECHADO"
                                    );

                                    foreach ($statusOptions as $numero => $statusTexto) {
                                    ?>
                                        <option value="<?php echo $numero; ?>" <?php echo ($dados_chamado['cha_status'] == $numero) ? 'selected' : ''; ?>>
                                            <?php echo $statusTexto; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <div class="input-box">
                                    <label for="cha_assunto" class="label">Assunto:</label>
                                    <input type="text" id="cha_assunto" name="cha_assunto" placeholder="Assunto"
                                        value="<?php echo $dados_chamado['cha_assunto']; ?>" required>
                                </div>
                            </td>
                            <td>
                                <div class="input-box">
                                    <label for="cha_contato" class="label">Nome contato:</label>
                                    <input type="text" id="cha_contato" name="cha_contato" placeholder="Nome do contato"
                                        value="<?php echo $dados_chamado['cha_contato']; ?>" required>
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <div class="input-box">
                                    <label for="cha_email" class="label">E-mail de contato:</label>
                                    <input type="text" id="cha_email" name="cha_email" placeholder="E-mail de contato"
                                        value="<?php echo $dados_chamado['cha_email']; ?>" required>
                                </div>
                            </td>
                            <td>
                                <div class="input-box">
                                    <label for="cha_telefone" class="label">Telefone de contato:</label>
                                    <input type="text" id="cha_telefone" name="cha_telefone" placeholder="Telefone de contato"
                                        value="<?php echo $dados_chamado['cha_telefone']; ?>" required>
                                </div>
                            </td>
                            <td>
                            <div>
                                <label for="pes_codigo" class="label">Cliente:</label>
                                <?php $clienteController->renderizarClienteSelect($dados_chamado['pes_codigo'] ?? null);?>
                            </div>
                            </td>
                                    </tr>
                                    <tr>                
                            <td>
                                <div>
                                <label for="usu_codigo" class="label">Técnico responsável:</label>
                                <?php $usuarioController->renderizarTecnicoSelect($dados_chamado['usu_codigo']);?>
                                </div>
                            </td>
                            <td colspan="2">                  
                                <div class="textarea">
                                    <label for="cha_detalhes" class="label">Descrição do problema:</label><br>
                                    <textarea id="cha_detalhes" name="cha_detalhes" required><?php echo $dados_chamado['cha_detalhes']; ?></textarea>
                                </div> 
                            </td>
                        </tr>
                    </table>
                    <div class="container-agendamento">
                        <div class="checkbox">
                            <label for="cha_agendado" class="label">Agendar chamado?</label><br> 
                            <input type="checkbox" id="cha_agendado" name="cha_agendado" <?php echo ($dados_chamado['cha_agendado'] == 1) ? 'checked' : ''; ?> value="1">
                        </div>
                        <div class="input-box">
                            <label for="cha_dataagendamento" class="label">Data e hora de agendamento:</label>
                            <input type="datetime-local" id="cha_dataagendamento" name="cha_dataagendamento" value="<?php echo $dados_chamado['cha_dataagendamento']; ?>">
                        </div>
                        <div class="textarea">
                            <label for="cha_obsagendamento" class="label">Observações:</label><br>
                            <textarea id="cha_obsagendamento" name="cha_obsagendamento"><?php echo $dados_chamado['cha_obsagendamento']; ?></textarea>
                        </div> 
                    </div>
                    <button type="submit" value="Salvar" name="SendEditChamadoPg">Salvar</button>
                </form>

                <?php
                if (!empty($formDados['SendEditChamadoPg'])) {
                    $chamadoController->processarFormularioEdicaoChamado($formDados);
                }
                ?>
            </div>

            <div class="container">
                <div class="header-title">
                    <h2>Interações</h2>
                </div>
                <div class="chat-container">
                    <?php
                        if (isset($_GET['cha_codigo'])) {
                            $cha_codigo = $_GET['cha_codigo'];
                            $chamadoController->getInteracoesChamado($cha_codigo);
                        }
                    ?>
                </div>

                <form name="InteracaoChamadoPg" action="#" class="form" method="POST">
                <div class="message-input">
                    <textarea name="interacao_texto" placeholder="Digite sua mensagem" required></textarea>
                    <button type="submit" value="Enviar" name="SendInteracaoChamadoPg"><i class="fa-solid fa-paper-plane" style="color: #ffffff;"></i></button>
                </div>
                </form>
                
                <?php
                    $chamadoController->processarFormularioInteracao();
                ?>
            </div>
        </div>

        <?php
                }
            
        ?>
    </body>
</html>