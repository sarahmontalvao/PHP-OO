<?php

include_once('../classes/AlunoClass.php');

if(isset($_POST['novo-aluno'])){
    $dadosAlunos = array (
        'nome' => $_POST['nome'],
        'curso' => $_POST['curso']
    );

    $aluno = new Aluno ($dadosAlunos['nome'], $dadosAlunos['curso']);
    $aluno->insert();

    if($aluno->insert()) {
        // Se a inserção for bem-sucedida, exibe uma mensagem de sucesso
        echo "<script>mostrarAlertaSucesso();</script>";
    } else {
        // Se a inserção falhar, exibe uma mensagem de falha
        echo "<script>mostrarAlertaFalha();</script>";
    }
  
}
if(isset($_POST['pesquisa']) && isset($_POST['col'])) {
    // Receber o termo de pesquisa e a coluna
    $pesquisa = trim(strtolower($_POST['pesquisa']));
    $coluna = $_POST['col'];

    // Realizar a pesquisa
    $resultados = new Aluno(null, null);
    $resultPesquisa = $resultados->pesquisa($pesquisa, $coluna);

    // Exibir os resultados
    echo "<h2>Resultados da Pesquisa</h2>";
    echo "<ul>";
    foreach ($resultPesquisa as $aluno) {
        echo "<li>" . $aluno['titulo'] . "</li>";
        echo "<li>" . $aluno['genero'] . "</li>";
        echo "<li>" . $aluno['descricao'] . "</li>";
    }
    echo "</ul>";

    
}


?>
