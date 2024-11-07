<?php
class Conexao {
    private $conn;

    function __construct() {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=bdforall", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        } catch (PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
        }
    }

    public function getPDO() {
        return $this->conn;
    }
    public function getEstados(){
        $stmt = $this ->conn->query('SELECT idEstado, estado FROM estado');
        return $stmt ->fetchALL(PDO::FETCH_ASSOC);
    }

    public function getCidade(){
        $stmt = $this ->conn->query('SELECT idCidade, cidade FROM cidade');
        return $stmt ->fetchALL(PDO::FETCH_ASSOC);
    }
    
}
?>
