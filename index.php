<!DOCTYPE html>
<html>

<?php
//include auth.php file on all secure pages
include("auth.php");
?>

<head>
    <meta charset="utf-8">
    <title>Controle de Processos</title>
    <link rel="icon" type="imagem/png" href="favicon.png" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.min.js"></script>
</head>

<body>
    <!-- header -->
    <div class="container-fluid" id="index-header">
        <h1 id="titulo">Controle de Processos de Interveção Ambiental</h1>
        <h5 id="nome">Bem Vindo(a) <?php echo $_SESSION['username']; ?>!</h5>
        <a class="btn btn-outline-light" href="logout.php">Sair</a>
    </div>

    <!-- tools-bar -->
    <div class="container-fluid" id="tools-bar">
        <button class="btn btn-outline-dark" id="cadastrar-btn">Cadastrar Processo</button>
        <a href="index.php" class="btn btn-outline-dark" id="todos-btn">Todos</a>
        <form action="" method="POST" id="consultar-form">
            <select class="form-control" name="coluna">
                <option value="requerente">Requerente</option>
                <option value="sgp">SGP</option>
                <option value="cpf">CPF/CNPJ</option>
                <option value="data_entrada">Data de Entrada</option>
                <option value="tipo_pedido">Tipo de Pedido</option>
                <option value="estagio">Status</option>
            </select>
            <input class="form-control" type="text" name="keyword" placeholder="Palavras-Chave">
            <input class="btn btn-outline-dark" id="consultar-btn" type="submit" name="cunsultar" value="Consultar">
        </form>
    </div>

    <!-- cadastrar-editar-window' -->
    <div class="container-fluid" id="cadastrar-div">
        <form action="cadastro.php" method="POST" id="cadastrar-form">
            <div class="form-group row editar-div">
                <div class="col-md-5">
                    <h4><?php echo $_SESSION['username']?> deseja editar o processo de nº SGP:</h4>
                </div>
                <div class="col-md-7">
                    <input class="form-control" readonly="true" type="text" id="sgp-editar" name="sgp-editar">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4 mb-3">
                    <label for="requerente">Requerente</label>
                    <input class="form-control" type="text" id="requerente-input" name="requerente" placeholder="Requerente">
                </div>
                <div class="col-md-4">
                    <label for="sgp">SGP</label>
                    <input class="form-control" type="text" id="sgp-input" name="sgp" placeholder="SGP">
                </div>
                <div class="col-md-4">
                    <label for="cpf">CPF/CNPJ</label>
                    <input class="form-control" type="text" name="cpf" id="cpf-input" placeholder="CPF/CNPJ">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-4 mb-3">
                    <label for="data_entrada">Data de Entrada</label>
                    <input class="form-control data" type="text" name="data_entrada" id="data_entrada-input" placeholder="Data de Entrada">
                </div>
                <div class="col-md-8">
                    <label for="tipo_pedido">Tipo de Pedido</label>
                    <select class="form-control" name="tipo_pedido" id="tipo_pedido-input">
                        <option value="Relocação">Relocação</option>
                        <option value="Recomposição">Recomposição</option>
                        <option value="Compesação">Compesação</option>
                        <option value="Compensação Social de Reserva Legal">Compensação Social de Reserva Legal</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-8 mb-3">
                    <label>Status</label>
                    <select class="form-control" name="status" id="estagio-input">
                        <option value="Em analise">Em analise</option>
                        <option value="Analisado">Analisado</option>
                        <option value="Informações Complementares">Informações Complementares</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Data de Saida</label>
                    <input class="form-control data" type="text" id="data_saida-input" name="data_saida" placeholder="Data de Saida"><br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 mb-3">
                    <input class="btn btn-success" id="cadastrar-editar-btn" type="submit" name="enviar" value="Cadastrar">
                </div>
                <div class="col-md-2 mb-3">
                    <a href="index.php" id="cancel-btn" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

    <!-- confirmar-window -->
    <div id="confirmar-window">
        <div id="confirmar-window-container">
            <div>
                <div>
                    <h4 id="h4-confirmar">Confirmar exclusão do processo?</h4>
                </div>
            </div>

            <form action="excluir.php" method="POST">
                <div>
                    <input type="text" id="sgp-processo" name="sgp" readonly="true">
                </div>

                <div id="confirmar-buttons">
                    <div>
                        <input type="submit" class="btn btn-success btn-confirmar" name="enviar" value="Sim">
                    </div>
                    <div>
                        <a href="index.php" id="cancel-btn" class="btn btn-danger btn-confirmar">Não</a>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- tabela-main -->
    <table class="Table">
        <thead>
            <tr class="Table-row Table-header">
                <th class="Table-row-item">Requerente</th>
                <th class="Table-row-item">Tipo de Pedido</th>
                <th class="Table-row-item">SGP</th>
                <th class="Table-row-item">CPF/CNPJ</th>
                <th class="Table-row-item">Entrada</th>
                <th class="Table-row-item">Saida</th>
                <th class="Table-row-item">Status</th>
                <th class="Table-row-item">Operações</th>
            </tr>
        </thead>
        <tbody class="row-collection">
            <?php
            include("db.php");

            // if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
            //     $page_no = $_GET['page_no'];
            // } else {
            //     $page_no = 1;
            // }

            // $total_records_per_page = 5;
            // $offset = ($page_no - 1) * $total_records_per_page;
            // $previous_page = $page_no - 1;
            // $next_page = $page_no + 1;
            // $adjacents = "2";

            if (!isset($_POST['keyword'])) {
                // $result_count = mysqli_query($con, "SELECT COUNT(*) As total_records FROM `processos`");
                // $total_records = mysqli_fetch_array($result_count);
                // $total_records = $total_records['total_records'];

                // $total_no_of_pages = ceil($total_records / $total_records_per_page);
                // $second_last = $total_no_of_pages - 1; // total pages minus 1

                // $result = mysqli_query($con, "SELECT * FROM `processos` LIMIT $offset,$total_records_per_page");
                $result = mysqli_query($con, "SELECT * FROM processos order by requerente asc");
            } else {
                $keyword = $_POST['keyword'];
                $coluna = $_POST['coluna'];

                // $result_count = mysqli_query($con, "SELECT * FROM processos WHERE $coluna LIKE '%$keyword%'");
                // $total_records = mysqli_num_rows($result_count);

                // $total_no_of_pages = ceil($total_records / $total_records_per_page);
                // $second_last = $total_no_of_pages - 1; // total pages minus 1

                // $result = mysqli_query($con, "SELECT * FROM processos WHERE $coluna LIKE '%$keyword%' LIMIT $offset, $total_records_per_page");
                $result = mysqli_query($con, "SELECT * FROM processos WHERE $coluna LIKE '%$keyword%' order by requerente asc");
            }

            while ($row = mysqli_fetch_array($result)) {
                echo "<tr class='Table-row'>
                 <td class='Table-row-item' id='requerente'>" . $row['requerente'] . "</td>
                 <td class='Table-row-item' id='tipo_pedido'>" . $row['tipo_pedido'] . "</td>
                 <td class='Table-row-item' id='sgp'>" . $row['sgp'] . "</td>
                 <td class='Table-row-item' id='cpf'>" . $row['cpf'] . "</td>
                 <td class='Table-row-item' id='data_entrada'>" . $row['data_entrada'] . "</td>
                 <td class='Table-row-item' id='data_saida'>" . $row['data_saida'] . "</td>
                 <td class='Table-row-item' id='estagio'>" . $row['estagio'] . "</td>
                 <td class='Table-row-item'><button class='btn btn-outline-danger excluir-btn'>Excluir</button><button class='btn btn-outline-success editar-btn'>Editar</button></td>
                 </tr>";
            }
            mysqli_close($con);

            ?>

        </tbody>
    </table>
    </div>
    </div>


    <!-- <div id="numero-de-pagina">
        <strong>Página <?php echo $page_no . " de " . $total_no_of_pages; ?></strong>
    </div> -->

    <!-- <div id="selecao">
        <ul>
            <?php if ($page_no > 1) {
                echo "<li><a href='?page_no=$previous_page'>Anterior</a></li>";
            }

            if ($total_no_of_pages <= 10) {
                for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                    if ($counter == $page_no) {
                        echo "<li class='active'><a>$counter</a></li>";
                    } else {
                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                    }
                }
            } elseif ($total_no_of_pages > 10) {
                if ($page_no <= 4) {
                    for ($counter = 1; $counter < 8; $counter++) {
                        if ($counter == $page_no) {
                            echo "<li class='active'><a>$counter</a></li>";
                        } else {
                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                        }
                    }
                    echo "<li><a>...</a></li>";
                    echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                    echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                    echo "<li><a href='?page_no=1'>1</a></li>";
                    echo "<li><a href='?page_no=2'>2</a></li>";
                    echo "<li><a>...</a></li>";
                    for (
                        $counter = $page_no - $adjacents;
                        $counter <= $page_no + $adjacents;
                        $counter++
                    ) {
                        if ($counter == $page_no) {
                            echo "<li class='active'><a>$counter</a></li>";
                        } else {
                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                        }
                    }
                    echo "<li><a>...</a></li>";
                    echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                    echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                } else {
                    echo "<li><a href='?page_no=1'>1</a></li>";
                    echo "<li><a href='?page_no=2'>2</a></li>";
                    echo "<li><a>...</a></li>";
                    for (
                        $counter = $total_no_of_pages - 6;
                        $counter <= $total_no_of_pages;
                        $counter++
                    ) {
                        if ($counter == $page_no) {
                            echo "<li class='active'><a>$counter</a></li>";
                        } else {
                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                        }
                    }
                }
            }

            if ($page_no < $total_no_of_pages) {
                echo "<li><a href='?page_no=$next_page'>Proxima</a></li>";
            }

            if ($page_no < $total_no_of_pages) {
                echo "<li><a href='?page_no=$total_no_of_pages'>Ultima</a></li>";
            } ?>
        </ul>
    </div> -->
    <script src="functions.js"></script>
</body>

</html>