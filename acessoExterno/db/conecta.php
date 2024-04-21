<?php


class PdoConexao {
    private static $instancia;
    private $conexao;

    // Impedir instanciação
    private function __construct() {
        try {
            $dsn = "mysql:host=localhost;dbname=scl";
            $usuario = "root";
            $senha = ""; // Preencha aqui com a senha do seu servidor de banco de dados.

            // Instânciado um novo objeto PDO informando o DSN e parâmetros de Array
            $this->conexao = new PDO($dsn, $usuario, $senha);
            // Gerando um excessão do tipo PDOException com o código de erro
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $excecao) {
            echo $excecao->getMessage();
            // Encerra aplicativo
            exit();
        }
    }

    // Impedir clonar
    private function __clone() {
    }

    //Impedir utilização do Unserialize
    public function __wakeup() {
    }

    public static function getInstancia() {
        if (!isset(self::$instancia)) {
            self::$instancia = new PdoConexao();
        }
        return self::$instancia->conexao;
    }
}

?>