<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Controle de Processos</title>
    <link rel="icon" type="imagem/png" href="favicon.png" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.min.js"></script>

</head>

<body id="login">
    <?php
    require('db.php');
    session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        //Checking is user existing in the database or not
        $query = "SELECT * FROM `user` WHERE nome='$username' and senha='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die();
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect user to index.php
            header("Location: index.php");
        } else {
            echo "<div class='login-errado' id='form-login-php'><h3 id='login-errado-titulo'>Usuário(a) ou senha incorretos</h3><br/><a class='btn btn-danger' href='login.php'>Tentar novamente?</a></div>";
        }
    } else {
        ?>
        <div id="header-login">
            <img id="ief-logo" src="images/ief-logo.png" class="img-fluid" alt="Responsive image">
            <h2 class="titulo-login">Bem-vindo(a) ao Controle de Processos de Interveção Ambiental</h2>
        </div>
        <div id="form-login">
            <h3 class="titulo-login">Realize seu login</h3>
            <form action="" method="post" name="login">
                <div class="form-group">
                    <label for="username">Usuario(a)</label>
                    <input type="text" name="username" class="form-control" placeholder="Usuário(a)" required />
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="password" class="form-control" placeholder="Senha" required />
                </div>

                <input class="btn btn-success" name="submit-login" type="submit" value="Entrar" />
            </form>

            <!-- <p><a href='registration.php'>Registrar</a></p> -->
        </div>
        <p id="novo-cadastro">Solicitar cadastro de usuário no email: marcos.junior@meioambiente.mg.gov.br</p>
    <?php } ?>
    <script src="functions.js"></script>
</body>

</html>