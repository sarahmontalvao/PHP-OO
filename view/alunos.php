<?php

session_start();

// Gera um ID de sessão, se não existir
if (!isset($_SESSION['sessao_id']) || empty($_SESSION['sessao_id'])) {
    $_SESSION['sessao_id'] = session_id();
}

// Obtém o ID da sessão
//$sessao_id = $_SESSION['sessao_id'];

// Exibe o conteúdo da sessão
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

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

<div>
    <form action="../controles/validarAluno.php" method="POST">
        <select name="col" >
            <option value="genero">genero</option>
            <option value="titulo">titulo</option>
        </select>
        <input name="pesquisa"type="search" placeholder="Pesquise o nome do aluno">

  
        <button>Pesquisar</button>
    </form>
</div>

<?php foreach($alunos as $al) { ?>
    <a href="alunoDetalhes.php?IdAluno=<?php echo $al['id'] ?>"><?php echo $al['id'] ?></a><br>
    <a href="#" onclick="showConfirmation(<?php echo $al['id'] ?>)">Excluir</a><br>

   
    
<?php } ?>


 <form action="">
    <select id="select1">
      <option value="opcao1">Opção 1</option>
      <option value="opcao2">Opção 2</option>
      <option value="opcao3">Opção 3</option>
    </select>
    
    <select id="select2">
      <option value="opcao1">Opção 1</option>
      <option value="opcao2">Opção 2</option>
      <option value="opcao3">Opção 3</option>
    </select>
    </form>


    <!-- Coloque isso em algum lugar do seu HTML -->
<div id="loading" style="display:none;">
    <img src="loading.gif" alt="Carregando...">
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="../js/script.js"></script>


<script>
  // Obtenha os elementos select
  var select1 = document.getElementById('select1');
  var select2 = document.getElementById('select2');

  // Adicione um ouvinte de evento de mudança ao primeiro select
  select1.addEventListener('change', function() {
    // Atribua o valor do primeiro select ao segundo select
    select2.value = select1.value;
  });

  select2.addEventListener('change', function() {
    // Atribua o valor do segundo select ao primeiro select
    select1.value = select2.value;
  });
</script>
</body>
</html>