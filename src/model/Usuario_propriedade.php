<?php
/**
 * Table Definition for usuario_propriedade
 */
require_once 'DB/DataObject.php';

class Usuario_propriedade extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'usuario_propriedade';    // table name
    public $usuario_id;                     // int(4) primary_key not_null
    public $propriedade_id;                 // int(4) primary_key not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
