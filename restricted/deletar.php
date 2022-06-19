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
    <title>resposta da exclusão</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col">
            <?php
                //importação do arquivo de conexão  
                include("connection.php");
                $id = $_POST['id'];
                $nome = $_POST['nome'];

                //execução de comando de add registro no banco  
                $sql_delete = "DELETE FROM `pessoas` WHERE id = $id";

                //requisição de consulta ao banco
                $result = mysqli_query($connection, $sql_delete);

                if($result) {
                    alert_message("O cadastro $nome foi excluido!", 'success');
                } else {
                    alert_message("Ocorreu um ERRO ao excluir $nome!", 'danger');
                }             
            ?>   
            <a href="tela_pesquisa.php" class="btn btn-primary"><< Voltar</a>         
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
