<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calendário Anual</title>
<style>
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
    }
    .calendar-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: calc(100% - 80px); /* Ajuste a altura do container para deixar espaço para os botões */
    }
    .calendar {
        display: none;
        width: 70%; /* Largura da tabela */
        margin-bottom: 20px;
    }
    .visible {
        display: block;
    }
    .navigation {
        text-align: center;
        margin-top: 20px;
    }
    .navigation button {
        margin: 0 10px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        text-align: center;
    }
    .month-name {
        font-size: 24px;
        margin-bottom: 10px;
    }
</style>
</head>
<body>

<div class="calendar-container">
    <?php
    
    require_once '../classes/calendario.php';
    
    // Define o ano atual
    $anoAtual = date('Y');
    echo '<h2>' . $anoAtual . '</h2>';
    
    // Loop pelos meses do ano
    for ($month = 1; $month <= 12; $month++) {
        // Cria uma instância da classe Calendario para o mês atual e o ano atual
        $calendario = new Calendario($month, $anoAtual);
        
        // Obtém o calendário formatado em HTML para o mês atual
        $htmlCalendar = $calendario->gerarHTML();
    
        // Exibe o ano
       
    
        // Exibe o calendário para o mês atual e o ano atual
        echo '<div class="calendar">' . $htmlCalendar . '</div>';
    }
   
    
    ?>
</div>

<div class="navigation">
    <button id="prevMonth">Mês Anterior</button>
    <button id="nextMonth">Próximo Mês</button>
</div>

<script>
   document.addEventListener("DOMContentLoaded", function() {
    const calendars = document.querySelectorAll('.calendar');
    let currentMonthIndex = 0;
    let currentYear = 2024;

    // Exibe o calendário atual
    function showCurrentMonth() {
        for (let i = 0; i < calendars.length; i++) {
            if (i === currentMonthIndex) {
                calendars[i].classList.add('visible');
            } else {
                calendars[i].classList.remove('visible');
            }
        }
    }

    // Mostra o mês anterior
    document.getElementById('prevMonth').addEventListener('click', function() {
        currentMonthIndex = Math.max(0, currentMonthIndex - 1);
        if (currentMonthIndex === 0) {
            currentYear--; // Reduz o ano quando chegar ao primeiro mês
        }
        showCurrentMonth();
    });

    // Mostra o próximo mês
    document.getElementById('nextMonth').addEventListener('click', function() {
        currentMonthIndex = Math.min(calendars.length - 1, currentMonthIndex + 1);
        if (currentMonthIndex === calendars.length - 1) {
            currentYear++; // Aumenta o ano quando chegar ao último mês
        }
        showCurrentMonth();
    });

    // Exibe o calendário inicial
    showCurrentMonth();
});
</script>

</body>
</html>
