<?php
/**
 * Table Definition for estado
 */
require_once 'DB/DataObject.php';

class Estado extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'estado';              // table name
    public $id;                             // int(4) primary_key not_null
    public $nome;                           // varchar(100)
    public $sigla;                          // varchar(2)
    public $pais_id;                        // int(4) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
