<?php
include_once('../db/conecta.php');

class Presenca {
    public $IdAluno;
    public $IdTreinamento;
    public $DataAssinatura;
    public $LinkFormulario;
    public $AssinaturaImagem;
    public $Presenca;

    // Construtor
    public function __construct($idAluno, $idTreinamento, $dataAssinatura, $linkFormulario, $assinaturaImagem, $presenca) {
        $this->IdAluno = $idAluno;
        $this->IdTreinamento = $idTreinamento;
        $this->DataAssinatura = $dataAssinatura;
        $this->LinkFormulario = $linkFormulario;
        $this->AssinaturaImagem = $assinaturaImagem;
        $this->Presenca = $presenca;
    }

    public function insert() {
        $sql = "INSERT INTO presencaalunos (IdAluno, IdTreinamento, DataAssinatura, LinkFormulario, AssinaturaImagem, Presenca) VALUES (:idAluno, :idTreinamento, :dataAssinatura, :linkFormulario, :assinaturaImagem, :presenca)";
        $stmt = PdoConexao::getInstancia()->prepare($sql);
        $stmt->bindValue(":idAluno", $this->IdAluno);
        $stmt->bindValue(":idTreinamento", $this->IdTreinamento);
        $stmt->bindValue(":dataAssinatura", $this->DataAssinatura);
        $stmt->bindValue(":linkFormulario", $this->LinkFormulario);
        $stmt->bindValue(":assinaturaImagem", $this->AssinaturaImagem);
        $stmt->bindValue(":presenca", $this->Presenca);
       
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    
}
?>
