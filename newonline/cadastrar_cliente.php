<?php
    include 'menu.php';
    include 'app/controllers/ClienteController.php';

    $clienteController = new ClienteController();

    $formDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($formDados) {
        $clienteController->processarCadastro($formDados);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de cliente</title>
    </head>
    <body>
        <div class="main-content">
            <div class="container">
                <div class="header-title">
                    <h2>Cadastro de Cliente</h2>
                </div>
                <form name="CadClientePg" action="" class="form" method="POST">
                    <table>
                        <tr>
                            <td>
                                <div class="input-box"> 
                                    <label class="label">Razão social: </label>
                                    <input type="text" id="pes_razao" name="pes_razao" placeholder="Razão social da empresa" required>
                                </div>
                            </td>
                            <td>
                                <div class="input-box"> 
                                    <label class="label">Nome fantasia: </label>
                                    <input type="text" id="pes_fantasia" name="pes_fantasia" placeholder="Nome fantasia da empresa" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-box"> 
                                    <label class="label">CNPJ/CPF: </label>
                                    <input type="text" id="pes_cpfcnpj" name="pes_cpfcnpj" placeholder="CNPJ ou CPF da empresa" required>
                                </div>
                            </td>                       
                            <td>
                                <label class="label">Tipo pessoa: </label>
                                <select name="pes_tipopessoa" class="select-box select-dropdown" required>
                                    <option value="Pessoa física"> Pessoa fisica</option>
                                    <option value="Pessoa jurídica"> Pessoa juridica</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>                  
                                <div class="textarea">
                                    <label for="pes_observacao" class="label">Observações:</label>
                                    <textarea id="pes_observacao" name="pes_observacao" required></textarea>
                                </div> 
                            </td>
                        </tr>
                    </table>
                    <button type="submit" value="Cadastrar" name="SendCadClientePg">Cadastrar</button>
            </form>                       
            </div>
        </div> 
    </body>
</html>
