<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Agendamentos</title>
        <link href="public/css/estilo-calendario.css" rel="stylesheet" type="text/css">
    </head>
    <body>	
        <?php
        include 'menu.php';
        require_once 'app/controllers/CalendarioController.php';

        $selectedYear = isset($_GET['year']) ? $_GET['year'] : date('Y');
        $calendarioController = new CalendarioController();
        
        // Exibir o calendário
        echo $calendarioController->exibirCalendario($selectedYear);
        ?>
    </body>
</html>
