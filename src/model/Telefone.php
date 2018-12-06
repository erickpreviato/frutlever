<?php
/**
 * Table Definition for telefone
 */
require_once 'DB/DataObject.php';

class Telefone extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'telefone';            // table name
    public $id;                             // int(4) primary_key not_null
    public $numero;                         // varchar(45) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    public static function getTelefone($id) {
        $telefone = new Telefone();
        $telefone->get($id);
        return $telefone->numero;
    }
}
