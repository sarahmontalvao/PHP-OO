<?php
include_once('../classes/alunoClass.php');

$aluno = new AlunoId ($_GET['IdAluno'], null, null); 
$alunoId = $aluno->getAlunoId();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos detalhes</title>
</head>
<body>

<form action="../controles/validarAluno.php" method="post">
    <h1>novo aluno</h1>
    <label for="nome">Nome</label>
    <input type="text" name="nome" value="<?php echo $alunoId['titulo'] ?>">

    <label for="curso">Curso</label>
    <input type="text" name="curso"  value="<?php echo $alunoId['ano'] ?>">

    <button name="novo-aluno">Enviar</button>
</form>

</body>
</html>