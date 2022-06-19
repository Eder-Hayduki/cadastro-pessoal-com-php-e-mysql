<?php
    //para acessar a variável global $_SESSION preciso iniciar a sessão através do comando abaixo.
    session_start();
    if(isset($_SESSION['login'])) {
        $user = $_SESSION['login'];
    } else {
        session_destroy();
        header("location: ../index.php?msg=não_foi_possível_acessar_seus_dados._Por_favor,_insira_seu_login_e_usuário.");
    }
?>