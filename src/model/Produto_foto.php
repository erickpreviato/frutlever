<?php
/**
 * Table Definition for produto_foto
 */
require_once 'DB/DataObject.php';

class Produto_foto extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'produto_foto';        // table name
    public $produto_id;                     // int(4) primary_key not_null
    public $foto_id;                        // int(4) primary_key not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
