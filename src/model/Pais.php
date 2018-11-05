<?php
/**
 * Table Definition for pais
 */
require_once 'DB/DataObject.php';

class Pais extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'pais';                // table name
    public $id;                             // int(4) primary_key not_null
    public $nome;                           // varchar(100)
    public $codigo;                         // varchar(2)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
