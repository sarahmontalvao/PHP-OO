<?php

include_once('../classes/AlunoClass.php');

if(isset($_POST['novo-aluno'])){
    $dadosAlunos = array (
        'nome' => $_POST['nome'],
        'curso' => $_POST['curso']
    );

    $aluno = new Aluno ($dadosAlunos['nome'], $dadosAlunos['curso']);
    $aluno->insert();
   var_dump($aluno);
}else{
    echo 'nada';
}
?>
