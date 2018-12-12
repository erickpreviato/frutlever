<?php

/**
 * Table Definition for rastreio
 */
require_once 'DB/DataObject.php';

class Rastreio extends DB_DataObject {
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'rastreio';            // table name
    public $id;                             // int(4) primary_key not_null
    public $quantidade;                     // int(4)
    public $unidade;                        // varchar(45)
    public $data_fabricacao;                // datetime
    public $data_validade;                  // datetime
    public $nfe;                            // varchar(50)
    public $tipo_lote;                      // varchar(45)
    public $lote;                           // varchar(45)
    public $lote_consolidado;               // varchar(45)
    public $produto_id;                     // int(4) not_null
    public $fornecedor_id;                  // int(4)
    public $varejista_id;                   // int(4)
    public $usuario_id;                     // int(4)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function showForm($id = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/rastreio');
        $pagina = 'form.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('OPTION_GRUPOS', Grupo::getOptions());
        $tpl->setVariable('OPTION_PRODUTOS', Produto::getOptions());
        $tpl->setVariable('OPTION_FORNECEDOR', Fornecedor::getOptions());
        

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

}
