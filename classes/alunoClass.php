<?php
include_once('interface.php');
include_once('../db/conecta.php');

class Aluno implements Model{
    private $nome;
    private $curso;

    // Construtor
    public function __construct( $nome, $curso) {
        $this->nome = $nome;
        $this->curso = $curso;
    }


    public function insert() {
        $sql = "INSERT INTO filmes (titulo, genero) VALUES (:nome, :curso)";
        $stmt = PdoConexao::getInstancia()->prepare($sql);
        $stmt->bindValue(":nome", $this->nome);
        $stmt->bindValue(":curso", $this->curso);
       
        if($stmt->execute()){
            echo 'inserido <br>';
            return true;
        }else{
            echo 'falha';
        }
    }

    public function getAllalunos() {
        $sql = "SELECT * FROM filmes";
        $stmt = PdoConexao::getInstancia()->prepare($sql);
        $stmt->execute();
        $alunos = $stmt->fetchAll();
        
       
        if($alunos){
          
            return $alunos;
        }else{
            echo 'falha';
        }
    }

    public function read($id) {
        // Lógica para ler os dados de um aluno do banco de dados
    }

    public function update($id) {
        $sql = "UPDATE filmes SET titulo = :nome, genero = :curso WHERE Id = :id";
        $stmt = PdoConexao::getInstancia()->prepare($sql);
        $stmt->bindValue(":nome", $dados['nome']);
        $stmt->bindValue(":curso", $dados['curso']);
        $stmt->bindValue(":id", $dados['id']);
        return $stmt->execute();
        if ($stmt->execute()) {
           echo 'insert';
        } else {
            // Mensagem de erro
            echo "Erro ao atualizar aluno: " . $stmt->errorInfo()[2];
            return false;
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM filmes WHERE Id = :id";
        $stmt = PdoConexao::getInstancia()->prepare($sql);
        $stmt->bindValue(":id", $dados['id']);
        return $stmt->execute();
    }
}


class AlunoId extends Aluno {
    private $id;

    // Construtor
    public function __construct( $id, $nome, $curso) {
        $this->id = $id;
        $this->nome = $nome;
        $this->curso = $curso;
    }

    public function getAlunoId() {
        $sql = "SELECT * FROM filmes WHERE id=:id";
        $stmt = PdoConexao::getInstancia()->prepare($sql);
        $stmt->bindValue(":id", $this->id);
        $stmt->execute();
        $alunoId = $stmt->fetch();
        
       
        if($alunoId){
         
            return $alunoId;
        }else{
            echo 'falha';
        }
    }

}

?>
