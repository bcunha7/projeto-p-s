<!DOCTYPE html>
<html lang="pt-br">
    <head>
    <meta charset="UTF-8">
        <link rel="stylesheet" href="public/css/estilo-grafico.css"/>
        <link rel="stylesheet" href="public/css/estilo-pesquisa.css"/>
        <script src="https://kit.fontawesome.com/6bef072b61.js" crossorigin="anonymous"></script>
        
        <title>Indicadores</title>

    </head>
    <body>
        <?php 
            include 'menu.php';
            require 'app/models/ChamadoModel.php';
            require 'app/views/Calendario.php';

            $calendario = new Calendario();
            $chamadoModel = new ChamadoModel();

            $selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('n'); // Valor padrão: mês atual
            $selectedYear = isset($_GET['year']) ? $_GET['year'] : date('Y'); // Valor padrão: ano atual
            $selectedYear2 = isset($_GET['year2']) ? $_GET['year2'] : date('Y'); // Valor padrão: ano atual
            // Lógica para obter os dados do modelo
            $totalChamados = $chamadoModel->getTotalChamados($selectedYear, $selectedMonth);
            $totalAgendados = $chamadoModel->getChamadosAgendados($selectedYear, $selectedMonth);
            $totalChamados = $chamadoModel->getTotalChamados($selectedYear, $selectedMonth);
            $totalAgendados = $chamadoModel->getChamadosAgendados($selectedYear, $selectedMonth);
            $totalAbertos = $chamadoModel->getChamadosAbertos($selectedYear, $selectedMonth);
            $totalFechados = $chamadoModel->getChamadosFechados($selectedYear, $selectedMonth);
            $totalAndamento = $chamadoModel->getChamadosAndamento($selectedYear, $selectedMonth);
            // Restante do código HTML
        ?> 
    
        <div class="main-content">
            <div class="header-wrapper">
                <div class="header-title">
                    <h2>Indicadores</h2>
                </div>
            </div>
                <div class="card-container">
                <h3 class="main-title">Contadores</h3>
                    <div class="month-year-filter">
                    <label>Mês:</label>
                    <select id="monthSelect" class="filtro-dropdown">
                        <?php foreach ($chamadoModel->getMeses() as $mes) : ?>
                            <option value="<?php echo $mes['valor']; ?>" <?php echo ($mes['valor'] == $selectedMonth) ? 'selected' : ''; ?>>
                                <?php echo $mes['nome']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label>Ano:</label>
                    <select id="yearSelect" class="filtro-dropdown">
                        <?php foreach ($chamadoModel->getAnos() as $ano) : ?>
                            <option value="<?php echo $ano['valor']; ?>"  <?php echo ($ano['valor'] == $selectedYear) ? 'selected' : ''; ?>>
                                <?php echo $ano['valor']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button id="applyFiltersButton" type="button">Aplicar filtro</button>
                        </div>
                        <br/>
                <div class="card-wrapper">
                    <div class="total-card light-red">
                        <div class="card-header">
                            <div class="total">
                                <span class="title"> Total de chamados </span>
                                <span class="cont-total"><?= $totalChamados ?></span>
                            </div>        
                        </div>
                    </div>
                    <div class="total-card light-purple">
                        <div class="card-header">
                            <div class="total">
                                <span class="title"> Chamados abertos </span>
                                <span class="cont-total"> <?= $totalAbertos ?></span>
                            </div>        
                        </div>
                    </div>
                    <div class="total-card light-green">
                        <div class="card-header">
                            <div class="total">
                                <span class="title"> Chamados em andamento </span>
                                <span class="cont-total"> <?= $totalAndamento ?> </span>
                            </div>        
                        </div>
                    </div>
                    <div class="total-card light-blue">
                        <div class="card-header">
                            <div class="total">
                                <span class="title">Chamados fechados </span>
                                <span class="cont-total"> <?= $totalFechados ?> </span>
                            </div>        
                        </div>
                    </div>
                    <div class="total-card light-yellow">
                        <div class="card-header">
                            <div class="total">
                                <span class="title"> Chamados agendados </span>
                                <span class="cont-total"><?= $totalAgendados ?> </span>
                            </div>        
                        </div>
                    </div>   
                </div>
            </div>
                <?php
                    $availableYears = $chamadoModel->getAvailableYears($selectedYear2);
                    ?>
                    <div class="graph-wrapper">
                        <h3 class="main-title"> Gráfico em barras do ano de 
                            <select class="select-ano-graph" name="year2" id="selectAnoGraph">
                                <?php foreach ($availableYears as $year): ?>
                                    <option value="<?= $year['value'] ?>" <?= $year['selected'] ?>><?= $year['value'] ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </h3>
                        <div class="graph-container">
                            <?php include 'app/views/GraphView.php'; ?>
                        </div>
                    </div>       
            </div>
                    <scrip src="public/js/indicadores.js"></script>  
                    <script>
                    // Aplicar filtros ao clicar no botão
                    document.getElementById('applyFiltersButton').addEventListener('click', function() {
                        var selectedMonth = document.getElementById('monthSelect').value;
                        var selectedYear = document.getElementById('yearSelect').value;

                        // Aqui você pode realizar a ação desejada, por exemplo, redirecionar para a página com os parâmetros selecionados
                        window.location.href = '?year=' + selectedYear + '&month=' + selectedMonth;
                    });

                    // Mudança no seletor de ano do gráfico
                    document.getElementById('selectAnoGraph').addEventListener('change', function() {
                        var selectedYear2 = this.value;
                        window.location.href = '?year2=' + selectedYear2;
                        // Recarregar a página após a mudança de URL
                    });
    </script>
    </body>
</html>
