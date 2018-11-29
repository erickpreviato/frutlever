<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['new'])) {
    $grupo = new Grupo();
    echo $grupo->showForm();
    die();
}

if (isset($_POST['edit'])) {
    $grupo = new Grupo();
    $grupo->get($_POST['edit']);
    echo $grupo->showForm($grupo->id);
    die();
}

if (isset($_POST['salvar'])) {

    $grupo = new Grupo();

    $insert = (isset($_POST{'id'}) && $_POST['id'] > 0) ? false : true;
    if (!$insert)
        $grupo->get($_POST['id']);

    $grupo->setDados($_POST);

    if ($insert) {
        $id = $grupo->insert();
        if ($id) {
            $_SESSION['t'] = 'success';
            $_SESSION['msg'] = 'Inseriu';
        } else {
            $_SESSION['t'] = 'erro';
            $_SESSION['msg'] = 'Não Inseriu';
        }
    } else {
        $id = $grupo->update();
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
    $grupo = new Grupo();
    $grupo->get($_POST['view']);
    echo $grupo->showView();
    die();
}

if (isset($_POST['del'])) {
    $grupo = new Grupo();
    $grupo->get($_POST['del']);
    echo $grupo->showDelete();
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

    $grupo = new Grupo();
    $grupo->whereAdd('nome like "' . $find . '"');
    echo $grupo->count();
    die();
}