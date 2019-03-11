<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function includes(){
    foreach(glob(MODEL_DIR.'/*.php') as $arquivo){
        include_once $arquivo;
    }
}

function show_message() {
    if (isset($_SESSION['msg'])) {
        $msg = $_SESSION['msg'];
        $t = $_SESSION['t'];

        unset($_SESSION['msg']);
        unset($_SESSION['t']);

        $tipo = ($t == 'success') ? ' alert-success' : ' alert-danger';
        $msg = '<section class="content-header"><div class="alert' . $tipo . '">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            ' . $msg . ' </div></section>';
    } else {
        $msg = '';
    }
    return $msg;
}

function show_nao_encontrado() {
    return '<span class="text-muted"><cite>Não Encontrado</cite></span>';
}

function arquivo($diretorio, $name, $tipo, $nome) {
    
    $nome_ext = $nome . '.' . $tipo;

    $erro = 'true';
// Pasta onde o arquivo vai ser salvo
    $_UP['pasta'] = $diretorio;

// Tamanho máximo do arquivo (em Bytes)
//$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
    $_UP['tamanho'] = 1024 * 1024 * ini_get("upload_max_filesize");
// Array com as extensões permitidas
    $_UP['extensoes'] = array($tipo);

// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
    $_UP['renomeia'] = true;

// Array com os tipos de erros de upload do PHP
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
    if ($_FILES[$name]['error'] != 0) {
        $erro = 'Não foi possível fazer o upload do arquivo.';
//die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['file']['error']]);
//exit; // Para a execução do script
    }

// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
// Faz a verificação da extensão do arquivo
    $extensao = strtolower(end(explode('.', $_FILES[$name]['name'])));
    if (array_search($extensao, $_UP['extensoes']) === false) {
        $erro = "Por favor, envie arquivos com a seguinte extensão: " . $tipo;
    }

// Faz a verificação do tamanho do arquivo
    else if ($_UP['tamanho'] < $_FILES[$name]['size']) {
        $erro = "O arquivo enviado é muito grande, envie arquivos de até " . $_UP['tamanho'] . "Mb.";
    }

// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
    else {
//// Primeiro verifica se deve trocar o nome do arquivo
//        if ($_UP['renomeia'] == true) {
//// Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .pdf
//
//            $nome_final = time() . '.pdf';
//
//            //--- Aciona a variavel global (nome_arq) e atribui o nome final para salvar
//            global $nome_arq;
//            $nome_arq = $nome_final;
//        } else {
//// Mantém o nome original do arquivo
//            $nome_final = $_FILES['AtivDidaticas']['name'];
//        }
// Depois verifica se é possível mover o arquivo para a pasta escolhida
        if (move_uploaded_file($_FILES[$name]['tmp_name'], $_UP['pasta'] . $nome_ext)) {
// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
//echo "Upload efetuado com sucesso!";
//echo '<br /><a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
            if ($tipo == 'jpg') {
//verificando mimetype
                $mimeImagem = mime_content_type($_UP['pasta'] . $nome_ext);
                switch ($mimeImagem) {
                    case 'image/jpg':
                    case 'image/jpeg':
                    case 'jpeg':
                    case 'jpg':
                        $erro = 'true';
                        break;
                    default:
//apaga o arquivo invalido
                        unlink($_UP['pasta'] . $nome_ext);
                        $erro = 'Arquivo JPG inv&aacute;lido: formato detectado ' . $mimeImagem;
                }
            } else {
                $erro = 'true';
            }
        }
    }

    return $erro;
}


function send($nomeDest, $emailDest, $nomeFrom, $emailFrom, $texto, $titulo, $replyTo = null, $emailCC = null, $nomeCC = null, $file = null) {

    $mail = new PHPMailer();
    $mail->IsSMTP(); // Define que a mensagem será SMTP
    $mail->SMTPDebug = 1;  // Debugar: 1 = erros e mensagens, 2 = mensagens apenas //registrar sempre!
    //$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
    $mail->SMTPSecure = 'tls';
//$mail->Host = "smtp.icmc.usp.br"; // Endereço do servidor SMTP
    $mail->Host = 'smtp.gmail.com'; // Endereço do servidor SMTP
//$mail->Port = "587";
    $mail->Port = '587';
//$mail->Username = 'sys_sira@icmc.usp.br'; // Usuário do servidor SMTP
    $mail->Username = 'contato@econsistemas.com.br'; // Usuário do servidor SMTP
    $mail->Password = ''; // Senha do servidor SMTP
//$mail->isHTML();
//----    $mail->addReplyTo($replyTo);
// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->From = $emailFrom; // Seu e-mail
    $mail->FromName = utf8_decode($nomeFrom); // Seu nome
// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->AddAddress($emailDest, utf8_decode($nomeDest));
    //$mail->AddCC($emailCC, utf8_decode($nomeCC)); // Copia
    //$mail->AddBCC('contato@econsistemas.com.br', 'Administrador'); // Copia oculta
    //informações para auditoria
    $assinaturaAudit = md5($emailFrom . '_' . $emailDest . '_FRUTLEVER');
    $mail->addCustomHeader('FRUTLEVER', $assinaturaAudit);


    if ($file) {
        $mail->addAttachment($file);
    }

// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    /* Montando a mensagem a ser enviada no corpo do e-mail. */
    $mensagemHTML = $texto;

//$mensagemHTML .= '<p>Mensagem enviada automaticamente, por favor não responda diretamente.</p>';

    $assunto = utf8_decode('[FrutLeVer] ' . $titulo);

    $mail->IsHTML(true);
    $mail->Subject = $assunto; // Assunto da mensagem
    $mail->Body = utf8_decode($mensagemHTML);

// Envia o e-mail
    if (!$mail->Send()) {
        $ret = $mail->ErrorInfo();
    } else {
        $ret = true;
    }


// Limpa os destinatários e os anexos
    $mail->ClearAllRecipients();
    $mail->ClearAttachments();

    return $ret;
}