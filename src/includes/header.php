<?php
/*
 *  Cabeçalho do sistema
 *  Histórico de versões
 *      12/2016
 *  @author Carlos Eduardo Favaro <favaro@icmc.usp.br> <cadufavaro@gmail.br>
 *  @copyright Seção Técnica de Informática - STI/ICMC 
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="<?php //echo IMAGE_URL   ?>/favicon.ico">

        <title>Frtlever EC.on Sistemas</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>/datepicker.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>/dataTables.bootstrap.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>/select2.css">

        <!-- jQuery 2.1.4 -->
        <script src="<?= JS_URL ?>/jquery.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_msgs"><?php echo(show_message()); ?></div>

