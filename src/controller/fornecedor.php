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

    $fornecedor = new Fornecedor();

    $insert = (isset($_POST{'id'}) && $_POST['id'] > 0) ? false : true;
    if (!$insert)
        $fornecedor->get($_POST['id']);

    $fornecedor->set_dados($_POST);

    if ($insert) {
        $id = $fornecedor->insert();
        if ($id) {
            $_SESSION['t'] = 'success';
            $_SESSION['msg'] = 'Inseriu';
        } else {
            $_SESSION['t'] = 'erro';
            $_SESSION['msg'] = 'Não Inseriu';
        }
    } else {
        $id = $fornecedor->update();
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