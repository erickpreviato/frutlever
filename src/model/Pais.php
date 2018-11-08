<?php

/**
 * Table Definition for pais
 */
require_once 'DB/DataObject.php';

class Pais extends DB_DataObject {
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'pais';                // table name
    public $id;                             // int(4) primary_key not_null
    public $nome;                           // varchar(100)
    public $codigo;                         // varchar(2)

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function showAll() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/pais');
        $pagina = 'list.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function list_ajax($cont = 0, $qtdLinhas = 10, $inicio = 0, $pesquisa = '', $colunaOrdena = 0, $direcaoOrdenacao = 'asc') {

        $total = $this->count();
        $registros = 0;
        $ret = array('draw' => intval(0), 'data' => null, 'recordsTotal' => 1, 'recordsFiltered' => 1);

        if ($pesquisa != '') {
            $this->whereAdd("codigo like '%$pesquisa%'");
            $this->whereAdd("nome like '%$pesquisa%'", 'OR');
        }

        $registros = $this->count();

        //ordenação
        $nomesColunas = array('codigo', 'nome');
        if ($colunaOrdena >= 0 && $colunaOrdena < count($nomesColunas)) {
            $this->orderBy($nomesColunas[$colunaOrdena] . ' ' . $direcaoOrdenacao);
        }

        $this->limit($inicio, $qtdLinhas);
        $this->find();

        while ($this->fetch()) {

            unset($c);

            $c[] = $this->codigo;
            $c[] = $this->nome;
            $c[] = 'acao';

            $ret['data'][] = $c;
        }

        if ($registros != 0) {
            $ret['recordsTotal'] = $total;
            $ret['recordsFiltered'] = $registros;

            return json_encode($ret);
        } else {
            unset($c);
            $ret['recordsTotal'] = $total;
            $ret['recordsFiltered'] = $registros;
            $c[] = '';
            $c[] = 'total='.$total.' registros='.$registros;
            $c[] = '';
            $ret['data'][] = $c;
            return json_encode($ret);
        }
    }

}
