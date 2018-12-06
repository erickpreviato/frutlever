<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['new'])) {
    $varejista = new Varejista();
    echo $varejista->showForm();
    die();
}

if (isset($_POST['edit'])) {
    $varejista = new Varejista();
    $varejista->get($_POST['edit']);
    echo $varejista->showForm($varejista->id);
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

    if (!$_POST['id']) {

        //Cadastrar endereco antes de salvar
        $endereco = new Endereco();
        $endereco->setDados($_POST);
        $endereco->setcidade_id($idCidade);
        $idEndereco = $endereco->insert();

        $dados = new Dados();
        $dados->setDados($_POST);
        $dados->setendereco_id($idEndereco);
        $idDados = $dados->insert();
        
        if (isset($_POST['tel1']) || isset($_POST['tel2']) || isset($_POST['tel3'])) {
            for ($i = 1; $i <= 3; $i++) {
                if (!empty($_POST['tel'.$i])) {
                    $telefone = new Telefone();
                    $telefone->setnumero($_POST['tel'.$i]);
                    $idTelefone = $telefone->insert();
                    
                    $dt = new Dados_telefone();
                    $dt->setdados_id($idDados);
                    $dt->settelefone_id($idTelefone);
                    $dt->settipo($i);
                    $dt->insert();
                }
            }
        }

        $varejista = new Varejista();
        $varejista->setdados_id($idDados);

        if ($varejista->insert()) {
            $_SESSION['t'] = 'success';
            $_SESSION['msg'] = 'Inseriu';
        } else {
            $_SESSION['t'] = 'erro';
            $_SESSION['msg'] = 'Não Inseriu';
        }
    } else {

        $varejista = new Varejista();
        $varejista->get($_POST['id']);

        $dados = new Dados();
        $dados->get($varejista->getdados_id());
        $dados->setDados($_POST);
        $dados->update();
        
        $dadosTelefone = new Dados_telefone();
        $dadosTelefone->setdados_id($dados->getid());
        $dadosTelefone->find();
        while ($dadosTelefone->fetch()) {
            $idTelefone = $dadosTelefone->gettelefone_id();
            $dadosTelefone->delete();
            
            $telefone = new Telefone();
            $telefone->get($idTelefone);
            $telefone->delete();
            
        }
        
        if (isset($_POST['tel1']) || isset($_POST['tel2']) || isset($_POST['tel3'])) {
            for ($i = 1; $i <= 3; $i++) {
                if (!empty($_POST['tel'.$i])) {
                    $telefone = new Telefone();
                    $telefone->setnumero($_POST['tel'.$i]);
                    $idTelefone = $telefone->insert();
                    
                    $dt = new Dados_telefone();
                    $dt->setdados_id($dados->getid());
                    $dt->settelefone_id($idTelefone);
                    $dt->settipo($i);
                    $dt->insert();
                }
            }
        }

        $endereco = new Endereco();
        $endereco->get($dados->getendereco_id());
        $endereco->setDados($_POST);
        $endereco->setcidade_id($idCidade);
        $idEndereco = $endereco->update();

        if ($idDados || $idEndereco) {
            $_SESSION['t'] = 'success';
            $_SESSION['msg'] = 'Alterous';
        } else {
            $_SESSION['t'] = 'erro';
            $_SESSION['msg'] = 'não Alterous';
        }
    }
    header('location: ./');
    die();
}

if (isset($_POST['view'])) {
    $varejista = new Varejista();
    $varejista->get($_POST['view']);
    echo $varejista->showView();
    die();
}

if (isset($_POST['del'])) {
    $varejista = new Varejista();
    $varejista->get($_POST['del']);
    echo $varejista->showDelete();
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

    $varejista = new Varejista();
    $varejista->whereAdd('nome like "' . $find . '"');
    echo $varejista->count();
    die();
}