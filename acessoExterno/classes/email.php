<?php
class EmailRedefinicaoSenha {
    private $para;
    private $assunto;
    private $mensagem;

    public function __construct($para, $token) {
        $this->para = $para;
        $this->assunto = 'Redefinição de senha';
        $this->mensagem = "Olá,\n\nVocê solicitou a redefinição de senha. Clique no link abaixo para redefinir sua senha:\n\nhttp://seusite.com/redefinir_senha.php?token=$token\n\nSe você não solicitou a redefinição de senha, pode ignorar este e-mail.\n\nAtenciosamente,\nSua Empresa";
    }

    public function enviar() {
        $cabecalhos = 'From: sarahmonttalvao@gmail.com' . "\r\n" .
                     'Reply-To: sarahmonttalvao@gmail.com' . "\r\n" .
                     'X-Mailer: PHP/' . phpversion();

        if(mail($this->para, $this->assunto, $this->mensagem, $cabecalhos)) {
            return true;
        } else {
            return false;
        }
    }
}

// Exemplo de uso
$para = 'sarahmonttalvao@gmail.com';
$token = 'seu_token';
$email = new EmailRedefinicaoSenha($para, $token);
if($email->enviar()) {
    echo 'E-mail enviado com sucesso aaaaa!';
} else {
    echo 'Erro ao enviar o e-mail.';
}
?>
