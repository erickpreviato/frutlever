<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['new'])) {
    $estado = new Estado();
    echo $estado->showForm();
    die();
}

if (isset($_POST['edit'])) {
    $estado = new Estado();
    $estado->get($_POST['edit']);
    echo $estado->showForm($estado->id);
    die();
}

if (isset($_POST['salvar'])) {

    $estado = new Estado();

    $insert = (isset($_POST{'id'}) && $_POST['id'] > 0) ? false : true;
    if (!$insert)
        $estado->get($_POST['id']);

    $estado->set_dados($_POST);

    if ($insert) {
        $estado->insert();
        $_SESSION['t'] = 'success';
        $_SESSION['msg'] = 'Inseriu';
    } else {
        $estado->update();
        $_SESSION['t'] = 'success';
        $_SESSION['msg'] = 'Alterou';
    }


    header('location: ./');
    die();
}

if (isset($_POST['view'])) {
    $estado = new Estado();
    $estado->get($_POST['view']);
    echo $estado->showView();
    die();
}

if (isset($_POST['del'])) {
    $estado = new Estado();
    $estado->get($_POST['del']);
    echo $estado->showDelete();
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
    
    $estado = new Estado();
    $estado->whereAdd('nome like "'.$find.'"');    
    echo $estado->count();
    die();
}