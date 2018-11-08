<?php
/**
 * Table Definition for endereco
 */
require_once 'DB/DataObject.php';

class Endereco extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'endereco';            // table name
    public $id;                             // int(4) primary_key not_null
    public $tipo;                           // varchar(45)
    public $logradouro;                     // varchar(200)
    public $numero;                         // varchar(45)
    public $bairro;                         // varchar(100)
    public $cep;                            // varchar(10)
    public $latitude;                       // varchar(50)
    public $longitude;                      // varchar(50)
    public $cidade_id;                      // int(4) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}