<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../conf/config.default.php';

include_once MODEL_DIR . '/Rastreio.php';

include_once CONTROLLER_DIR . '/rastreio.php';

include_once INCLUDE_DIR . '/header.php';

$rastreio = new Rastreio();
echo $rastreio->showForm();

include_once INCLUDE_DIR . '/footer.php';



