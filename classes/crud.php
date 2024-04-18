<?php
include_once('interface.php');
include_once('db/conecta.php');
class Crud implements Model{
    private $id;
    private $tabela;

    // Construtor
    public function __construct($id, $tabela) {
        $this->id = $id;
        $this->nome = $nome;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function insert($dados) {
        $campos = implode(', ', array_keys($dados));
        $valores = ':' . implode(', :', array_keys($dados));

        $sql = "INSERT INTO {$this->tabela} ($campos) VALUES ($valores)";
        $stmt = PdoConexao::getInstancia()->prepare($sql);

        foreach ($dados as $campo => $valor) {
            $stmt->bindValue(":$campo", $valor);
        }

        return $stmt->execute();
    }

    public function read($id) {
        $sql = "SELECT * FROM {$this->tabela} WHERE id = :id";
        $stmt = PdoConexao::getInstancia()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $dados) {
        $valores = '';
        foreach ($dados as $campo => $valor) {
            $valores .= "$campo = :$campo, ";
        }
        $valores = rtrim($valores, ', ');

        $sql = "UPDATE {$this->tabela} SET $valores WHERE id = :id";
        $stmt = PdoConexao::getInstancia()->prepare($sql);
        $stmt->bindValue(':id', $id);
        foreach ($dados as $campo => $valor) {
            $stmt->bindValue(":$campo", $valor);
        }

        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->tabela} WHERE id = :id";
        $stmt = PdoConexao::getInstancia()->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }



}
?>
