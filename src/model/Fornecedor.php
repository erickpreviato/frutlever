<?php

/**
 * Table Definition for fornecedor
 */
require_once 'DB/DataObject.php';

class Fornecedor extends DB_DataObject {
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'fornecedor';          // table name
    public $id;                             // int(4) primary_key not_null
    public $dados_id;                       // int(4) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function showAll() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/fornecedor');
        $pagina = 'list.tpl.html';
        $tpl->loadTemplateFile($pagina);

        //$i =0;

        while ($this->fetch()) {
            $dados = new Dados();
            $dados->get($this->getdados_id());

            $tpl->setVariable('DOCUMENTO', isset($dados->cpf) ? $dados->cpf : $dados->cnpj);
            $tpl->setVariable('FORNECEDOR', isset($dados->nome) ? $dados->nome : $dados->nome_fantasia);
            $tpl->setVariable('BTN', $this->getButtons($this->id));

            $tpl->parse('row_table');
            //$i++;
        }

//        if ($i == 0) {
//            $tpl->setVariable("NONE", "Nenhum registro encontrado.");
//            $tpl->touchBlock("row_none");
//            $tpl->hideBlock("datatable");
//        } else {
//            $tpl->touchBlock("datatable");
//        }

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

//    function listAjax($cont = 0, $qtdLinhas = 10, $inicio = 0, $pesquisa = '', $colunaOrdena = 0, $direcaoOrdenacao = 'asc') {
//
//        $total = $this->count();
//        $registros = 0;
//        $ret = array('draw' => intval(0), 'data' => null, 'recordsTotal' => 1, 'recordsFiltered' => 1);
//
//        $dados = new Dados();
//        $this->joinAdd($dados);
//        $this->selectAdd();
//        $this->selectAdd("fornecedor.id, nome, razao_social, cnpj, cpf");
//        
//        if ($pesquisa != '') {
//            $this->whereAdd("nome like '%$pesquisa%'");
//            $this->whereAdd("razao_social like '%$pesquisa%'", 'OR');
//            $this->whereAdd("cpf like '%$pesquisa%'", 'OR');
//            $this->whereAdd("cnpj like '%$pesquisa%'", 'OR');
//        }
//
//        $registros = $this->count();
//
//
//        //ordenação
//        $nomesColunas = array('nome');
//        if ($colunaOrdena >= 0 && $colunaOrdena < count($nomesColunas)) {
//            $this->orderBy($nomesColunas[$colunaOrdena] . ' ' . $direcaoOrdenacao);
//        }
//
//        $this->limit($inicio, $qtdLinhas);
//        $this->find();
//
//        while ($this->fetch()) {
//
//            unset($c);
//
//            $c[] = $this->nome.$this->razao_social.' ('.$this->cpf.$this->cnpj.')';
//            $c[] = $this->getButtons($this->id);
//
//            $ret['data'][] = $c;
//        }
//
//        if ($registros != 0) {
//            $ret['recordsTotal'] = $total;
//            $ret['recordsFiltered'] = $registros;
//
//            return json_encode($ret);
//        } else {
//            unset($ret);
//            $ret = array('draw' => 0, 'data' => []);
//            $ret['recordsTotal'] = $total;
//            $ret['recordsFiltered'] = 0;
//            //$ret['data'][] = ;
//            return json_encode($ret);
//        }
//    }

    function getButtons($ID) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/fornecedor');
        $pagina = 'buttons.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('ID', $ID);

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showForm($id = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/fornecedor');
        $pagina = 'form.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $cidade = new Cidade();

        if ($id) {
            $tpl->hideBlock('row_opts');
            $dados = new Dados();
            $dados->get($this->dados_id);

            foreach ($dados->table() as $key => $value) {
                $tpl->setVariable(strtoupper($key), $dados->$key);
            }

            if ($dados->cnpj) {
                $tpl->setVariable('D-NONE-FISICA', 'd-none');
            } else {
                $tpl->setVariable('D-NONE-JURIDICA', 'd-none');
            }

            $endereco = new Endereco();
            $endereco->get($dados->endereco_id);
            foreach ($endereco->table() as $key => $value) {
                $tpl->setVariable(strtoupper($key), $endereco->$key);
            }
            $tpl->setVariable('TITULO', 'Alterar dados do fornecedor');
            $tpl->setVariable('CIDADE', Cidade::getCidade($endereco->getcidade_id(), 'nome'));

            $cidade->get($endereco->getcidade_id());
        } else {
            $tpl->setVariable('D-NONE-FISICA', '');
            $tpl->setVariable('D-NONE-JURIDICA', 'd-none');
            $tpl->setVariable('TITULO', 'Adicionar fornecedor');
            $tpl->touchBlock('row_opts');
        }

        $tpl->setVariable('CIDADES', Cidade::showDataList());
        $tpl->setVariable('ESTADOS', Estado::getOptionEstados($cidade->getestado_id()));
        $tpl->setVariable('PAISES', Pais::getOptionPais());

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showView() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/fornecedor');
        $pagina = 'details.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $dados = new Dados();
        $dados->get($this->getdados_id());

        foreach ($dados->table() as $key => $value) {
            $tpl->setVariable(strtoupper($key), isset($dados->$key) ? $dados->$key : '<cite  class="blockquote-footer">Não Encontrado</cite>');
        }

        if ($dados->cnpj) {
            $tpl->touchBlock('row_juridico');
            $tpl->hideBlock('row_fisico');
        } else {
            $tpl->touchBlock('row_fisico');
            $tpl->hideBlock('row_juridico');
        }

        $endereco = new Endereco();
        $endereco->get($dados->getendereco_id());

        foreach ($endereco->table() as $key => $value) {
            $tpl->setVariable(strtoupper($key), isset($endereco->$key) ? $endereco->$key : '<cite  class="blockquote-footer">Não Encontrado</cite>');
        }

        $tpl->setVariable('CIDADE', Cidade::getCidade($endereco->cidade_id, 'nome'));
        $tpl->setVariable('ESTADO', Estado::getEstado(Cidade::getCidade($endereco->cidade_id, 'estado_id'), 'nome'));

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showDelete() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/fornecedor');
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

}
