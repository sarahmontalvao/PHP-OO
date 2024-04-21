<?php

include_once('../db/conecta.php');

class Treinamento {
    private $nomeTreinamento;
    private $idTreinamento;

    // Construtor
    public function __construct( $nomeTreinamento, $idTreinamento) {
        $this->nomeTreinamento = $nomeTreinamento;
        $this->idTreinamento = $idTreinamento;
    }


    public function getAllTreinamento() {
        $sql = "SELECT * FROM treinamentos";
        $stmt = PdoConexao::getInstancia()->prepare($sql);
        $stmt->execute();
        $treinamento = $stmt->fetchAll();
        
       
        if($treinamento){
          
            return $treinamento;
        }else{
            echo 'falha';
        }
    }
}


?>
