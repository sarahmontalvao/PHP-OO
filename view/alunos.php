<?php
include_once('../classes/alunoClass.php');
// alo fazer a pesquisa colocar todos no mesmo nome de variavel e chamar o metodo que  se o  name de input pesquisa for enviados, caso vazio chamar o que retorna tudo

/* exemplo if (!empty($termoPesquisa)) {
    // Obtendo os alunos da pesquisa com base na paginação
    $resultados = $suaClasse->searchAlunos($paginaAtual, $alunosPorPagina, $termoPesquisa);
} else {
    // Obtendo todos os alunos com base na paginação
    $resultados = $suaClasse->getAllAlunos($paginaAtual, $alunosPorPagina);
}
*/
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
    <a href="#" onclick="showConfirmation(<?php echo $al['id'] ?>)">Excluir</a>
    
<?php } ?>

    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="../js/script.js"></script>
</body>
</html>