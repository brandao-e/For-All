<?php 
  class Empresa implements JsonSerializable{
    private $idEmpresa;
    private $primeiroNome;
    private $ultimoNome;
    private $email;
    private $senha;
    private $salt; // Utilizado para diferenciar o HASH de senhas na hora da criptografia, fornecendo mais segurança
    private $videoApresentacao;
    private $cnpj;
    private $fotoPerfil;
    private $tipoUsuario; // No banco como BIT (1 ou 0) onde 1 é empresa e 0 é funcionário
    private $con;

    function jsonSerialize(): mixed {
			return 
			[
				'codigo' => $this->idEmpresa,
        'primeiro_nome' => $this->primeiroNome,
        'ultimo_nome' => $this->ultimoNome,
        'email' => $this->email,
        'senha' => $this->senha,
        'salt' => $this->salt,
        'video_apresentacao' => $this->videoApresentacao,
        'cnpj' => $this->cnpj,
        'foto_perfil' => $this->fotoPerfil,
        'tipo_usuario' => $this->tipoUsuario
			];
		}

    function __get($atributo){
			return $this->$atributo;
		}

		function __set($atributo, $value){
			$this->$atributo = $value;
		}

    function __construct(){
			include_once("Conexao.php");
			$classe_con = new Conexao();
			$this->con = $classe_con->Conectar();
		}

    function Cadastrar() {
      $sql = "INSERT INTO empresa ( primeiroNome, ultimoNome, email, senha, salt, videoApresentacao, cnpj, fotoPerfil, tipoUsuario) VALUES (?,?,?,?,?,?,?,?,?)";
      $valores = array($this->primeiroNome, $this->ultimoNome, $this->email, $this->senha, $this->salt, $this->videoApresentacao, $this->cnpj, $this->fotoPerfil, $this->tipoUsuario);
      $exec = $this->con->prepare($sql);
      $exec->execute($valores);
    }

    function Atualizar() {
      $sql = "UPDATE empresa SET primeiroNome = ?, ultimoNome = ?, email = ?, senha = ?, salt = ?, videoApresentacao = ?, cnpj = ?, fotoPerfil = ?, tipoUsuario = ? WHERE idEmpresa = ?";
      $valores = array($this->primeiroNome, $this->ultimoNome, $this->email, $this->senha, $this->salt, $this->videoApresentacao, $this->cnpj, $this->fotoPerfil, $this->tipoUsuario, $this->idEmpresa);
      $exec = $this->con->prepare($sql);
      $exec->execute($valores);
    }

    function Excluir() {
      $sql = "DELETE FROM empresa WHERE idEmpresa = ?";
      $valores = array($this->idEmpresa);
      $exec = $this->con->prepare($sql);
      $exec->execute($valores);
    }

    function Consultar() {
      $sql = "SELECT * FROM empresa";
      $exec = $this->con->prepare($sql);
      $exec->execute();

      $dados = array();

      foreach($exec->fetchAll() as $valor) {
        $Empresa = new Empresa();
        $Empresa->idEmpresa = $valor['idEmpresa'];
        $Empresa->primeiroNome = $valor['primeiroNome'];
        $Empresa->ultimoNome = $valor['ultimoNome'];
        $Empresa->email = $valor['email'];
        $Empresa->senha = $valor['senha'];
        $Empresa->salt = $valor['salt'];
        $Empresa->videoApresentacao = $valor['videoApresentacao'];
        $Empresa->cnpj = $valor['cnpj'];
        $Empresa->fotoPerfil = $valor['fotoPerfil'];
        $Empresa->tipoUsuario = $valor['tipoUsuario'];

        $dados[] = $Empresa;
      }

      return $dados;
    }

    function RetornaDados() {
      $sql = "SELECT * FROM empresa WHERE idEmpresa = ?";
      $valores = array($this->idEmpresa);
      $exec = $this->con->prepare($sql);
      $exec->execute($valores);
      $valor = $exec->fetch();

      $Empresa = new Empresa();
      $Empresa->idEmpresa = $valor['idEmpresa'];
      $Empresa->primeiroNome = $valor['primeiroNome'];
      $Empresa->ultimoNome = $valor['ultimoNome'];
      $Empresa->email = $valor['email'];
      $Empresa->senha = $valor['senha'];
      $Empresa->salt = $valor['salt'];
      $Empresa->videoApresentacao = $valor['videoApresentacao'];
      $Empresa->cnpj = $valor['cnpj'];
      $Empresa->fotoPerfil = $valor['fotoPerfil'];
      $Empresa->tipoUsuario = $valor['tipoUsuario'];

      return $Empresa;
    }
  }
?>