<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['new'])) {
    $pais = new Pais();
    echo $pais->showForm();
    die();
}

if (isset($_POST['edit'])) {
    $pais = new Pais();
    $pais->get($_POST['edit']);
    echo $pais->showForm($pais->id);
    die();
}

if (isset($_POST['salvar'])) {

    $pais = new Pais();

    $insert = (isset($_POST{'id'}) && $_POST['id'] > 0) ? false : true;
    if (!$insert)
        $pais->get($_POST['id']);

    $pais->setDados($_POST);

    if ($insert) {
        $pais->insert();
        $_SESSION['t'] = 'success';
        $_SESSION['msg'] = 'Inseriu';
        
        //send('Cadu', 'cadufavaro@gmail.com', 'Cadu From', 'cadufavaro@gmail.com', 'teste de email', 'Cadastro de Pais');
    } else {
        $pais->update();
        $_SESSION['t'] = 'success';
        $_SESSION['msg'] = 'Alterou';
    }


    header('location: ./');
    die();
}

if (isset($_POST['view'])) {
    $pais = new Pais();
    $pais->get($_POST['view']);
    echo $pais->showView();
    die();
}

if (isset($_POST['del'])) {
    $pais = new Pais();
    $pais->get($_POST['del']);
    echo $pais->showDelete();
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
    
    $pais = new Pais();
    $pais->whereAdd('nome like "'.$find.'"');    
    echo $pais->count();
    die();
}