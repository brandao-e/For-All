<?php
    session_start();
  if (!isset($_SESSION['idEmp'])) {
        header("Location: ../view/login.php");
        exit;
    }

    $id = $_SESSION['idEmp'];
    require 'conexao.php';
    $sql = "SELECT * FROM empresa WHERE idempresa = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $empresa = $stmt->fetch(PDO::FETCH_ASSOC);  

    $sql = "SELECT idVaga, tituloVaga, salarioVaga, dataPublicacao, statusVaga FROM vagas WHERE idEmpresa = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $vagas = $stmt->fetch(PDO::FETCH_ASSOC);  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For All | Perfil Empresa</title>

    <!--===== AWESOME ICONS =====-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--===== MAIN CSS =====-->
    <link rel="stylesheet" href="../assets/css/main.css">

    <!--===== TELA DE PERFIL DA EMPRESA CSS =====-->
    <link rel="stylesheet" href="../assets/css/perfil_empresa.css">

    <!--===== SCRIPT JS =====-->
    <script src="../assets/js/script.js"></script>

    <style>
        html, body {
            margin: 0;
            overflow: auto;
        }

        .header--container .icon {
            gap: 24px;
        }
    </style>

</head>
<body>
    <header>
        <div class="header--container">
            <div class="logo--nav">
                <a href="../index.html">
                    <h1 class="logo">FOR ALL</h1>
                </a>
                <nav>
                    <ul class="nav--container">
                        <li><a href="busca_trabalhadores.html" class="nav--link">ENCONTRE TRABALHADORES</a></li>
                        <li><a href="historico_contratacoes.php" class="nav--link">HISTÓRICO DE CONTRATAÇÕES</a></li>
                        <li><a href="networking.html" class="nav--link">NETWORKING</a></li>
                    </ul>
                </nav>
            </div>
            <div class="theme-icon icon">
                <i class="fa-solid fa-moon"></i>
                <i class="fa-solid fa-comments"></i>
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
    </header>
    <br/><br/><br/>

    <main class="container">
        <div class="left">
            <div class="empresa-info">
                <img src="../assets/img/imagemGenerica.png" alt="Logo da Empresa" class="empresa-foto">
                <div class="empresa-detalhes">
                    <h2><?php echo $empresa['primeiroNome'];?></h2>
                    <p><?php echo $empresa['email'];?></p>
                    <p><?php echo $empresa['cnpj'];?></p>
                </div>
                <div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-alt"></i>
                </div>
                <form action="mostraInteresse.php" method="post">
                <button class="encontrar-trabalhadores" type="submit">Encontre Trabalhadores</button>
                <a href="../view/cadVaga.php">cadastrar vaga</a>
                </form>
               
            </div>

            <div class="apresentacoes">
                <h3>Apresentações</h3>
                <br/>
                <textarea placeholder="Adicione um vídeo introdutório para os trabalhadores que têm interesse em você"></textarea>
            </div>

            <div class="historico">
                <h3>Histórico de Contratações</h3>
                <h4>Vazio...</h4    >
            </div>
        </div>

        <div class="right">
            <h2>Projetos em que estou contratando</h2>
            <?php if (!empty($vagas)): ?>
                <?php for($i = 0;  $i < count($vagas); $i++){ ?>
                    <div class="vaga">
                        <h3>
                            <a href="vaga_empresa.php?idVaga=<?php echo $vagas['idVaga']; ?>" class="vaga-titulo">
                                <?php echo $vagas['tituloVaga']; ?>
                            </a>
                        </h3>
                        <p>Publicado: <?php echo $vagas['dataPublicacao']; ?></p>
                        <div class="vaga-footer">
                            <p class="salary">Salário: R$ <?php echo$vagas['salarioVaga']; ?></p>
                            <div class="vaga-status <?php echo $vagas['statusVaga']; ?>">
                                <?php echo $vagas['statusVaga']; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php else:  ?>
                <p>Nenhuma vaga disponível.</p>
            <?php endif; ?>
        </div>
    </main>
    <br/><br/><br/>
    <br/><br/><br/>

    <footer>
        <div class="top">
            <h2 class="footer--logo">FOR ALL</h2>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
        </div>

        <div class="content">
            <div class="column">
                <h3 class="bold">Quem Somos?</h3>
                <a href="sobrenos.html" class="clear--link">Sobre Nós</a>
                <a href="#" class="clear--link">Contato</a>
                <a href="#" class="clear--link">Políticas For All</a>
        </div>

        <div class="column">
            <h3 class="bold">Recursos</h3>
            <a href="#" class="clear--link">Central de Ajuda</a>
            <a href="#" class="clear--link">Como Funciona?</a>
        </div>

        <div class="column">
            <h3 class="bold">Encontre Trabalho</h3>
            <a href="#" class="clear--link">TI e Programação</a>
            <a href="#" class="clear--link">Design e Multimedia</a>
            <a href="#" class="clear--link">Marketing e Vendas</a>
            <a href="#" class="clear--link">Escrita e Conteúdos</a>
            <a href="#" class="clear--link">Administração</a>
            <a href="#" class="clear--link">Finanças</a>
            <a href="#" class="clear--link">Jurídico</a>
            <a href="#" class="clear--link">Engenharia e Manufatura</a>
        </div>
    </footer>
</body>
</html>
