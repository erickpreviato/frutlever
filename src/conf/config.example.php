<?php

/*
 * 
 * Copyright © 2017 EC.on Sistemas <contato@econsistemas.com.br>
 * 
 * Este arquivo é parte do programa "Frutlever"
 * 
 * Frutlever é um software livre; você pode redistribuí-lo e/ou 
 * modificá-lo dentro dos termos da Licença Pública Geral GNU como 
 * publicada pela Fundação do Software Livre (FSF); na versão 3 da 
 * Licença, ou (a seu critério) qualquer versão posterior.
 * 
 * Este programa é distribuído na esperança de que possa ser  útil, 
 * mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO
 * a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
 * Licença Pública Geral GNU para maiores detalhes.
 * 
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU junto
 * com este programa, Se não, veja <http://www.gnu.org/licenses/>.
 * 
 */

/** 
 * <p> 
 * Arquivo de configuração do sistema
 * </p> 
 *  
 * <p> 
 * <strong>Histórico de Versões</strong>
 * <ul> 
 *   <li># - </li>
 * </ul> 
 * </p> 
 *  
 * @author Erick Vansim Previato <erick.previato@gmail.com>
 * @copyright EC.on Sistemas
 */

ini_set("display_errors", 0);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
session_start();

################################################ EDITAR O DIRETÓRIO ########
define('DIR', "/home/erick/www/frutlever/src");
define('MODEL_DIR', DIR."/model");
define('VIEW_DIR', DIR."/view");
define('CONTROLLER_DIR', DIR."/controller");
define('INCLUDE_DIR', DIR."/includes");

################################################ EDITAR A URL ##############
define('URL', "http://143.107.231.229/frutlever");
define('HOME', URL);
define('IMAGE_URL', URL."/view/img");
define('CSS_URL', URL."/view/css");
define('JS_URL', URL."/view/js");
$PHP_SELF = $_SERVER['PHP_SELF'];

//Usando PEAR local
//ini_set('include_path', DIR.'/pear');
//require_once DIR . '/pear/DB/DataObject.php';
//require_once DIR . '/pear/Template/Sigma.php';

//Usando PEAR do sistema
require_once 'DB/DataObject.php';
require_once 'HTML/Template/Sigma.php';

//Da um require na classe do DataObject
$options = &PEAR::getStaticProperty('DB_DataObject','options');
$config = parse_ini_file('/home/erick/www/frutlever/conf/db.ini',TRUE);
$options = $config['DB_DataObject'];

//include_once INCLUDE_DIR . '/controle.php';