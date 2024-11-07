<?php 
session_start();
  
    $idVaga = $_GET['idVaga'];
    
   // $idVaga = 3;  
    require 'conexao.php';
    $sql = "SELECT tituloVaga, salarioVaga, tipoContrato, cargaHoraria, bairroEmpresa, complemento, descricao, dataPublicacao, idEmpresa 
     FROM vagas 
     WHERE idVaga = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $idVaga);
    $stmt->execute();
    $vaga = $stmt->fetch(PDO::FETCH_ASSOC);

    $idempresa = $vaga['idEmpresa'];

    $sql = "SELECT idTraba, idVagaIntrr FROM interessevags WHERE idEmpresa = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $idempresa);
    $stmt->execute();
    $interrese = $stmt->fetch(PDO::FETCH_ASSOC);  

    $idTraba =  $interrese['idTraba'];
    $idVaga = $interrese['idVagaIntrr'];

    $sql = "SELECT primeiroNome, ultimoNome, email FROM trabalhador WHERE idTrabalhador = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $idTraba);
    $stmt->execute();
    $interreseTrabalhador = $stmt->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For All | Vaga</title>

    <!-- Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Principal -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/vaga_empresa.css">

    <!-- Scripts JS -->
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/vaga_empresa.js"></script>

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
<?php
    
    ?>
    
    <header>
        <div class="header--container">
            <div class="logo--nav">
                <a href="../index.html">
                    <h1 class="logo">FOR ALL</h1>
                </a>
                <nav>
                    <ul class="nav--container">
                        <li><a href="" class="nav--link">ENCONTRE TRABALHADORES</a></li>
                        <li><a href="" class="nav--link">HISTÓRICO DE CONTRATAÇÕES</a></li>
                        <li><a href="" class="nav--link">NETWORKING</a></li>
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

    <main class="container">
        <?php
        ?>

        <div class="title-container">
            <h2 class="job-title"><?php echo $vaga['tituloVaga']; ?></h2>
            <p class="date">Publicado em <?php echo $vaga['dataPublicacao']; ?> 
            <br>interessados: <?php   
            echo $interreseTrabalhador['primeiroNome'],$interreseTrabalhador['ultimoNome'], $vaga['tituloVaga'];?>
            <br>
            <?php echo $interreseTrabalhador['email']?>
            </p>

        </div>

        <div class="job-columns">
            <div class="job-details">
                <div class="job-header">
                    <h2>Sobre a Vaga</h2>
                    <p class="salary">R$<?php echo $vaga['salarioVaga']; ?></p>
                </div>
                <p class="job-info"><strong>Tipo de contrato:</strong> <?php echo $vaga['tipoContrato']; ?></p>
                <p class="job-info"><strong>Carga horária semanal:</strong> <?php echo $vaga['cargaHoraria']; ?></p>
                <p class="job-info"><strong>Endereço da empresa:</strong> <?php echo$vaga['bairroEmpresa'] . ", " . $vaga['complemento']; ?></p>
                <p class="job-info"><strong>Descrição da vaga:</strong> <?php echo $vaga['descricao']; ?></p>
            </div>

            <div class="right-column">
                <button class="edita-button" onclick="editarVaga(<?php echo $vaga['idVaga']; ?>)">Editar Vaga</button>
                <button class="cancela-button" onclick="cancelarVaga(<?php echo $vaga['idVaga']; ?>)">Cancelar Vaga</button>
                <button class="ativa-button" onclick="ativarVaga(<?php echo $vaga['idVaga']; ?>)">Ativar Vaga</button>

                <hr class="divider">

                <div class="user-info">
                    <img src="icone-rosto.png" alt="Ícone de rosto" class="user-icon">
                    <div class="user-details">
                        <p class="user-name">Eloisa B.</p>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="job-info-container">
                    <p class="job-info">6 Vagas Publicadas</p>
                    <p class="job-info">5 Trabalhadores Contratados</p>
                </div>
            </div>
        </div>
    </main>

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
