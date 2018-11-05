<?php
/**
 * Table Definition for usuario
 */
require_once 'DB/DataObject.php';

class Usuario extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'usuario';             // table name
    public $id;                             // int(4) primary_key not_null
    public $categoria;                      // varchar(45)
    public $status;                         // varchar(1)
    public $dados_id;                       // int(4) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
