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
    <title>Pesquisar Cadastro</title>
  </head>
  <body>

    <?php  

      $pesquisa = $_POST['pesquisa'] ?? '';

      include('connection.php');

      $sql_search = "SELECT * FROM pessoas WHERE nome LIKE '%$pesquisa%'";

      $data = mysqli_query($connection, $sql_search);
            
    ?>
    <div class="container">
      <div class="row">
        <div class="col">
          <h1 id="search-title">Pesquisar Cadastro</h1>
            <nav class="navbar navbar-light bg-light">
              <form class="form-inline" method="POST" action="tela_pesquisa.php">
                <input type="search" placeholder="O que você procura?" class="form-control mr-sm-2" name="pesquisa" autofocus tabindex="1">
              <button type="submit" class="btn btn-outline-success my-2 my-sm-0" tabindex=2">Procurar</button>
              </form>
            </nav>
            <a href="index.php" class="btn btn-info" id="voltar" tabindex="3"><< Início</a>
            <a href="tela_cadastro.php" class="btn btn-primary" tabindex="4">+ Novo cadastro</a>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="row"><b>Nome</b></th>
                  <th>Endereço</th>
                  <th>Telefone</th>
                  <th>E-mail</th>
                  <th>Data de Nascimento</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
              <?php
                while($line = mysqli_fetch_assoc($data)) {

                  $id = $line['id'];
                  $nome = $line['nome'];
                  $endereco = $line['endereco'];
                  $phone = $line['phone'];
                  $email = $line['email'];
                  $data_nascimento = $line['data_nascimento'];
                  //essa variável mostra a data de nascimento invertida
                  $data_nascimento = invert_date($data_nascimento);
                  $photo = $line['photo'];

                                    
                  if(!$photo == null) {
                    $show_photo = "<img src='img/$photo' class='thumb'>";
                  } else {
                    $show_photo = "";
                  }

                  //para trazer as informações preenchidas nos inputs do formulario na tela de edição, eu preciso levá-las via get a tela_edicao, utilizando o id que é a chave primária. 
                  echo "<tr>
                          <td>$show_photo</td>
                          <th>$nome</th>
                          <td>$endereco</td> 
                          <td>$phone</td> 
                          <td>$email</td> 
                          <td>$data_nascimento</td>
                          <td class='column-actions'>
                            <a href='tela_edicao.php?id=$id' class='btn btn-primary btn-sm' tabindex='5'>Edit</a>
                            <a href='#'class='btn btn-danger btn-sm' tabindex='6' data-toggle='modal' data-target='#modal-question-delete'
                            onclick=". '"' . "captura_nome_e_id($id, '$nome')". '"' .">Delete</a>
                          </td>
                        </tr>";
                }
              ?>
              <!-- onclick = "captura_nome_e_id($id, '$nome')" -->
              <!-- O segredo da chamada da função js é que existem aspas dentro de aspas e por php só é possível inser-i-las por concatenação de strings -->

              

              </tbody>
            </table>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-question-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Exclusão de Cadastro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>          
          </div>
          <div class="modal-body">
            <form action="deletar.php" method="POST">
            <p >Deseja realmente excluir <b id="person-name">Nome da pessoa</b>?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Não</button>
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="nome" id="people-name" value="">
            <input type="submit" class="btn btn-danger" value="Sim, Excluir">
            </form>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      //Essa função serve para capturar os dados do nome e do id e inserir no campo oculto da modal para passá-los via get no comando de excluir os dados
      function captura_nome_e_id (id, nome) {
        document.getElementById('person-name').innerHTML = nome;
        document.getElementById('people-name').value = nome;
        document.getElementById('id').value = id;
      }
    </script>

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
