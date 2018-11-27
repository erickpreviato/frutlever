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
    
    function showAll() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/endereco');
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
        
        $cidade = new Estado();
        $this->joinAdd($cidade);
        $this->selectAdd();
        $this->selectAdd('cidade.nome as e_nome, endereco.id as c_id, endereco.nome as c_nome');
        
        if ($pesquisa != '') {
            $this->whereAdd("c_nome like '%$pesquisa%'", 'OR');
            $this->whereAdd("e_nome like '%$pesquisa%'", 'OR');
        }

        $registros = $this->count();

        
        //ordenação
        $nomesColunas = array('c_nome', 'e_nome');
        if ($colunaOrdena >= 0 && $colunaOrdena < count($nomesColunas)) {
            $this->orderBy($nomesColunas[$colunaOrdena] . ' ' . $direcaoOrdenacao);
        }

        $this->limit($inicio, $qtdLinhas);
        $this->find();

        while ($this->fetch()) {

            unset($c);

            $c[] = $this->c_nome;
            $c[] = $this->e_nome;
            $c[] = $this->get_buttons($this->c_id);

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

    function get_buttons($ID) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/endereco');
        $pagina = 'buttons.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('ID', $ID);

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showForm($id = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/endereco');
        $pagina = 'form.tpl.html';
        $tpl->loadTemplateFile($pagina);

        if ($id) {
            foreach ($this->table() as $key => $value) {
                $tpl->setVariable(strtoupper($key), $this->$key);
            }
            $tpl->setVariable('TITULO', 'Alterar dados do endereco');
            $tpl->setVariable('OPTION_ESTADOS', Estado::get_option_cidades($this->cidade_id));
        } else {
            $tpl->setVariable('TITULO', 'Adicionar endereco');
            $tpl->setVariable('OPTION_ESTADOS', Estado::get_option_cidades());
        }



        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showView() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/endereco');
        $pagina = 'details.tpl.html';
        $tpl->loadTemplateFile($pagina);

        foreach ($this->table() as $key => $value) {
            $tpl->setVariable(strtoupper($key), isset($this->$key) ? $this->$key : ' ');
        }

        $get_cidade = Estado::get_cidade($this->$key, 'nome');
        $tpl->setVariable('ESTADO', isset($get_cidade) ? $get_cidade : '<cite class="blockquote-footer">Não encontrado.</cite>');


        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showDelete() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/endereco');
        $pagina = 'delete.tpl.html';
        $tpl->loadTemplateFile($pagina);

        foreach ($this->table() as $key => $value) {
            $tpl->setVariable(strtoupper($key), $this->$key);
        }
        
        $get_cidade = Estado::get_cidade($this->$key, 'nome');
        $tpl->setVariable('ESTADO', isset($get_cidade) ? $get_cidade : '<cite class="blockquote-footer">Não encontrado.</cite>');

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    public function set_dados($post) {
        foreach ($this->table() as $key => $value) {
            foreach ($post as $key_post => $value_post) {
                if ($key = $key_post) {
                    $this->$key = (isset($post[$key_post]) ? $post[$key_post] : $this->$key);
                }
            }
        }
    }
}
