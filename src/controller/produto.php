<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['new'])) {
    $produto = new Produto();
    echo $produto->showForm();
    die();
}

if (isset($_POST['edit'])) {
    $produto = new Produto();
    $produto->get($_POST['edit']);
    echo $produto->showForm($produto->id);
    die();
}

if (isset($_POST['salvar'])) {

    $produto = new Produto();

    $insert = (isset($_POST{'id'}) && $_POST['id'] > 0) ? false : true;
    if (!$insert)
        $produto->get($_POST['id']);

    $produto->setDados($_POST);
    
    //Corrigir
    $produto->setunidade_id(1);

    if ($insert) {
        $id = $produto->insert();
        if ($id) {
            $_SESSION['t'] = 'success';
            $_SESSION['msg'] = 'Inseriu';
        } else {
            $_SESSION['t'] = 'erro';
            $_SESSION['msg'] = 'Não Inseriu';
        }
    } else {
        $id = $produto->update();
        if ($id) {
            $_SESSION['t'] = 'success';
            $_SESSION['msg'] = 'Alterou';
        } else {
            $_SESSION['t'] = 'erro';
            $_SESSION['msg'] = 'Não Alterou';
        }
    }
    header('location: ./');
    die();
}

if (isset($_POST['view'])) {
    $produto = new Produto();
    $produto->get($_POST['view']);
    echo $produto->showView();
    die();
}

if (isset($_POST['del'])) {
    $produto = new Produto();
    $produto->get($_POST['del']);
    echo $produto->showDelete();
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

    $produto = new Produto();
    $produto->whereAdd('nome like "' . $find . '"');
    echo $produto->count();
    die();
}