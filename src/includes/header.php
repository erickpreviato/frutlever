<!DOCTYPE html>
<html lang="en"><head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="https://getbootstrap.com/favicon.ico">

        <title>Frutlever</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo CSS_URL; ?>/bootstrap.css" rel="stylesheet">
        <link href="<?php echo CSS_URL; ?>/bootstrap.econ.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>/all.min.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>/datepicker.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>/select2.css">

        <!-- Custom styles for this template -->
        <link href="<?php echo CSS_URL; ?>/dashboard.css" rel="stylesheet">
        <style type="text/css">/* Chart.js */
            @-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}
            @keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}
            .chartjs-render-monitor{
                -webkit-animation:chartjs-render-animation 0.001s;
                animation:chartjs-render-animation 0.001s;
            }
        </style>

        <script src="<?php echo JS_URL; ?>/jquery-3.3.1.min.js"></script>
    </head>

    <body>
        
        <!-- Modal -->
        <form action="<?php echo $PHP_SELF;?>" method="POST">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
        </form>
        
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">FRUTLEVER</a>

            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="#">Sair</a>
                </li>
            </ul>
        </nav>

        <div class="container-fluid principal">
            <div class="row principal-row">
                <nav class="col-sm-3 col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo URL; ?>">
                                    <i class="fa fa-home"></i>
                                    Painel <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL; ?>/pais">
                                    <i class="fa fa-globe"></i>
                                    País
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL; ?>/estado">
                                    <i class="fa fa-map"></i>
                                    Estado
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL; ?>/cidade">
                                    <i class="fa fa-hotel"></i>
                                    Cidade
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL; ?>/unidade">
                                    <i class="fa fa-calculator"></i>
                                    Unidade
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL; ?>/grupo">
                                    <i class="fa fa-users"></i>
                                    Grupos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL; ?>/produto">
                                    <i class="fa fa-coffee"></i>
                                    Produtos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL; ?>/fornecedor">
                                    <i class="fa fa-shipping-fast"></i>
                                    Fornecedor
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL; ?>/varejista">
                                    <i class="fa fa-store"></i>
                                    Varejista
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL; ?>/etiqueta">
                                    <i class="fa fa-barcode"></i>
                                    Etiqueta
                                </a>
                            </li>
                        </ul>

                    </div>
                </nav>

                <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
                    <div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                        </div>                            
                    </div>


                    <div class="header_msgs"><?php echo(show_message()); ?></div>

                    <div class="d-flex justify-content-between flex-wrap align-items-center pt-3 pb-2 mb-3 border-bottom">