<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../conf/config.default.php';

include_once MODEL_DIR . '/Dados.php';
include_once MODEL_DIR . '/Varejista.php';
include_once MODEL_DIR . '/Pais.php';
include_once MODEL_DIR . '/Estado.php';
include_once MODEL_DIR . '/Cidade.php';
include_once MODEL_DIR . '/Endereco.php';
include_once MODEL_DIR . '/Telefone.php';
include_once MODEL_DIR . '/Dados_telefone.php';

include_once CONTROLLER_DIR . '/varejista.php';

include_once INCLUDE_DIR . '/header.php';

$varejista = new Varejista();
$varejista->find();
echo $varejista->showAll();

include_once INCLUDE_DIR . '/footer.php';


