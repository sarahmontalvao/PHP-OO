<?php

include_once('../db/conecta.php');

class AlunoFormulario {
    private $nome;
    private $id;

    // Construtor
    public function __construct( $nome, $id) {
        $this->nome = $nome;
        $this->id = $id;
    }


    public function getAllalunos() {
        $sql = "SELECT * FROM alunos";
        $stmt = PdoConexao::getInstancia()->prepare($sql);
        $stmt->execute();
        $alunos = $stmt->fetchAll();
        
       
        if($alunos){
          
            return $alunos;
        }else{
            echo 'falha';
        }
    }
}


?>
