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
