<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "empresa";

    //função que conecta com banco retornando true/false    
    $connection = mysqli_connect($host, $user, $password, $db);

    //teste de conexão
    if($connection) {
        /* echo "Conectado"; */
    } else {
        echo "Não houve conexão"; 
    }

    /*Depois verificar uma maneira de mover essas funções para outro arquivo */

    /*Essa função exibe um alerta na tela de acordo com o status de cadastro alteração ou exclusão de registro */

    function alert_message ($text, $message) {
        echo "<div class='alert alert-$message' role='alert'>$text</div> ";
    }

    /*============================================================*/
    //Função de inverter e mostrar na tabela a data no nosso formato padrão.
    
    function invert_date($date) {
        $date = explode('-', $date);
        $write = $date[2] . "/" . $date[1] . "/" . $date[0];
        return $write; 
    }

    /*=========================================================== */

    function photo_move($photo_info) {
        $type_img = explode('/', $photo_info['type']);
        $type_name = $type_img[0];
        $type_img = explode("/", $photo_info['type']) ?? '';
        $type_name = $type_img[0] ?? '';
        //undefined array key
        $ext = "." . $type_img[1] ?? '';
        if((!$photo_info['error']) and ($photo_info['size'] < 1000000) and ($type_name == "image")) {
            $file_name = date('dmY-hms'). $ext;
            move_uploaded_file($photo_info['tmp_name'], "img/" . $file_name);
            return $file_name;
        } else {
            return 0;
        }
    }

?>