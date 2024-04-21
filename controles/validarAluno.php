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
?>
