<?php 
//---------- INICIANDO A SESSÃO -------------// 
session_start(); 

//----------- ESTABELECENDO A CONEXÃO -------//
/*require_once 'conexao.php';
$conn = new Conexao();
//------------ PEGANDO AS VARIAVEIS ---------//
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$pNome = $_SESSION['pNome'];
$uNome = $_SESSION['uNome'];
$Email = $_SESSION['email'];
$senha = $_SESSION['password'];
$xp = $_SESSION['xp'];
$bio = $_SESSION['bio'];
$servico = $_SESSION['servico'];
$subcategoria = $_SESSION['subcategoria'];
$dataNas = $_SESSION['data'];
$telefone = $_SESSION['telefone'];
$foto = $_SESSION['foto'];
 $conn->inserirDadosFuncionario($pNome, $uNome, $Email, $senha, $xp, $bio, $servico,  $subcategoria, $telefone, $dataNas, $foto);
}

*/
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For All | Cadastro</title>

    <!--===== AWESOME ICONS =====-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--===== MAIN CSS =====-->
    <link rel="stylesheet" href="../assets/css/main.css">

    <!--===== FORMCADASTROFUNC CSS =====-->
    <link rel="stylesheet" href="../assets/css/formCadastroFunc.css">

    <!--===== FORMCADFUNCFINAL CSS =====-->
    <link rel="stylesheet" href="../assets/css/formCadFuncFinal.css">

    <!--===== SCRIPT JS =====-->
    <script src="../assets/js/script.js"></script>
</head>
<body>
    <header>
        <div class="header--container">
          <div class="logo--nav">
            <a href="../index.html">
              <h1 class="logo">FOR ALL</h1>
            </a>
          </div>
          
          <div class="theme-icon icon">
            <i class="fa-solid fa-moon"></i>
          </div>
        </div>
    
        <div class="mobile">
          <div class="logo--icon">
            <a href="../index.html">
              <h1 class="logo">FOR ALL</h1>
            </a>
    
            <div class="icon icon-bars">
              <i class="fa-solid fa-bars"></i>
            </div>
    
            <div class="dropdown">
              <div class="top">
                <a href="../index.html">
                  <h1 class="logo">FOR ALL</h1>
                </a>
    
                <div class="icon icon-xmark">
                  <i class="fa-solid fa-xmark"></i>
                </div>
              </div>
              <div class="content">
                <div class="mid">
                  <div class="link--group">
                    <a href="login.html" class="solid--link">LOGIN</a>
                    <a href="rdb-cadastro.html" class="outline--link">CADASTRE-SE</a>
                  </div>
                  <div class="theme-icon icon">
                    <i class="fa-solid fa-moon"></i>
                  </div>
                </div>
    
                <nav>
                  <ul class="nav--container">
                    <li><a href="../index.html" class="strong--link active">QUERO CONTRATAR</a></li>
                    <li><a href="index-funcionario.html" class="strong--link">QUERO TRABALHAR</a></li>
                  </ul>
                </nav>
                </div>
            </div>
            </div>
        </div>
    </header>

  <main>
    <div class="container">
        <div class="top">
            <?php 
         
             
            ?>
          <form action="processarCadastro.php">
            <p>Está ótimo, <?php //session_start(); 
            echo$pNome = $_SESSION['pNome'];?></p>
            <p>Confira as informações, se precisar volte e faça quaisquer edições que desejar e, em seguida, envie seu perfil. Você pode fazer mais alterações, limitadas, depois que ele estiver publicado.</p>
            <!-- este link levará para a primeira página de cadastro, onde os inputs já estarão preenchidos com as informações antes colocadas lá -->
            <a href="cadFuncionario-1.html" class="solid--link">Editar perfil</a>
        </div>

        <div class="bottom">
            <div class="container">
                <div class="img">
                  <!-- imagem cadastrada com php -->
                  <img src="<?php echo $_SESSION['foto']; ?>" alt="Foto do Funcionário">
                </div>

                <div> 
                    <h2> <?php echo $pnome = $_SESSION['pNome'];?></h2>
                    <p><?php echo $_SESSION['email']?></p>
                </div>
            </div>
            <h4>serviço</h4>
            <div class="content">
                <h3><?php  $servico = $_SESSION['slcPesquisarServico'];
                  if($servico == 1){
                    echo "Jovem Aprendiz";
                  }
                  else if($servico == 2){
                    echo "Contrato CLT";
                  }
                  else{
                    echo"Teceirizado (CLT)";
                  }
                  ?></h3>
                <!-- biografia -->
                <p><?php echo $bio = $_SESSION['biografia']
                ?></p>

                <h4>Subcategoria do serviço</h4>
                <!-- subcategoria selecionada -->
                <p><?php  $subcategoria = $_SESSION['slcPesquisarSubCategoria'];
                 if($subcategoria == 1){
                  echo "Jovem Aprendiz";
                }
                else if($subcategoria == 2){
                  echo "Contrato CLT";
                }
                else{
                  echo"Teceirizado (CLT)";
                }?></p>
            </div>
        </div>
    </div>

    <div class="bottom-content">
      <!-- Quando este link for clicado deverá confirmar o cadastro do funcionario na plataforma -->
      <button type="submit">Enviar Perfil</button>

    </div>
              </form>
  </main>    
</body>
</html>