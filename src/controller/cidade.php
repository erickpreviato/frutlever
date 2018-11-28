<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['new'])) {
    $cidade = new Cidade();
    echo $cidade->showForm();
    die();
}

if (isset($_POST['edit'])) {
    $cidade = new Cidade();
    $cidade->get($_POST['edit']);
    echo $cidade->showForm($cidade->id);
    die();
}

if (isset($_POST['showCidade'])) {
    $cidade = new Cidade();
    if ($cidade->get('nome', $_POST['showCidade'])) {
        $estado = new Estado();
        $estado->get($cidade->getestado_id());
        echo $cidade->getid().'--'.$cidade->getnome().'--'.$estado->getsigla();
    } else {
        echo '---';
    }
    die();
}

if (isset($_POST['salvar'])) {

    $cidade = new Cidade();

    $insert = (isset($_POST{'id'}) && $_POST['id'] > 0) ? false : true;
    if (!$insert)
        $cidade->get($_POST['id']);

    $cidade->set_dados($_POST);

    if ($insert) {
        $id = $cidade->insert();
        if ($id) {
            $_SESSION['t'] = 'success';
            $_SESSION['msg'] = 'Inseriu';
        } else {
            $_SESSION['t'] = 'erro';
            $_SESSION['msg'] = 'Não Inseriu';
        }
    } else {
        $id = $cidade->update();
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
    $cidade = new Cidade();
    $cidade->get($_POST['view']);
    echo $cidade->showView();
    die();
}

if (isset($_POST['del'])) {
    $cidade = new Cidade();
    $cidade->get($_POST['del']);
    echo $cidade->showDelete();
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

    $cidade = new Cidade();
    $cidade->whereAdd('nome like "' . $find . '"');
    echo $cidade->count();
    die();
}