<?php 
  class Trabalhador implements JsonSerializable{
    private $idTrabalhador;
    private $primeiroNome;
    private $ultimoNome;
    private $email;
    private $senha;
    private $salt;
    private $biografia;
    private $servico;
    private $subcategoria;
    private $telefone;
    private $fotoPerfil;
    private $dataNasc;
    private $curriculo;
    private $escolaridade;
    private $videoApresentacao;
    private $portfolio;
    private $tipoUsuario; // 0 para Funcionário, 1 para Empresa
    private $con;

    function jsonSerialize(): mixed {
      return [
        'id_trabalhador' => $this->idTrabalhador,
        'primeiro_nome' => $this->primeiroNome,
        'ultimo_nome' => $this->ultimoNome,
        'email' => $this->email,
        'senha' => $this->senha,
        'salt' => $this->salt,
        'biografia' => $this->biografia,
        'servico' => $this->servico,
        'subcategoria' => $this->subcategoria,
        'telefone' => $this->telefone,
        'foto_perfil' => $this->fotoPerfil,
        'data_nascimento' => $this->dataNasc,
        'curriculo' => $this->curriculo,
        'escolaridade' => $this->escolaridade,
        'video_apresentacao' => $this->videoApresentacao,
        'portfolio' => $this->portfolio,
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
      $sql = "INSERT INTO trabalhador (primeiroNome, ultimoNome, email, senha, salt, biografia, servico, subcategoria, telefone, fotoPerfil, dataNasc, curriculo, escolaridade, videoApresentacao, portfolio, tipoUsuario) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $valores = array($this->primeiroNome, $this->ultimoNome, $this->email, $this->senha, $this->salt, $this->biografia, $this->servico, $this->subcategoria, $this->telefone, $this->fotoPerfil, $this->dataNasc, $this->curriculo, $this->escolaridade, $this->videoApresentacao, $this->portfolio, $this->tipoUsuario);
      $exec = $this->con->prepare($sql);
      $exec->execute($valores);
    }

    function Atualizar() {
      $sql = "UPDATE trabalhador SET primeiroNome = ?, ultimoNome = ?, email = ?, senha = ?, salt = ?, biografia = ?, servico = ?, subcategoria = ?, telefone = ?, fotoPerfil = ?, dataNasc = ?, curriculo = ?, escolaridade = ?, videoApresentacao = ?, portfolio = ?, tipoUsuario = ? WHERE idTrabalhador = ?";
      $valores = array($this->primeiroNome, $this->ultimoNome, $this->email, $this->senha, $this->salt, $this->biografia, $this->servico, $this->subcategoria, $this->telefone, $this->fotoPerfil, $this->dataNasc, $this->curriculo, $this->escolaridade, $this->videoApresentacao, $this->portfolio, $this->tipoUsuario, $this->idTrabalhador);
      $exec = $this->con->prepare($sql);
      $exec->execute($valores);
    }

    function Excluir() {
      $sql = "DELETE FROM trabalhador WHERE idTrabalhador = ?";
      $valores = array($this->idTrabalhador);
      $exec = $this->con->prepare($sql);
      $exec->execute($valores);
    }

    function Consultar() {
      $sql = "SELECT * FROM trabalhador";
      $exec = $this->con->prepare($sql);
      $exec->execute();

      $dados = array();

      foreach($exec->fetchAll() as $valor) {
        $Trabalhador = new Trabalhador();
        $Trabalhador->idTrabalhador = $valor['idTrabalhador'];
        $Trabalhador->primeiroNome = $valor['primeiroNome'];
        $Trabalhador->ultimoNome = $valor['ultimoNome'];
        $Trabalhador->email = $valor['email'];
        $Trabalhador->senha = $valor['senha'];
        $Trabalhador->salt = $valor['salt'];
        $Trabalhador->biografia = $valor['biografia'];
        $Trabalhador->servico = $valor['servico'];
        $Trabalhador->subcategoria = $valor['subcategoria'];
        $Trabalhador->telefone = $valor['telefone'];
        $Trabalhador->fotoPerfil = $valor['fotoPerfil'];
        $Trabalhador->dataNasc = $valor['dataNasc'];
        $Trabalhador->curriculo = $valor['curriculo'];
        $Trabalhador->escolaridade = $valor['escolaridade'];
        $Trabalhador->videoApresentacao = $valor['videoApresentacao'];
        $Trabalhador->portfolio = $valor['portfolio'];
        $Trabalhador->tipoUsuario = $valor['tipoUsuario'];

        $dados[] = $Trabalhador;
      }

      return $dados;
    }

    function RetornaDados() {
      $sql = "SELECT * FROM trabalhador WHERE idTrabalhador = ?";
      $valores = array($this->idTrabalhador);
      $exec = $this->con->prepare($sql);
      $exec->execute($valores);
      $valor = $exec->fetch();

      $Trabalhador = new Trabalhador();
      $Trabalhador->idTrabalhador = $valor['idTrabalhador'];
      $Trabalhador->primeiroNome = $valor['primeiroNome'];
      $Trabalhador->ultimoNome = $valor['ultimoNome'];
      $Trabalhador->email = $valor['email'];
      $Trabalhador->senha = $valor['senha'];
      $Trabalhador->salt = $valor['salt'];
      $Trabalhador->biografia = $valor['biografia'];
      $Trabalhador->servico = $valor['servico'];
      $Trabalhador->subcategoria = $valor['subcategoria'];
      $Trabalhador->telefone = $valor['telefone'];
      $Trabalhador->fotoPerfil = $valor['fotoPerfil'];
      $Trabalhador->dataNasc = $valor['dataNasc'];
      $Trabalhador->curriculo = $valor['curriculo'];
      $Trabalhador->escolaridade = $valor['escolaridade'];
      $Trabalhador->videoApresentacao = $valor['videoApresentacao'];
      $Trabalhador->portfolio = $valor['portfolio'];
      $Trabalhador->tipoUsuario = $valor['tipoUsuario'];

      return $Trabalhador;
    }
  }
?>