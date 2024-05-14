<?php
class Calendario {
    private $month;
    private $year;

    public function __construct($month, $year) {
        $this->month = $month;
        $this->year = $year;
    }

    // Função para obter o número de dias em um mês
    private function getDaysInMonth() {
        return cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
    }

    function getNomeMes() {
        $meses = array(
            1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
            5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
            9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
        );

        return $meses[$this->month];
    }

    // Função para gerar o calendário
    public function gerarHTML() {
        // Obtém o número de dias no mês
        $numDays = $this->getDaysInMonth();
        
        // Cria um objeto DateTime para o primeiro dia do mês
        $firstDayOfMonth = new DateTime("$this->year-$this->month-01");
        
        // Obtém o número do dia da semana para o primeiro dia do mês (0 = Domingo, 1 = Segunda-feira, ..., 6 = Sábado)
        $firstDayOfWeek = $firstDayOfMonth->format('w');
        
        // Cria uma matriz para armazenar os dias do calendário
        $calendar = array();

        // Adiciona espaços em branco para preencher os dias da semana antes do primeiro dia do mês
        for ($i = 0; $i < $firstDayOfWeek; $i++) {
            $calendar[] = '';
        }

        // Adiciona os dias do mês ao calendário
        for ($day = 1; $day <= $numDays; $day++) {
            $calendar[] = $day;
        }

        // Gera o HTML do calendário
        $html = '<table border="1">';
        $weekDay = 0;
        foreach ($calendar as $day) {
            // Se for o primeiro dia da semana, inicia uma nova linha na tabela
            if ($weekDay == 0) {
                $html .= '</tr><tr>';
            }

            // Se o dia estiver vazio, adiciona uma célula vazia
            if ($day === '') {
                $html .= '<td></td>';
            } else {
                // Senão, exibe o dia
                $html .= "<td>$day</td>";
            }

            // Incrementa o contador de dias da semana
            $weekDay++;

            // Se o contador de dias da semana chegar a 7 (sábado), reinicia para domingo
            if ($weekDay == 7) {
                $weekDay = 0;
            }
        }
        
        // Se o último dia do mês não for sábado, completa a última semana com células vazias
        while ($weekDay > 0 && $weekDay < 7) {
            $html .= '<td></td>';
            $weekDay++;
        }

        $html .= '</tr></table>';

        return $html;
    }
}
?>
