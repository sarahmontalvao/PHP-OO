<?php
include_once('../classes/alunoClass.php');

$aluno = new Aluno(null, null); 
$alunos = $aluno->getAllalunos();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php foreach($alunos as $al) { ?>
    <a href="alunoDetalhes.php?IdAluno=<?php echo $al['id'] ?>"><?php echo $al['id'] ?></a>
<?php } ?>

    
</body>
</html>