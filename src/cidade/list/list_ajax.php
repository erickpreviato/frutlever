<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../../conf/config.default.php';

include_once MODEL_DIR . '/Estado.php';
include_once MODEL_DIR . '/Cidade.php';

$contador = 1;
$qtdLinhas = 10;
$inicio = 0;
$pesquisa = '';
$colunaOrdena = 0;
$direcaoOrdenacao = 'asc';

//validações
if (isset($_GET['length']) && $_GET['length'] > 0) {
    $qtdLinhas = intval($_GET['length']);
}

if (isset($_GET['draw']) && $_GET['draw'] > 0) {
    $contador = intval($_GET['draw']);
}

if (isset($_GET['start']) && $_GET['start'] > 0) {
    $inicio = intval($_GET['start']);
}

if (isset($_GET['search']) && isset($_GET['search']['value']) && $_GET['search']['value'] != '') {
    $pesquisa = $_GET['search']['value'];
}

if (isset($_GET['order']) && isset($_GET['order'][0]['column']) && $_GET['order'][0]['column'] >= 0) {
    $colunaOrdena = intval($_GET['order'][0]['column']);
}

if (isset($_GET['order']) && isset($_GET['order'][0]['dir']) && ($_GET['order'][0]['dir'] == 'asc' || $_GET['order'][0]['dir'] == 'desc')) {
    $direcaoOrdenacao = $_GET['order'][0]['dir'];
}

$cidade = new Cidade();
echo $cidade->list_ajax($contador, $qtdLinhas, $inicio, $pesquisa, $colunaOrdena, $direcaoOrdenacao);




