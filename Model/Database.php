<?php
class Database {
    private $dbHost = 'Localhost';
    private $dbUsername = 'root';
    private $dbPassword = '';
    private $dbName = 'bibliotec';
    public $conexao;

    public function __construct() {
        $this->conexao = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);

        // Verifica a conexão
        if ($this->conexao->connect_error) {
            die("Falha na conexão: " . $this->conexao->connect_error);
        }
    }
    public function query($sql) {
        return $this->conexao->query($sql);
    }
    public function getConnection() {
        return $this->conexao;
    }
}

?>