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


<h2>GERAR QR CODE</h2>

<form action="../acessoExterno/controles/qrCode.php" method="POST">


<input type="hidden" name="id" value="<?php echo $_GET['IdAluno'] ?>">
<input type="submit" name="qrCode" value="Gerar QrCode">
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="../js/script.js"></script>

</body>
</html>
