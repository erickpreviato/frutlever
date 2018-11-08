<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../../conf/config.default.php';

include_once MODEL_DIR . '/Pais.php';

include_once INCLUDE_DIR . '/header.php';

$pais = new Pais();
echo $pais->showAll();

include_once INCLUDE_DIR . '/footer.php';



