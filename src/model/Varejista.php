<?php
/**
 * Table Definition for varejista
 */
require_once 'DB/DataObject.php';

class Varejista extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'varejista';           // table name
    public $id;                             // int(4) primary_key not_null
    public $dados_id;                       // int(4) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    function showAll() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/varejista');
        $pagina = 'list.tpl.html';
        $tpl->loadTemplateFile($pagina);
        
        while ($this->fetch()) {
            $dados = new Dados();
            $dados->get($this->getdados_id());

            $tpl->setVariable('DOCUMENTO', isset($dados->cpf) ? $dados->cpf : $dados->cnpj);
            $tpl->setVariable('VAREJISTA', isset($dados->nome) ? $dados->nome : $dados->nome_fantasia);
            $tpl->setVariable('BTN', $this->getButtons($this->id));

            $tpl->parse('row_table');
        }

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function getButtons($ID) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/varejista');
        $pagina = 'buttons.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('ID', $ID);

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showForm($id = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/varejista');
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
                $tpl->setVariable('TIPO-PESSOA', 'J');
            } else {
                $tpl->setVariable('D-NONE-JURIDICA', 'd-none');
                $tpl->setVariable('TIPO-PESSOA', 'F');
            }

            $endereco = new Endereco();
            $endereco->get($dados->endereco_id);
            foreach ($endereco->table() as $key => $value) {
                $tpl->setVariable(strtoupper($key), $endereco->$key);
            }
            $tpl->setVariable('TITULO', 'Alterar dados do varejista');
            $tpl->setVariable('CIDADE', Cidade::getCidade($endereco->getcidade_id(), 'nome'));

            $cidade->get($endereco->getcidade_id());
            
            $dt = new Dados_telefone();
            $dt->setdados_id($this->getdados_id());
            $dt->find();
            
            while ($dt->fetch()) {
                $tpl->setVariable('TEL'.$dt->gettipo(), Telefone::getTelefone($dt->gettelefone_id()));
            }
            
        } else {
            $tpl->setVariable('D-NONE-FISICA', '');
            $tpl->setVariable('D-NONE-JURIDICA', 'd-none');
            $tpl->setVariable('TITULO', 'Adicionar varejista');
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

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/varejista');
        $pagina = 'details.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $dados = new Dados();
        $dados->get($this->getdados_id());

        foreach ($dados->table() as $key => $value) {
            $tpl->setVariable(strtoupper($key), isset($dados->$key) ? $dados->$key : show_nao_encontrado());
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
            $tpl->setVariable(strtoupper($key), isset($endereco->$key) ? $endereco->$key : show_nao_encontrado());
        }
        
        for ($i = 1; $i <= 3; $i++) {
            $dt = new Dados_telefone();
            $dt->setdados_id($this->getdados_id());
            $dt->settipo($i);
            if ($dt->find()) {
                $dt->fetch();
                $tpl->setVariable('TEL'.$i, Telefone::getTelefone($dt->gettelefone_id()));
            } else {
                $tpl->setVariable('TEL'.$i, show_nao_encontrado());
            }
        }

        $tpl->setVariable('CIDADE', Cidade::getCidade($endereco->cidade_id, 'nome'));
        $tpl->setVariable('ESTADO', Estado::getEstado(Cidade::getCidade($endereco->cidade_id, 'estado_id'), 'nome'));

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }

    function showDelete() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/varejista');
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
