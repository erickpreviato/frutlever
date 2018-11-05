<?php
/**
 * Table Definition for produto_unidade
 */
require_once 'DB/DataObject.php';

class Produto_unidade extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'produto_unidade';     // table name
    public $produto_id;                     // int(4) primary_key not_null
    public $unidade_id;                     // int(4) primary_key not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
