<?php
  include "../validate_log.php";
?>
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
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="estilos/style.css">
    <title>Cadastre-se</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col">
            <h1>Insira seus dados abaixo</h1>
            <form action="cadastrar.php" method="POST" enctype="multipart/form-data">
              <!-- enctype possibilita o upload de arquivos -->
                <div class="form-group">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" class="form-control" name="nome"  placeholder="Digite seu nome" required tabindex="1" autofocus maxlength="200">
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" class="form-control" name="endereco" placeholder="Digite um endereco" tabindex="2" maxlength="200">
                </div>
                <div class="form-group">
                    <label for="phone">Telefone:</label>
                    <input type="text" class="form-control" name="phone" placeholder="(99)99999-9999" tabindex="3" maxlength="15">
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" name="email" placeholder="seudominio@email.com" tabindex="4" maxlength="200">
                </div>
                <div class="form-group">
                    <label for="nascimento">Data de Nascimento:</label>
                    <input type="date" class="form-control" name="data_nascimento" tabindex="5">
                </div>
                  <div class="form-group">
                    <label for="photo">Envie sua foto:</label>
                    <input type="file" class="form-control-file" name="photo" tabindex="5" accept="image/*">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Cadastrar" tabindex="6">
                    <a href="tela_pesquisa.php" class="btn btn-info">Ver Cadastros</a>
                    <a href="index.php" class="btn btn-primary"><< Início</a>
                </div>
            </form>
            
        </div>
      </div>
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
