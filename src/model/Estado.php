<?php

/**
 * Table Definition for estado
 */
require_once 'DB/DataObject.php';

class Estado extends DB_DataObject {
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'estado';              // table name
    public $id;                             // int(4) primary_key not_null
    public $nome;                           // varchar(100)
    public $sigla;                          // varchar(2)
    public $pais_id;                        // int(4) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function showAll() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/estado');
        $pagina = 'list.tpl.html';
        $tpl->loadTemplateFile($pagina);
        
        $this->find();
        while($this->fetch()) {
            
            $tpl->setVariable('EXISTE', $this->seExiste($this->id) ? 'class="text-warning"' :  '');
            
            
            $tpl->setVariable('SIGLA', $this->sigla);
            $tpl->setVariable('NOME', $this->nome);
            $tpl->setVariable('PAIS', Pais::getPais($this->pais_id, 'codigo'));
            $tpl->setVariable('BUTTONS', $this->getButtons($this->id));
            
            $tpl->parse('row_table');
        }

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }
    
    function showAllAjax() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/estado');
        $pagina = 'list_ajax.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function listAjax($cont = 0, $qtdLinhas = 10, $inicio = 0, $pesquisa = '', $colunaOrdena = 0, $direcaoOrdenacao = 'asc') {

        $total = $this->count();
        $registros = 0;
        $ret = array('draw' => intval(0), 'data' => null, 'recordsTotal' => 1, 'recordsFiltered' => 1);
        
        $pais = new Pais();
        $this->joinAdd($pais);
        $this->selectAdd();
        $this->selectAdd('pais.nome as p_nome, estado.id as e_id, estado.nome as e_nome, estado.sigla as e_sigla');
        
        if ($pesquisa != '') {
            $this->whereAdd("sigla like '%$pesquisa%'");
            $this->whereAdd("nome like '%$pesquisa%'", 'OR');
            $this->whereAdd("p_nome like '%$pesquisa%'", 'OR');
        }

        $registros = $this->count();

        
        //ordenação
        $nomesColunas = array('e_sigla', 'e_nome', 'p_nome');
        if ($colunaOrdena >= 0 && $colunaOrdena < count($nomesColunas)) {
            $this->orderBy($nomesColunas[$colunaOrdena] . ' ' . $direcaoOrdenacao);
        }

        $this->limit($inicio, $qtdLinhas);
        $this->find();

        while ($this->fetch()) {

            unset($c);

            $c[] = $this->e_sigla;
            $c[] = $this->e_nome;
            $c[] = $this->p_nome;
            $c[] = $this->getButtons($this->e_id);

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

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/estado');
        $pagina = 'buttons.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('ID', $ID);

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showForm($id = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/estado');
        $pagina = 'form.tpl.html';
        $tpl->loadTemplateFile($pagina);

        if ($id) {
            foreach ($this->table() as $key => $value) {
                $tpl->setVariable(strtoupper($key), $this->$key);
            }
            $tpl->setVariable('TITULO', 'Alterar dados do estado');
            $tpl->setVariable('OPTION_PAISES', Pais::getOptionPais($this->id));
        } else {
            $tpl->setVariable('TITULO', 'Adicionar estado');
            $tpl->setVariable('OPTION_PAISES', Pais::getOptionPais());
        }



        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showView() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/estado');
        $pagina = 'details.tpl.html';
        $tpl->loadTemplateFile($pagina);

        foreach ($this->table() as $key => $value) {
            $tpl->setVariable(strtoupper($key), isset($this->$key) ? $this->$key : ' ');
        }

        $get_pais = Pais::getPais($this->$key, 'nome');
        $tpl->setVariable('PAIS', isset($get_pais) ? $get_pais : '<cite class="blockquote-footer">Não encontrado.</cite>');


        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showDelete() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/estado');
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
    
    public static function getEstado($id = null, $field = 'nome') {
        $obj = new Estado();
        $obj->get($id);
        return $obj->$field;
    }
    
    public static function getOptionEstados ($id = null) {
    
        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/estado');
        $pagina = 'option.tpl.html';
        $tpl->loadTemplateFile($pagina);
        
        $obj = new Estado();
        $obj->orderBy('nome', 'ASC');
        $obj->find();
        
        while ($obj->fetch()) {
            $tpl->setVariable('VALUE', $obj->id);
            $tpl->setVariable('NAME', $obj->nome);
            $tpl->setVariable('SELECTED', $obj->id == $id ? 'selected=selected' : '');
            
            $tpl->parse('option');
        }

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
        
    }
    
    function seExiste($ID) {
               
        $estado = new Estado();
        $estado->get($ID);
        
        $est = new Estado();
        $est->find();
        while ($est->fetch()) {
            if (($est->nome == $estado->nome) && ($est->pais_id == $estado->pais_id) && ($est->id != $estado->id)) {
                $retorno = true;
            } else {
                $retorno = false;
            }
        }        
        return $retorno;
    }

}
