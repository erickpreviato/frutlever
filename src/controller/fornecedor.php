<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['new'])) {
    $fornecedor = new Fornecedor();
    echo $fornecedor->showForm();
    die();
}

if (isset($_POST['edit'])) {
    $fornecedor = new Fornecedor();
    $fornecedor->get($_POST['edit']);
    echo $fornecedor->showForm($fornecedor->id);
    die();
}

if (isset($_POST['salvar'])) {
    
    //Checar cidade
    $cidade = new Cidade();
    $cidade->setestado_id($_POST['estado_id']);
    $cidade->setnome($_POST['cidade']);
    if ($cidade->find()) {
        $cidade->fetch();
        $idCidade = $cidade->getid();
    } else {
        $idCidade = $cidade->insert();
    }
        
    //Cadastrar endereco antes de salvar
    $endereco = new Endereco();
    $endereco->setDados($_POST);
    $endereco->setcidade_id($idCidade);
    $idEndereco = $endereco->insert();

    $dados = new Dados();
    $dados->setDados($_POST);
    $dados->setendereco_id($idEndereco);
    $idDados = $dados->insert();
    
    $fornecedor = new Fornecedor();
    $fornecedor->setdados_id($idDados);

    if ($fornecedor->insert()) {
        $_SESSION['t'] = 'success';
        $_SESSION['msg'] = 'Inseriu';
    } else {
        $_SESSION['t'] = 'erro';
        $_SESSION['msg'] = 'Não Inseriu';
    }
    
    header('location: ./');
    die();
}

if (isset($_POST['view'])) {
    $fornecedor = new Fornecedor();
    $fornecedor->get($_POST['view']);
    echo $fornecedor->showView();
    die();
}

if (isset($_POST['del'])) {
    $fornecedor = new Fornecedor();
    $fornecedor->get($_POST['del']);
    echo $fornecedor->showDelete();
    die();
}

if (isset($_POST['excluir'])) {
    $_SESSION['t'] = 'erro';
    $_SESSION['msg'] = 'Não deixei você fazer essa burrada!';
    header('location: ./');
    die();
}

if (isset($_POST['find_exists'])) {

    $find = $_POST['find_exists'];

    $fornecedor = new Fornecedor();
    $fornecedor->whereAdd('nome like "' . $find . '"');
    echo $fornecedor->count();
    die();
}