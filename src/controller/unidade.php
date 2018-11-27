<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['new'])) {
    $unidade = new Unidade();
    echo $unidade->showForm();
    die();
}

if (isset($_POST['edit'])) {
    $unidade = new Unidade();
    $unidade->get($_POST['edit']);
    echo $unidade->showForm($unidade->id);
    die();
}

if (isset($_POST['salvar'])) {

    $unidade = new Unidade();

    $insert = (isset($_POST{'id'}) && $_POST['id'] > 0) ? false : true;
    if (!$insert)
        $unidade->get($_POST['id']);

    $unidade->set_dados($_POST);

    if ($insert) {
        $id = $unidade->insert();
        if ($id) {
            $_SESSION['t'] = 'success';
            $_SESSION['msg'] = 'Inseriu';
        } else {
            $_SESSION['t'] = 'erro';
            $_SESSION['msg'] = 'Não Inseriu';
        }
    } else {
        $id = $unidade->update();
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
    $unidade = new Unidade();
    $unidade->get($_POST['view']);
    echo $unidade->showView();
    die();
}

if (isset($_POST['del'])) {
    $unidade = new Unidade();
    $unidade->get($_POST['del']);
    echo $unidade->showDelete();
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

    $unidade = new Unidade();
    $unidade->whereAdd('nome like "' . $find . '"');
    echo $unidade->count();
    die();
}