<?php
include_once('../classes/alunoClass.php');
include_once('../classes/treinamentoClass.php');


$alunos = new AlunoFormulario(null,null);
$todosAlunos = $alunos->getAllalunos();

$treinamento = new Treinamento(null,null);
$todosTreinamentos = $treinamento->getAllTreinamento();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Treinamento</title>
</head>
<body>
<?php
if (!isset($_GET['sucesso'])) {  
?>
    <h2>Formulário de Treinamento</h2>
    <form id="formulario" method="post" action="../controles/validaFormulario.php" >
        <label for="empresa">Empresa:</label><br>
        <input type="text" id="empresa" name="empresa" required><br><br>

        <label for="treinamento">Treinamento:</label><br>
       

        <select name="treinamento" required >
        <option value="" disabled selected hidden>Selecione</option>
            <?php
            foreach($todosTreinamentos as $treinamento) { ?>
             <option value="<?php echo $treinamento["IdTreinamento"] ?>"><?php echo $treinamento["NomeTreinamento"] ?></option>
             <?php }
            ?>
           
        </select><br><br>

        <label for="nome">Nome: </label><br>
    
        <select name="nome" required >
        <option value="" disabled selected hidden>Selecione</option>
            <?php
            foreach($todosAlunos as $aluno) { ?>
             <option value="<?php echo $aluno["IdAluno"] ?>"><?php echo $aluno["Nome"] ?></option>
             <?php }
            ?>
           
        </select><br><br>
       

        <label for="telefone">Telefone:</label><br>
        <input type="tel" id="telefone" name="telefone" required><br><br>

        <label for="data">Data:</label><br>
        <input type="date" id="data" name="data" required><br><br>

        <label for="assinatura">Assinatura:</label><br>
        <div id="mensagem"  style="color: red;"></div>
        <canvas id="assinatura" width="400" height="200"></canvas><br><br>
        <button type="button" onclick="limparAssinatura()">Limpar Assinatura</button><br><br>

        <input type="hidden" id="assinatura_data" name="assinatura_data">

        <input type="hidden" id="assinatura_feita" name="assinatura_feita">
        
        <input type="submit" value="Enviar">
    </form>
<?php
} 
?>

    <?php
    if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'true') {  ?>

        <section class="sucesso">
            <h3>Suas respostas foram enviadas corretamente!</h3>
           <p>Agora seu certificado sera emitido com a assinatura enviada aqui.</p>

        </section>
        <?php
    } 
    ?>


<?php
    if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'false') {  ?>

        <section class="falha">
            <h3>Ocoreu um erro durante o envio das respostas!</h3>
           <p>Clique no botão abaixo e preencha novamente os campos nome, telefone, e assinatura.

           </br><strong> Os campos empresa, treinamento e data são preenchidos automaticamente.</strong></p>

           <a href="formulario.php">
           <button>Voltar ao formulario</button>
           </a>
        </section>
        <?php
    } 
    ?>


<script>
    var canvas = document.getElementById("assinatura");
    var ctx = canvas.getContext("2d");
    var desenhando = false;

    // Eventos de mouse para desktops
    canvas.addEventListener("mousedown", function(e) {
        desenhando = true;
        ctx.beginPath();
        var rect = canvas.getBoundingClientRect();
        var x = e.clientX - rect.left;
        var y = e.clientY - rect.top;
        ctx.moveTo(x, y);
    });

    canvas.addEventListener("mousemove", function(e) {
        if (desenhando) {
            var rect = canvas.getBoundingClientRect();
            var x = e.clientX - rect.left;
            var y = e.clientY - rect.top;
            ctx.lineTo(x, y);
            ctx.stroke();
        }
    });

    canvas.addEventListener("mouseup", function() {
        desenhando = false;
        capturarAssinatura();
    });

    canvas.addEventListener("mouseleave", function() {
        desenhando = false;
    });

    // Eventos de toque para dispositivos móveis
    canvas.addEventListener("touchstart", function(e) {
        desenhando = true;
        var touch = e.touches[0];
        ctx.beginPath();
        ctx.moveTo(touch.clientX - canvas.offsetLeft, touch.clientY - canvas.offsetTop);
    });

    canvas.addEventListener("touchmove", function(e) {
        if (desenhando) {
            var touch = e.touches[0];
            ctx.lineTo(touch.clientX - canvas.offsetLeft, touch.clientY - canvas.offsetTop);
            ctx.stroke();
        }
    });

    canvas.addEventListener("touchend", function() {
        desenhando = false;
        capturarAssinatura();
    });

    canvas.addEventListener("touchcancel", function() {
        desenhando = false;
    });

    function limparAssinatura() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        document.getElementById("assinatura_data").value = "";
        document.getElementById("assinatura_feita").value = ""; // Limpar também o campo de verificação
        document.getElementById("mensagem").innerHTML = "";
    }

    function capturarAssinatura() {
        var dataURL = canvas.toDataURL();
        document.getElementById("assinatura_data").value = dataURL;
        document.getElementById("assinatura_feita").value = "true";
    }

    document.querySelector("form").addEventListener("submit", function(event) {
        if (document.getElementById("assinatura_feita").value !== "true") {
            event.preventDefault(); // Impedir o envio do formulário se a assinatura não foi feita
            document.getElementById("mensagem").innerHTML = "Por favor, faça a assinatura antes de enviar o formulário.";
        }
    });
</script>

</body>
</html>
