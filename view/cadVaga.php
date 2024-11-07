<?php
    
	require '../model/ConexaoVagas.php';

	$db = new Conexao();
                           

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For All | Cadastro vaga</title>

    <!-- Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/cadVaga.css">

    <!-- JavaScript -->
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/cadVaga.js"></script>

</head>
<body>
    <header>
        <div class="header--container">
            <div class="logo--nav">
                <a href="../index.html"><h1 class="logo">FOR ALL</h1></a>
            </div>
            <div class="theme-icon icon">
                <i class="fa-solid fa-moon"></i>
            </div>
        </div>
    </header>

  <main>
</br>
    <h3>Descreva a Vaga</h3>
    </br>
    <form id="form-vaga" method="post" action="../controller/processa_vaga.php">
            <div class="container">
                <div class="left">

                    <div class="row">
                        <input class="input" type="text" name="tituloVaga" id="tituloVaga" placeholder="Título da Vaga" required>
                        <input class="input" type="text" name="salarioVaga" id="salarioVaga" placeholder="Salário" required>
                    </div>
                    <div class="row">
                       <select name="estado">
                            <?php $id = $db->getEstados(); ?>
                                <option value="valor">Selecione um estado</option> 
                            <?php
                            for ($i = 0; $i < count($id); $i++) { ?>
                                <option value="<?php echo $id[$i]['idEstado']; ?>">
                                <?php echo $id[$i]['estado']; ?>
                                </option>
                                <?php } ?>
                        </select>
                        <select name="cidade">
                            <?php $id = $db->getCidade(); ?>
                            <option value="valor">Selecione um cidade</option> 
                            <?php
                            for ($i = 0; $i < count($id); $i++) { ?>
                                <option value="<?php echo $id[$i]['idCidade']; ?>">
                                    <?php echo $id[$i]['cidade']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="row">
                        <input class="input" type="text" name="bairroEmpresa" id="bairroEmpresa" placeholder="Bairro" required>
                        <input class="input" type="text" name="complemento" id="complemento" placeholder="Complemento" required>
                    </div>

                    <div class="row">
                        <input class="input" type="text" name="tipoContrato" id="tipoContrato" placeholder="Tipo de Contrato" required>
                        <input class="input" type="text" name="servicoVaga" id="servicoVaga" placeholder="Serviço da Vaga" required>
                    </div>

                    <div class="row">
                        <input class="input" type="text" name="cargaHoraria" id="cargaHoraria" placeholder="Carga Horaria" required>
                        <input class="input" type="date" name="dataPublicacao" id="dataPublicacao" placeholder="Data de Publicação" required>
                    </div>
                </div>

                <div class="right">
                    <input type="text" name="descricao" id="descricao" cols="30" rows="10" placeholder="Descreva a Vaga">
                    <div class="btn">
                        <input class="outline--link" type="submit" value="CADASTRAR VAGA">
                    </div>
                </div>
            </div>
        </form>
  </main>
</body>
</html>