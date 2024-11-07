<?php
    class conexao{

        private $conn;
    
        public function __construct()
        
        {
    
            try{
            $this->conn = new PDO ("mysql:dbname=bdforall;host=localhost","root","");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(Exception $e){
                echo"erro de conexao ".$e->getMessage();
            }
        }
    
        public function getPDO(){
            return $this->conn;
        }
        
        
    public function getVagas(){
        $stmt = $this ->conn->query('SELECT idVaga, tituloVaga, salarioVaga, dataPublicacao, descricao, idEmpresa FROM vagas');
        return $stmt ->fetchALL(PDO::FETCH_ASSOC);
    }
    public function getPublicacoes(){
        $stmt = $this ->conn->query('SELECT * FROM publicacoes');
        return $stmt ->fetchALL(PDO::FETCH_ASSOC);
    }

    }


?>