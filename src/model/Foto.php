<?php
/**
 * Table Definition for foto
 */
require_once 'DB/DataObject.php';

class Foto extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'foto';                // table name
    public $id;                             // int(4) primary_key not_null
    public $nome;                           // varchar(100)
    public $arquivo;                        // varchar(100) not_null

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    function showAll() {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/foto');
        $pagina = 'list.tpl.html';
        $tpl->loadTemplateFile($pagina);

        $tpl->setVariable('URL', URL);
        $tpl->setVariable('PHP_SELF', $_SERVER['PHP_SELF']);

        return $tpl->get();
    }
    
    function showForm($id = null) {

        $tpl = new HTML_Template_Sigma(VIEW_DIR . '/foto');
        $pagina = 'form.tpl.html';
        $tpl->loadTemplateFile($pagina);
        
        if ($id) {
            foreach ($this->table() as $key => $value) {
                $tpl->setVariable(strtoupper($key), $this->$key);
            }
            $tpl->setVariable('TITULO', 'Alterar dados da foto');
        } else {
            $tpl->setVariable('TITULO', 'Adicionar foto');
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
