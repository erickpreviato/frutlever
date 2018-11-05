<?php
/**
 * Table Definition for propriedade
 */
require_once 'DB/DataObject.php';

class Propriedade extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'propriedade';         // table name
    public $id;                             // int(4) primary_key not_null
    public $nome;                           // varchar(255)
    public $cnpj;                           // varchar(50)
    public $inscricao;                      // varchar(50)
    public $email;                          // varchar(100)
    public $endereco_id;                    // int(4) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
