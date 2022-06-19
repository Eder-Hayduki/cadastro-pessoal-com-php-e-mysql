<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="restricted/css/bootstrap.min.css" />
    <link rel="stylesheet" href="restricted/estilos/style.css">
    <title>Cadastre-se</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="jumbotron">
                <h4 class="display-4">Bem vindo ao SISCAWEB</h4>
                <h5 class="display-5">Sistema Simplificado de Cadastro Web</h5>
                <h6 class="display-6">Para acessar seu cadastro, faça o login, utilizando seu usuário e senha</h6>
                <form action="index.php" method="POST">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Login</label>
                    <input type="text" class="form-control" name="login" placeholder="Insira seu usuário" tabindex="1" autofocus>
                    <small name="login" class="form-text text-muted">Usuário ou E-mail</small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Senha</label>
                    <input type="password" class="form-control" placeholder="Senha" name="senha" tabindex="2">
                  </div>
                  <button type="submit" class="btn btn-primary">Entrar</button>
                </form>
                <?php
                  if(isset($_POST['login'])){
                    $login = $_POST['login'];
                    $senha = md5($_POST['senha']);                    
                    include "restricted/connection.php";
                    
                    $sql_read_user = "SELECT * FROM `usuario` WHERE `login` ='$login' AND `senha` = '$senha'";
                    $user_result = mysqli_query($connection, $sql_read_user);

                    if($user_result) {
                      $qtd_registers = mysqli_num_rows($user_result);
                      if($qtd_registers == 1) {
                        $line = mysqli_fetch_assoc($user_result);
                        if(($login == $line['login']) and ($senha == $line['senha'])){
                          session_start();
                          $_SESSION['login'] = "Eder";
                          header("location: restricted");
                        } else {
                          echo "<p class='warning-login'>Login ou senha fonecidos são inválidos!";
                        }
                      } else {
                        echo "<p class='warning-login'>Usuário não localizado!";
                      }
                    }
                  }



                  /* if(isset($_POST['login'])) {
                    $login = $_POST['login'];
                    $senha = md5($_POST['senha']);
                    include "restricted/connection.php";
                    //comando sql - cada um com nome diferente
                    $sql_read_user = "SELECT * FROM `usuario` WHERE login = '$login' AND senha = '$senha'";
                    if ($user_result = mysqli_query($connection, $sql_read_user)) {
                      //cada login deve ser unico n pode repetir
                      $registers = mysqli_num_rows($user_result);
                      if($registers == 1) {
                        $line = mysqli_fetch_assoc($user_result);
                        if(($login == $line['login']) and ($senha == $line['senha'])) {
                          session_start();
                          $_SESSION['login'] = "Eder";
                          header("location: restricted");
                        } else {
                          echo "<p class='warning-login'>O login ou senha fornecidos são inexistentes ou inválidos!</p>";
                        }
                      } else {
                        echo "<p class='warning-login'>Nenhum resultado encontrado</p>";
                      }
                    }                     
                  }  */
                ?>
            </div>
        </div>
      </div>
      <div class="col-3"></div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
