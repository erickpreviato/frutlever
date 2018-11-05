<?php
/**
 * Table Definition for dados
 */
require_once 'DB/DataObject.php';

class Dados extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'dados';               // table name
    public $id;                             // int(4) primary_key not_null
    public $razao_social;                   // varchar(255)
    public $cnpj;                           // varchar(20)
    public $cpf;                            // varchar(15)
    public $inscricao;                      // varchar(50)
    public $rg;                             // varchar(15)
    public $email;                          // varchar(100)
    public $informacoes;                    // text
    public $logo;                           // varchar(50)
    public $endereco_id;                    // int(4) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
