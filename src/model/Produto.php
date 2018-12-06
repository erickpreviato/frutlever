<?php
/**
 * Table Definition for produto
 */
require_once 'DB/DataObject.php';

class Produto extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'produto';             // table name
    public $id;                             // int(4) primary_key not_null
    public $quantidade;                     // int(4)
    public $codigo_barras;                  // varchar(45)
    public $descricao;                      // text
    public $e_origem;                       // varchar(45)
    public $grupo_id;                       // int(4) not_null
    public $unidade_id;                     // int(4) not_null
    public $data_atualizacao;               // datetime

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    public function setDados($post) {
        foreach ($this->table() as $key => $value) {
            foreach ($post as $key_post => $value_post) {
                if ($key = $key_post) {
                    $this->$key = (isset($post[$key_post]) ? $post[$key_post] : $this->$key);
                }
            }
        }
        $this->data_atualizacao = date('Y-m-d H:i:s');
    }
}
