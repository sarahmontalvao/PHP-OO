<?php




// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $dadosFormulario = array(
        'empresa' => $_POST['empresa'],
        'treinamento' => $_POST['treinamento'],
        'nome' => $_POST['nome'],
        'telefone' => $_POST['telefone'],
        'data' => $_POST['data'],
        'assinatura_data' => $_POST['assinatura_data']
    );

   

    include_once('../classes/formularioClass.php');

    $presenca = new Presenca(
        $dadosFormulario['nome'],
        $dadosFormulario['treinamento'],
        $dadosFormulario['data'],
        null,
        $dadosFormulario['assinatura_data'],
        1,
        $dadosFormulario['empresa'],
        $dadosFormulario['telefone'],
       
    );

    $presenca->insert();















    // Verifica se a assinatura foi enviada
    if(isset($_POST['assinatura_data'])) {
        // Recupera os outros campos do formulário
        $empresa = $_POST['empresa'];
        $treinamento = $_POST['treinamento'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $data = $_POST['data'];
        
        // Obtem a assinatura do campo de input
        $assinatura_data = $_POST['assinatura_data'];
        
        // Salva a assinatura em um arquivo (opcional)
        $nome_arquivo ='assAluno'. date("YmdHis") . ".png";
        $caminho_arquivo = "../img/" . $nome_arquivo;
        $assinatura_base64 = explode(',', $assinatura_data)[1];
        file_put_contents($caminho_arquivo, base64_decode($assinatura_base64));
        
        // Exibe uma mensagem de sucesso com os outros dados do formulário
        echo "Assinatura capturada e salva com sucesso: <br>";
       
        echo "<img src='$caminho_arquivo'>";

        header("Location: ../view/formulario.php?sucesso=true");
    } else {
        // Se a assinatura não foi enviada, exibe uma mensagem de erro
        echo "Erro: Assinatura não foi recebida.";
       header("Location: ../view/formulario.php?sucesso=false");
    }
} else {
    exit();
}
?>
