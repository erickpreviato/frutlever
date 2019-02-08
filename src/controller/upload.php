<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../conf/config.default.php';

if (isset($_FILES['fileFoto'])) {
    
    $diretorio = "../fotos/produtos/";
    $name = "fileFoto";
    $tipo = "jpg";

    $extensao = explode('.', $_FILES[$name]['name']);

    //Padrao: ID usuario preenchendo com 0 a esquerda até 8 digitos, data abreviada YYYYMMAA e o tipo FT = foto, CP = CPF ....
    //$nomeArquivo = md5(str_pad($_POST['ID'], 8, "0", STR_PAD_LEFT) . 'FT');

    $nomeArquivo = 'tmp_foto_idusuario';
    
    $erro = arquivo($diretorio, $name, $tipo, $nomeArquivo);

    if ($erro == 'true') {
        echo ('OK|-|<a id="visualizarfoto" href="' . $diretorio . $nomeArquivo . '.' . $extensao[1] . '" target="_blank">visualizar</a>');
    } else {
        echo ('erro|-|' . $erro);
    }
}

