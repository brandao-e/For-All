<?php 
class Usuario implements JsonSerializable {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $salt; // Utilizado para diferenciar o HASH de senhas na hora da criptografia
    private $tipo; // 0 para funcionário, 1 para empresa
    private $con;

    function jsonSerialize(): mixed {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha,
            'salt' => $this->salt,
            'tipo' => $this->tipo
        ];
    }

    function __get($atributo) {
        return $this->$atributo;
    }

    function __set($atributo, $value) {
        $this->$atributo = $value;
    }

    function __construct() {
        include_once("Conexao.php");
        $classe_con = new Conexao();
        $this->con = $classe_con->Conectar();
    }

    function Cadastrar() {
        $sql = "INSERT INTO usuario (nome, email, senha, salt, tipo) VALUES (?, ?, ?, ?, ?)";
        $valores = array($this->nome, $this->email, $this->senha, $this->salt, $this->tipo);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Atualizar() {
        $sql = "UPDATE usuario SET nome = ?, email = ?, senha = ?, salt = ?, tipo = ? WHERE id = ?";
        $valores = array($this->nome, $this->email, $this->senha, $this->salt, $this->tipo, $this->id);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Excluir() {
        $sql = "DELETE FROM usuario WHERE id = ?";
        $valores = array($this->id);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
    }

    function Consultar() {
        $sql = "SELECT * FROM usuario";
        $exec = $this->con->prepare($sql);
        $exec->execute();

        $dados = array();

        foreach($exec->fetchAll() as $valor) {
            $usuario = new Usuario();
            $usuario->id = $valor['id'];
            $usuario->nome = $valor['nome'];
            $usuario->email = $valor['email'];
            $usuario->senha = $valor['senha'];
            $usuario->salt = $valor['salt'];
            $usuario->tipo = $valor['tipo'];

            $dados[] = $usuario;
        }

        return $dados;
    }

    function RetornaDados() {
        $sql = "SELECT * FROM usuario WHERE id = ?";
        $valores = array($this->id);
        $exec = $this->con->prepare($sql);
        $exec->execute($valores);
        $valor = $exec->fetch();

        $usuario = new Usuario();
        $usuario->id = $valor['id'];
        $usuario->nome = $valor['nome'];
        $usuario->email = $valor['email'];
        $usuario->senha = $valor['senha'];
        $usuario->salt = $valor['salt'];
        $usuario->tipo = $valor['tipo'];

        return $usuario;
    }
}
?>