<?php 
  class Vaga implements JsonSerializable{
    private $idVaga;
    private $servicoVaga;
    private $tituloVaga;
    private $salarioVaga;
    private $tipoContrato;
    private $cargaHoraria;
    private $estadoEmpresa;
    private $cidadeEmpresa;
    private $bairroEmpresa;
    private $complemento;
    private $descricao;
    private $dataPublicacao;
    private $idEmpresa;
    private $statusVaga;
    private $con;

    function jsonSerialize(): mixed {
      return [
        'id_vaga' => $this->idVaga,
        'servico_vaga' => $this->servicoVaga,
        'titulo_vaga' => $this->tituloVaga,
        'salario_vaga' => $this->salarioVaga,
        'tipo_contrato' => $this->tipoContrato,
        'carga_horaria' => $this->cargaHoraria,
        'estado_empresa' => $this->estadoEmpresa,
        'cidade_empresa' => $this->cidadeEmpresa,
        'bairro_empresa' => $this->bairroEmpresa,
        'complemento' => $this->complemento,
        'descricao' => $this->descricao,
        'data_publicacao' => $this->dataPublicacao,
        'id_empresa' => $this->idEmpresa,
        'status_vaga' => $this->statusVaga
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
      $sql = "INSERT INTO vaga (servicoVaga, tituloVaga, salarioVaga, tipoContrato, cargaHoraria, estadoEmpresa, cidadeEmpresa, bairroEmpresa, complemento, descricao, dataPublicacao, idEmpresa, statusVaga) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $valores = array($this->servicoVaga, $this->tituloVaga, $this->salarioVaga, $this->tipoContrato, $this->cargaHoraria, $this->estadoEmpresa, $this->cidadeEmpresa, $this->bairroEmpresa, $this->complemento, $this->descricao, $this->dataPublicacao, $this->idEmpresa, $this->statusVaga);
      $exec = $this->con->prepare($sql);
      $exec->execute($valores);
    }

    function Atualizar() {
      $sql = "UPDATE vaga SET servicoVaga = ?, tituloVaga = ?, salarioVaga = ?, tipoContrato = ?, cargaHoraria = ?, estadoEmpresa = ?, cidadeEmpresa = ?, bairroEmpresa = ?, complemento = ?, descricao = ?, dataPublicacao = ?, statusVaga = ? WHERE idVaga = ?";
      $valores = array($this->servicoVaga, $this->tituloVaga, $this->salarioVaga, $this->tipoContrato, $this->cargaHoraria, $this->estadoEmpresa, $this->cidadeEmpresa, $this->bairroEmpresa, $this->complemento, $this->descricao, $this->dataPublicacao, $this->statusVaga, $this->idVaga);
      $exec = $this->con->prepare($sql);
      $exec->execute($valores);
    }

    function Excluir() {
      $sql = "DELETE FROM vaga WHERE idVaga = ?";
      $valores = array($this->idVaga);
      $exec = $this->con->prepare($sql);
      $exec->execute($valores);
    }

    function Consultar() {
      $sql = "SELECT * FROM vaga";
      $exec = $this->con->prepare($sql);
      $exec->execute();

      $dados = array();

      foreach($exec->fetchAll() as $valor) {
        $Vaga = new Vaga();
        $Vaga->idVaga = $valor['idVaga'];
        $Vaga->servicoVaga = $valor['servicoVaga'];
        $Vaga->tituloVaga = $valor['tituloVaga'];
        $Vaga->salarioVaga = $valor['salarioVaga'];
        $Vaga->tipoContrato = $valor['tipoContrato'];
        $Vaga->cargaHoraria = $valor['cargaHoraria'];
        $Vaga->estadoEmpresa = $valor['estadoEmpresa'];
        $Vaga->cidadeEmpresa = $valor['cidadeEmpresa'];
        $Vaga->bairroEmpresa = $valor['bairroEmpresa'];
        $Vaga->complemento = $valor['complemento'];
        $Vaga->descricao = $valor['descricao'];
        $Vaga->dataPublicacao = $valor['dataPublicacao'];
        $Vaga->statusVaga = $valor['statusVaga'];

        $dados[] = $Vaga;
      }

      return $dados;
    }

    function RetornaDados() {
      $sql = "SELECT * FROM vaga WHERE idVaga = ?";
      $valores = array($this->idVaga);
      $exec = $this->con->prepare($sql);
      $exec->execute($valores);
      $valor = $exec->fetch();

      $Vaga = new Vaga();
      $Vaga->idVaga = $valor['idVaga'];
      $Vaga->servicoVaga = $valor['servicoVaga'];
      $Vaga->tituloVaga = $valor['tituloVaga'];
      $Vaga->salarioVaga = $valor['salarioVaga'];
      $Vaga->tipoContrato = $valor['tipoContrato'];
      $Vaga->cargaHoraria = $valor['cargaHoraria'];
      $Vaga->estadoEmpresa = $valor['estadoEmpresa'];
      $Vaga->cidadeEmpresa = $valor['cidadeEmpresa'];
      $Vaga->bairroEmpresa = $valor['bairroEmpresa'];
      $Vaga->complemento = $valor['complemento'];
      $Vaga->descricao = $valor['descricao'];
      $Vaga->dataPublicacao = $valor['dataPublicacao'];
      $Vaga->statusVaga = $valor['statusVaga'];

      return $Vaga;
    }
  }
?>