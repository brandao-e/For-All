<?php 
session_start();
//require 'conexao.php';
include 'conexaoConsulta.php';

$db = new conexao();
$id = $db->getVagas();

if(isset($_GET['idTrabalhador'])){
    $idTrabalhador = $_GET['idTrabalhador'];
    $_SESSION['idTraba'] = $idTrabalhador;
}
else {
    echo "trabalhador nao encontrado!";
}

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeVaga = $_POST['nomeVaga'];

    require 'conexao.php';
    $sql = "SELECT * FROM vagas WHERE tituloVaga = :nome";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nomeVaga);
    $stmt->execute();
    $pesquisa = $stmt->fetch(PDO::FETCH_ASSOC);  
   
}


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For All | Busca de Vagas</title>

    <!--===== AWESOME ICONS =====-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--===== MAIN CSS =====-->
    <link rel="stylesheet" href="../assets/css/main.css">

    <!--===== BUSCA DE VAGAS CSS =====-->
    <link rel="stylesheet" href="../assets/css/busca_vaga.css">

    <!--===== SCRIPT JS =====-->
    <script src="../assets/js/script.js"></script>

    <!--===== FILTRO JS =====-->
    <script src="../assets/js/filtro.js"></script>

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
                        <li><a href="busca_vaga.html" class="nav--link active">ENCONTRE TRABALHO</a></li>
                        <li><a href="historico_empresas.html" class="nav--link">HISTÓRICO DE EMPRESAS</a></li>
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

    <main>
        <div class="container">
            <div class="left">
                <h3>Categoria da Vaga</h3>
                <br/>
                <div class="categories">
                    <label><input type="checkbox" checked>Todas as categorias</label>
                    <label><input type="checkbox">TI & Programação</label>
                    <label><input type="checkbox">Design & Multimedia</label>
                    <label><input type="checkbox">Marketing & Vendas</label>
                    <label><input type="checkbox">Escrita & Conteúdos</label>
                    <label><input type="checkbox">Administração</label>
                    <label><input type="checkbox">Finanças</label>
                    <label><input type="checkbox">Jurídico</label>
                    <label><input type="checkbox">Engenharia e Manufatura</label>
                </div>
            </div>

            <div class="right">
                <form action="busca_vaga.php" method="POST">
                <div class="search-bar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Pesquise trabalho..." name="nomeVaga" />
                    <input type="submit" value="Pesquise" />
                </div>
                </form>
                
                <div class="selected-categories">
                    <div id="filters-container"></div>
                </div>
                <?php if(!empty($pesquisa)):?>
                <div class="selected-categories">
                    <div id="filters-container"></div>
                </div>
<?php    //for($i = 0; $i < count($pesquisa); $i++) 
     // {

        ?>
                <div class="vacancy">
                    <h3><a><a href="vaga.php?idVaga=<?= $pesquisa['idVaga']; ?>"><?php echo $pesquisa['tituloVaga'];?></a></a></h3>
                    <button class="demonstrar-interesse">Demonstre Interesse</button>
                    <p class="data-publicacao"><?php echo $pesquisa['dataPublicacao'];?></p>
                    <div class="info">
                        <p class="salario"><?php echo $pesquisa['salarioVaga'];?></p>
                    </div>
                    
                    <div class="vaga-info">
                        <div class="empresa">
                            <p class="descricao"><?php echo $pesquisa['descricao'];?></p>
                            <br/>
                            <div class="categoria categoriaMain"></div>
                            <br/>
                            <i class="fa-solid fa-smile"></i><?php
                            $idEmpr = $pesquisa['idEmpresa'];
                            require 'conexao.php';
                            $sql = "SELECT * FROM empresa WHERE idempresa = :id";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $idEmpr);
                            $stmt->execute();
                            $Empresa = $stmt->fetch(PDO::FETCH_ASSOC);   
                            echo $Empresa['primeiroNome'],$Empresa['ultimoNome'];?>
                     </div>
                    </div>
                
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-alt"></i>
                    </div>
                </div>
                <?php //}?>
                

            </div>
        </div>
        <?php else: ?>
<?php    for($i = 0; $i < count($id); $i++) 
      {

        ?>
                <div class="vacancy">
                    <h3><a href="vaga.php?idTra=<?= $idTrabalhador ?>"><a href="vaga.php?idVaga=<?= $id[$i]['idVaga']; ?>"><?php echo $id[$i]['tituloVaga'];?></a></a></h3>
                    <button class="demonstrar-interesse">Demonstre Interesse</button>
                    <p class="data-publicacao"><?php echo $id[$i]['dataPublicacao'];?></p>
                    <div class="info">
                        <p class="salario"><?php echo $id[$i]['salarioVaga'];?></p>
                    </div>
                    
                    <div class="vaga-info">
                        <div class="empresa">
                            <p class="descricao"><?php echo $id[$i]['descricao'];?></p>
                            <br/>
                            <div class="categoria categoriaMain"></div>
                            <br/>
                            <i class="fa-solid fa-smile"></i><?php
                            $idEmpr = $id[$i]['idEmpresa'];
                            require 'conexao.php';
                            $sql = "SELECT * FROM empresa WHERE idempresa = :id";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $idEmpr);
                            $stmt->execute();
                            $Empresa = $stmt->fetch(PDO::FETCH_ASSOC);   
                            echo $Empresa['primeiroNome'],$Empresa['ultimoNome'];?>
                     </div>
                    </div>
                
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-alt"></i>
                    </div>
                </div>
                <?php }?>
            
        <div class="pagination">
            <button class="active">1</button>
            <button>2</button>
            <button>3</button>
            <button>4</button>
            <button>5</button>
            <button>6</button>
        </div>
    </main>

    <br/><br/><br/>
    <?php endif; ?>
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