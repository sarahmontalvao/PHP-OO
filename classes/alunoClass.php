<?php
session_start();
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
       
        if ($stmt->execute()) {
            // Seleciona o filme recém inserido para obter os detalhes
            $sql2 = "SELECT * FROM filmes WHERE titulo = :titulo AND genero = :genero";
            $stmt2 = PdoConexao::getInstancia()->prepare($sql2);
            $stmt2->bindValue(":titulo", $this->nome);
            $stmt2->bindValue(":genero", $this->curso);
            $stmt2->execute();
    
            $result = $stmt2->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                // Armazena informações na sessão
                $_SESSION['user_id'] = $result['titulo'];
                $_SESSION['email'] = $result['genero'];
    
                // Define um cookie persistente para lembrar do usuário
                $cookie_value = base64_encode($result['titulo']);
                setcookie('user_login', $cookie_value, time() + (86400 * 30), "/"); // Cookie válido por 30 dias
                header("Location: ../view/alunos.php");
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    

    public function getAllAlunos() {
      
    
        // Processamento em segundo plano
        $sql = "SELECT * FROM filmes";
        $stmt = PdoConexao::getInstancia()->prepare($sql);
        $stmt->execute();
        $alunos = $stmt->fetchAll();
    
        // Esperar por um tempo simulado (substitua pelo seu processamento real)
        
    
        // Enviar resposta final
        if ($alunos) {
            
           
            return $alunos;
        } else {
           
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>