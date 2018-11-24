<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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