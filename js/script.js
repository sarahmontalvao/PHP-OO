function showConfirmation(idAluno) {
    // Exibe o pop-up de confirmação
    Swal.fire({
        title: 'Tem certeza?',
        text: 'Você realmente deseja excluir este aluno?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        // Se o usuário confirmar a exclusão, redireciona para o arquivo de exclusão
        if (result.isConfirmed) {
            window.location.href = 'excluir_aluno.php?IdAluno=' + idAluno;
        }
    });

    // Função para exibir um alerta de sucesso
function mostrarAlertaSucesso() {
    Swal.fire({
        icon: 'success',
        title: 'Sucesso!',
        text: 'Aluno inserido com sucesso!'
    });
}

// Função para exibir um alerta de falha
function mostrarAlertaFalha() {
    Swal.fire({
        icon: 'error',
        title: 'Erro!',
        text: 'Falha ao inserir aluno!'
    });
}

}
$(document).ready(function(){
    // Função para fazer a requisição AJAX
    function getAllAlunos() {
        console.log('Teste')
        
      
        $.ajax({
            type: 'GET',
            url: '../classes/alunoClass.php',
            beforeSend: function(){
                $('#loading').show(); // Mostra o símbolo de carregamento antes de enviar a requisição
            },
            success: function(response){
                // Verifica se a resposta inicial indica que o processamento está em andamento
                if (response.status === 'processing') {
                    $('#loading').show(); // Mostra o símbolo de carregamento
                } else {
                    $('#loading').hide(); // Esconde o símbolo de carregamento
                    $('#alunos').html(response); // Atualiza a página com os dados recebidos do servidor
                }
            },
            error: function(){
                $('#loading').hide(); // Em caso de erro, certifique-se de ocultar o símbolo de carregamento
                // Trate o erro conforme necessário
            }
        }).done(function(res){
            console.log(res);
        });
    }

    // Chama a função ao carregar a página
    getAllAlunos();
});

