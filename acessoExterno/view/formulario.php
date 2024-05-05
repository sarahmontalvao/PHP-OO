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
    <style>

/* Definindo o fundo do canvas como transparente */


            canvas:-moz-full-screen,
        canvas:-webkit-full-screen,
        canvas:-ms-fullscreen,
        canvas:fullscreen {
            width: 100%;
            height: 100%;
}
canvas {
        background-color: white;
        color: black;
        display: block;
        border: 5px solid red;
    }

    #canvasContainer {
        position: relative; /* Necessário para que os botões possam ser posicionados relativamente */
        width: 400px; /* Largura do canvas */
        height: 200px; /* Altura do canvas */
    }

    #limpar{
        position: absolute;
        top: 25px; /* Ajuste conforme necessário */
        left: 10px; /* Ajuste conforme necessário */
        z-index: 99992;
        
    }


    </style>
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
    <div id="canvasContainer">
        <div id="mensagem" style="color: red;"></div>
        <button id="expandButton">Expandir</button>
        <button id="exitButton">Sair</button>
        <canvas id="assinatura" width="400" height="200"></canvas><br><br>
 
    <button id="limpar" type="button" onclick="limparAssinatura()">Limpar Assinatura</button><br><br>
    </div>
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


document.getElementById('expandButton').addEventListener('click', function() {
            var canvas = document.getElementById('assinatura');
            if (canvas.requestFullscreen) {
                canvas.requestFullscreen();
            } else if (canvas.mozRequestFullScreen) { /* Firefox */
                canvas.mozRequestFullScreen();
            } else if (canvas.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
                canvas.webkitRequestFullscreen();
            } else if (canvas.msRequestFullscreen) { /* IE/Edge */
                canvas.msRequestFullscreen();
            }
            document.getElementById('limpar').style.display = 'inline';
        
        });

        document.getElementById('exitButton').addEventListener('click', function() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { /* Firefox */
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { /* IE/Edge */
                document.msExitFullscreen();
            }
          
        });



var canvas = document.getElementById("assinatura");
var ctx = canvas.getContext("2d");
var desenhando = false;

function ajustarCoordenadasMouse(event) {
    var rect = canvas.getBoundingClientRect();
    var scaleX = canvas.width / rect.width;
    var scaleY = canvas.height / rect.height;
    return {
        x: (event.clientX - rect.left) * scaleX,
        y: (event.clientY - rect.top) * scaleY
    };
}

// Eventos de mouse para desktops
canvas.addEventListener("mousedown", function(e) {
    desenhando = true;
    var coords = ajustarCoordenadasMouse(e);
    ctx.beginPath();
    ctx.moveTo(coords.x, coords.y);
});

canvas.addEventListener("mousemove", function(e) {
    if (desenhando) {
        var coords = ajustarCoordenadasMouse(e);
        ctx.lineTo(coords.x, coords.y);
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
    var coords = ajustarCoordenadasMouse(touch);
    ctx.beginPath();
    ctx.moveTo(coords.x, coords.y);
});

canvas.addEventListener("touchmove", function(e) {
    if (desenhando) {
        var touch = e.touches[0];
        var coords = ajustarCoordenadasMouse(touch);
        ctx.lineTo(coords.x, coords.y);
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
