<?php 
session_start();

// Verifica se o cliente está logado
if (!isset($_SESSION['idTra'])) {
    header('Location: ../view/login.php');
    exit;
}
    $id = $_SESSION['idTra'];
    require 'conexao.php';
    $sql = "SELECT * FROM trabalhador WHERE idTrabalhador = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $trabalhador = $stmt->fetch(PDO::FETCH_ASSOC);  
    //------------ RECEBE historico----------------//
    $sql = "SELECT * FROM historicofuncionario WHERE idFuncionario = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $historico = $stmt->fetch(PDO::FETCH_ASSOC);  
 

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For All | Perfil trabalhador</title>

    <!--===== AWESOME ICONS =====-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--===== MAIN CSS =====-->
    <link rel="stylesheet" href="../assets/css/main.css">

    <!--===== TELA DE PERFIL DO TRABALHADOR CSS =====-->
    <link rel="stylesheet" href="../assets/css/perfil_trabalhador.css">

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
                        <li><a href="historico_contratacoes.html" class="nav--link">HISTÓRICO DE CONTRATAÇÕES</a></li>
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
            <div class="trabalhador-info">
                <img src="../assets/img/imagemGenerica.png" alt="Logo do trabalhador" class="trabalhador-foto">
                <div class="trabalhador-detalhes">
                 
                    <h2><?php echo $trabalhador['primeiroNome'],$trabalhador['ultimoNome'];?></h2>
                    <p><?php echo $trabalhador['email'];?></p>
                    <p><?php echo $trabalhador['telefone'];?></p>
             
                </div>
                <div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-alt"></i>
                </div>
                <form action="perfil_trabalhador.php" method="post">
                <a href="busca_vaga.php?idTrabalhador=<?= $trabalhador['idTrabalhador']; ?>">Buscar Vaga</a>
                </form>
            </div>

            <div class="curriculo">
                <div class="top">
                    <h3>curriculo</h3>
                    <h3><?php  echo $trabalhador['curriculo'];?></h3>

                    <i class="fa-regular fa-trash"></i>
                </div>
            </div>

            <div class="apresentacoes">
                <h3>Apresentações</h3>
                <br/>
                <form method="post" action="envia_Apresentacao.php"  enctype="multipart/form-data">
                <div class="background">
                    <label for="apresentacaoId">
                        <i class="fa-solid fa-circle-plus"></i>
                        <span>Adicione um vídeo introdutório para as empresas que têm interesse em você</span>
                    </label>
                    <input id="apresentacaoId" type="file" accept="video/*" name="apresentacao">
                    <input type="submit" name="enviar">
                </div>
                </form>
            </div>            

            <div class="historico">
                <h3>Histórico de Contratações</h3>
                <?php if (!empty($historico)): ?>
                <h4><?php echo$historico['idempresa'],$historico['dataContratacao'];?></h4 >
                <?php else: ?>
                    <p> vazio.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="right">
            
        </div>
    </main>

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
