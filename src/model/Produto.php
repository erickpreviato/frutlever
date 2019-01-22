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
    public $nome;                           // varchar(100)
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
    
    public static function getOptions ($id = null) {
    
        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/produto');
        $pagina = 'option.tpl.html';
        $tpl->loadTemplateFile($pagina);
        
        $produto = new Produto();
        $produto->orderBy('descricao', 'ASC');
        $produto->find();
        
        while ($produto->fetch()) {
            $tpl->setVariable('VALUE', $produto->id);
            $tpl->setVariable('NAME', $produto->descricao);
            $tpl->setVariable('SELECTED', $produto->id == $id ? 'selected=selected' : '');
            
            $tpl->parse('option');
        }

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
        
    }
    
    
    function showAll() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/produto');
        $pagina = 'list.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function listAjax($cont = 0, $qtdLinhas = 10, $inicio = 0, $pesquisa = '', $colunaOrdena = 0, $direcaoOrdenacao = 'asc') {

        $total = $this->count();
        $registros = 0;
        $ret = array('draw' => intval(0), 'data' => null, 'recordsTotal' => 1, 'recordsFiltered' => 1);


        if ($pesquisa != '') {
            $this->whereAdd("descricao like '%$pesquisa%'");
        }

        $registros = $this->count();


        //ordenação
        $nomesColunas = array('descricao');
        if ($colunaOrdena >= 0 && $colunaOrdena < count($nomesColunas)) {
            $this->orderBy($nomesColunas[$colunaOrdena] . ' ' . $direcaoOrdenacao);
        }

        $this->limit($inicio, $qtdLinhas);
        $this->find();

        while ($this->fetch()) {

            unset($c);

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

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/produto');
        $pagina = 'buttons.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('ID', $ID);

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showForm($id = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/produto');
        $pagina = 'form.tpl.html';
        $tpl->loadTemplateFile($pagina);
        
        if ($id) {
            foreach ($this->table() as $key => $value) {
                $tpl->setVariable(strtoupper($key), $this->$key);
            }
            $tpl->setVariable('TITULO', 'Alterar dados do produto');
            $tpl->setVariable('OPTION_GRUPOS', Grupo::getOptions($this->grupo_id));
            $tpl->setVariable('CHECK_UNIDADE', Unidade::getChecks($this->unidade_id));
        } else {
            $tpl->setVariable('TITULO', 'Adicionar produto');
            $tpl->setVariable('OPTION_GRUPOS', Grupo::getOptions());
            $tpl->setVariable('CHECK_UNIDADE', Unidade::getChecks());
        }

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showView() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/produto');
        $pagina = 'details.tpl.html';
        $tpl->loadTemplateFile($pagina);

        foreach ($this->table() as $key => $value) {
            $tpl->setVariable(strtoupper($key), isset($this->$key) ? $this->$key : ' ');
        }
        $tpl->setVariable('GRUPO', Grupo::getGrupo($this->grupo_id, 'descricao'));

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showDelete() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/produto');
        $pagina = 'delete.tpl.html';
        $tpl->loadTemplateFile($pagina);

        foreach ($this->table() as $key => $value) {
            $tpl->setVariable(strtoupper($key), $this->$key);
        }

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }
}
