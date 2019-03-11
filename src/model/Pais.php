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

    function showAllAjax() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/pais');
        $pagina = 'list_ajax.tpl.html';
        $tpl->loadTemplateFile($pagina);
        
        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showAll() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/pais');
        $pagina = 'list.tpl.html';
        $tpl->loadTemplateFile($pagina);
        
        $this->find();
        while ($this->fetch()) {
            
            $tpl->setVariable('EXISTE', $this->seExiste($this->id) ? 'class="text-warning"' :  '');
            
            $tpl->setVariable('CODIGO', $this->codigo);
            $tpl->setVariable('NOME', $this->nome);
            $tpl->setVariable('BUTTONS', $this->getButtons($this->id));
            
            $tpl->parse('row_table');
        }

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }
    
    function listAjax($cont = 0, $qtdLinhas = 10, $inicio = 0, $pesquisa = '', $colunaOrdena = 0, $direcaoOrdenacao = 'asc') {

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
            $c[] = $this->getButtons($this->id);

            $ret['data'][] = $c;
        }

        if ($registros != 0) {
            $ret['recordsTotal'] = $total;
            $ret['recordsFiltered'] = $registros;

            return json_encode($ret);
        } else {
            unset($ret);
            $ret = array('draw' => 0, 'data' => []);
            $ret['recordsTotal'] = $total;
            $ret['recordsFiltered'] = 0;
            //$ret['data'][] = ;
            return json_encode($ret);
        }
    }

    function getButtons($ID) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/pais');
        $pagina = 'buttons.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('ID', $ID);

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showForm($id = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/pais');
        $pagina = 'form.tpl.html';
        $tpl->loadTemplateFile($pagina);
        
        if ($id) {
            foreach ($this->table() as $key => $value) {
                $tpl->setVariable(strtoupper($key), $this->$key);
            }
            $tpl->setVariable('TITULO', 'Alterar dados do país');
        } else {
            $tpl->setVariable('TITULO', 'Adicionar país');
        }

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }
    
    function showView() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/pais');
        $pagina = 'details.tpl.html';
        $tpl->loadTemplateFile($pagina);
        
        foreach ($this->table() as $key => $value) {
            $tpl->setVariable(strtoupper($key), $this->$key);
        }

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }
    
    function showDelete() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/pais');
        $pagina = 'delete.tpl.html';
        $tpl->loadTemplateFile($pagina);
        
        foreach ($this->table() as $key => $value) {
            $tpl->setVariable(strtoupper($key), $this->$key);
        }

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    public function setDados($post) {
        foreach ($this->table() as $key => $value) {
            foreach ($post as $key_post => $value_post) {
                if ($key = $key_post) {
                    $this->$key = (isset($post[$key_post]) ? $post[$key_post] : $this->$key);
                }
            }
        }
    }
    
    public static function getPais($id = null, $field = null) {
        $pais = new Pais();
        $pais->get($id);
        return $pais->$field;
    }
    
    public static function getOptionPais ($id = null) {
    
        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/pais');
        $pagina = 'option.tpl.html';
        $tpl->loadTemplateFile($pagina);
        
        $pais = new Pais();
        $pais->orderBy('nome', 'ASC');
        $pais->find();
        
        while ($pais->fetch()) {
            $tpl->setVariable('VALUE', $pais->id);
            $tpl->setVariable('NAME', $pais->nome);
            $tpl->setVariable('SELECTED', $pais->id == $id ? 'selected=selected' : '');
            
            $tpl->parse('option');
        }

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
        
    }
    
    function seExiste($ID) {
               
        $pais = new Pais();
        $pais->get($ID);
        
        $pai = new Pais();
        $pai->find();
        while ($pai->fetch()) {
            if (($pai->nome == $pais->nome) && ($pai->codigo == $pais->codigo) && ($pai->id != $pais->id)) {
                $retorno = true; 
            } else {
                $retorno = false;
            }
        } 
        return $retorno;
    }
}
