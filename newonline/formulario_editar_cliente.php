<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cliente</title>
</head>
<body>
    <div class="main-content">
        <div class="container">
            <div class="header-title">
                <h2>Editar cliente</h2>
            </div>
            <form name="EditClientePg" action="#" class="form" method="POST">
                    <table>
                        <tr>
                            <td>
                                <div class="input-box"> 
                                    <label class="label">Razão social: </label>
                                    <input type="text" id="pes_razao" name="pes_razao" placeholder="Razão social da empresa" value="<?php echo $dados_cliente['pes_razao']; ?>" required>
                                </div>
                            </td>
                            <td>
                                <div class="input-box"> 
                                    <label class="label">Nome fantasia: </label>
                                    <input type="text" id="pes_fantasia" name="pes_fantasia" placeholder="Nome fantasia da empresa" value="<?php echo $dados_cliente['pes_fantasia']; ?>" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-box"> 
                                    <label class="label">CNPJ/CPF: </label>
                                    <input type="text" id="pes_cpfcnpj" name="pes_cpfcnpj" placeholder="CNPJ ou CPF da empresa" value="<?php echo $dados_cliente['pes_cpfcnpj']; ?>" required>
                                </div>
                            </td>                       
                            <td>
                            <label class="label">Tipo pessoa: </label>
                            <select name="pes_tipopessoa" class="select-box select-dropdown" required>
                                <option value="Pessoa física" <?php echo ($dados_cliente['pes_tipopessoa'] == 'Pessoa física') ? 'selected' : ''; ?>> Pessoa física</option>
                                <option value="Pessoa jurídica" <?php echo ($dados_cliente['pes_tipopessoa'] == 'Pessoa jurídica') ? 'selected' : ''; ?>> Pessoa jurídica</option>
                            </select>

                            </td>
                        </tr>
                        <tr>
                            <td>                  
                                <div class="textarea">
                                    <label for="pes_observacao" class="label">Observações:</label>
                                    <textarea id="pes_observacao" name="pes_observacao" required><?php echo $dados_cliente['pes_observacao']; ?></textarea>
                                </div> 
                            </td>
                        </tr>
                    </table>
                    <button type="submit" value="Salvar" name="SendEditClientePg">Salvar</button>
                </form>
                </div>
    </div>
</body>
</html>
