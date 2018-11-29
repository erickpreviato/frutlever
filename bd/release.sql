/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Favaro
 * Created: 29/11/2018
 */

ALTER TABLE `frutlever`.`dados` 
ADD COLUMN `nome_fantasia` VARCHAR(200) NULL DEFAULT NULL AFTER `razao_social`,
ADD COLUMN `nome` VARCHAR(100) NULL DEFAULT NULL AFTER `cnpj`
