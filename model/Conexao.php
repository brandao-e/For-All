<?php
class Conexao {
    private $pdo;

    public function __construct() {
        try {
            // Ajuste os parâmetros conforme necessário
            $this->pdo = new PDO('mysql:host=localhost;dbname=bdforall', 'root',''); // Substitua 'usuario' e 'senha' pelos seus dados
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erro ao conectar: ' . $e->getMessage());
        }
    }

    public function Conectar() {
        return $this->pdo;

    }

	public function inserirDadosFuncionario($pNome, $uNome, $Email, $senha, $xp,$bio, $servico, $subcategoria, $telefone, $dataNas, $foto) {
		$stmt = $this->pdo->prepare("INSERT INTO trabalhador (primeiroNome,ultimoNome,email,senha,experiencia,biografia, servico, subcategoria, telefone, dataNasc, fotoPerfil) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->execute([$pNome, $uNome, $Email, $senha, $xp,$bio, $servico, $subcategoria, $telefone, $dataNas, $foto]);
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