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
ADD COLUMN `nome` VARCHAR(100) NULL DEFAULT NULL AFTER `cnpj`;

ALTER TABLE `frutlever`.`propriedade` 
ADD COLUMN `data_atualizacao` DATETIME NULL DEFAULT NULL AFTER `email`;

ALTER TABLE `frutlever`.`endereco` 
ADD COLUMN `data_atualizacao` DATETIME NULL DEFAULT NULL AFTER `longitude`;

ALTER TABLE `frutlever`.`cidade` 
ADD COLUMN `data_atualizacao` DATETIME NULL DEFAULT NULL AFTER `nome`;

ALTER TABLE `frutlever`.`dados` 
ADD COLUMN `data_atualizacao` DATETIME NULL DEFAULT NULL AFTER `logo`;

ALTER TABLE `frutlever`.`produto` 
ADD COLUMN `data_atualizacao` DATETIME NULL DEFAULT NULL AFTER `unidade_id`;

ALTER TABLE `frutlever`.`dados_telefone` 
ADD COLUMN `tipo` INT(11) NOT NULL AFTER `telefone_id`;

ALTER TABLE `frutlever`.`produto` 
ADD COLUMN `nome` VARCHAR(100) NULL DEFAULT NULL AFTER `id`;

ALTER TABLE `frutlever`.`unidade` 
ADD COLUMN `simbolo` VARCHAR(45) NULL DEFAULT NULL AFTER `descricao`;

ALTER TABLE `frutlever`.`produto` 
DROP FOREIGN KEY `fk_produto_unidade1`;

ALTER TABLE `frutlever`.`produto` 
CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `unidade_id` `unidade_id` INT(11) NULL DEFAULT NULL ;

DROP TABLE IF EXISTS `frutlever`.`produto_seq` ;

ALTER TABLE `frutlever`.`produto` 
ADD CONSTRAINT `fk_produto_unidade1`
  FOREIGN KEY (`unidade_id`)
  REFERENCES `frutlever`.`unidade` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `frutlever`.`foto` 
ADD COLUMN `arquivo` VARCHAR(100) NOT NULL AFTER `nome`;