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
           
            return true;
        }else{
            return false;
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

   public function pesquisa($termo, $coluna) {
    // Removendo espaços em branco e convertendo para minúsculas
    $termo = trim(strtolower($termo));
    
    // Query SQL para pesquisar na coluna especificada (com termo e coluna também em minúsculas)
    $sql = "SELECT * FROM filmes WHERE LOWER($coluna) LIKE :termo";
    
    // Preparando a consulta
    $stmt = PdoConexao::getInstancia()->prepare($sql);
    
    // Substituindo o placeholder :termo pelo valor de pesquisa (com termo em minúsculas)
    $termoPesquisa = "%$termo%";
    $stmt->bindParam(':termo', $termoPesquisa, PDO::PARAM_STR);
    
    // Executando a consulta
    $stmt->execute();
    
    // Recuperando os resultados
    $filmes = $stmt->fetchAll();
    
    // Verificando se houve resultados
    if($filmes){
        return $filmes; // Retornando os resultados
    } else {
        return []; // Retornando um array vazio se não houver resultados
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
