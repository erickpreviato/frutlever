-- MySQL Script generated by MySQL Workbench
-- Seg 22 Out 2018 14:38:27 -03
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema frutlever
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema frutlever
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `frutlever` DEFAULT CHARACTER SET utf8 ;
USE `frutlever` ;

-- -----------------------------------------------------
-- Table `frutlever`.`pais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`pais` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL,
  `codigo` VARCHAR(2) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`estado` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL,
  `sigla` VARCHAR(2) NULL,
  `pais_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_estado_pais1_idx` (`pais_id` ASC),
  CONSTRAINT `fk_estado_pais1`
    FOREIGN KEY (`pais_id`)
    REFERENCES `frutlever`.`pais` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`cidade` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL,
  `estado_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cidade_estado1_idx` (`estado_id` ASC),
  CONSTRAINT `fk_cidade_estado1`
    FOREIGN KEY (`estado_id`)
    REFERENCES `frutlever`.`estado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`endereco` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NULL,
  `logradouro` VARCHAR(200) NULL,
  `numero` VARCHAR(45) NULL,
  `bairro` VARCHAR(100) NULL,
  `cep` VARCHAR(10) NULL,
  `latitude` VARCHAR(50) NULL,
  `longitude` VARCHAR(50) NULL,
  `cidade_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_endereco_cidade1_idx` (`cidade_id` ASC),
  CONSTRAINT `fk_endereco_cidade1`
    FOREIGN KEY (`cidade_id`)
    REFERENCES `frutlever`.`cidade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`dados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`dados` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `razao_social` VARCHAR(255) NULL,
  `cnpj` VARCHAR(20) NULL,
  `cpf` VARCHAR(15) NULL,
  `inscricao` VARCHAR(50) NULL,
  `rg` VARCHAR(15) NULL,
  `email` VARCHAR(100) NULL,
  `informacoes` TEXT NULL,
  `logo` VARCHAR(50) NULL,
  `endereco_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_dados_endereco1_idx` (`endereco_id` ASC),
  CONSTRAINT `fk_dados_endereco1`
    FOREIGN KEY (`endereco_id`)
    REFERENCES `frutlever`.`endereco` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `categoria` VARCHAR(45) NULL,
  `status` VARCHAR(1) NULL,
  `dados_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_usuario_dados1_idx` (`dados_id` ASC),
  CONSTRAINT `fk_usuario_dados1`
    FOREIGN KEY (`dados_id`)
    REFERENCES `frutlever`.`dados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`propriedade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`propriedade` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL,
  `cnpj` VARCHAR(50) NULL,
  `inscricao` VARCHAR(50) NULL,
  `email` VARCHAR(100) NULL,
  `endereco_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_propriedade_endereco_idx` (`endereco_id` ASC),
  CONSTRAINT `fk_propriedade_endereco`
    FOREIGN KEY (`endereco_id`)
    REFERENCES `frutlever`.`endereco` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`telefone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`telefone` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`propriedade_telefone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`propriedade_telefone` (
  `propriedade_id` INT NOT NULL,
  `telefone_id` INT NOT NULL,
  PRIMARY KEY (`propriedade_id`, `telefone_id`),
  INDEX `fk_propriedade_has_telefone_telefone1_idx` (`telefone_id` ASC),
  INDEX `fk_propriedade_has_telefone_propriedade1_idx` (`propriedade_id` ASC),
  CONSTRAINT `fk_propriedade_has_telefone_propriedade1`
    FOREIGN KEY (`propriedade_id`)
    REFERENCES `frutlever`.`propriedade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_propriedade_has_telefone_telefone1`
    FOREIGN KEY (`telefone_id`)
    REFERENCES `frutlever`.`telefone` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`grupo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`grupo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`unidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`unidade` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`produto` (
  `id` INT NOT NULL,
  `quantidade` INT NULL,
  `codigo_barras` VARCHAR(45) NULL,
  `descricao` TEXT NULL,
  `e_origem` VARCHAR(45) NULL,
  `grupo_id` INT NOT NULL,
  `unidade_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_produto_grupo1_idx` (`grupo_id` ASC),
  INDEX `fk_produto_unidade1_idx` (`unidade_id` ASC),
  CONSTRAINT `fk_produto_grupo1`
    FOREIGN KEY (`grupo_id`)
    REFERENCES `frutlever`.`grupo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_unidade1`
    FOREIGN KEY (`unidade_id`)
    REFERENCES `frutlever`.`unidade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`fornecedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`fornecedor` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `dados_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_fornecedor_dados1_idx` (`dados_id` ASC),
  CONSTRAINT `fk_fornecedor_dados1`
    FOREIGN KEY (`dados_id`)
    REFERENCES `frutlever`.`dados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`varejista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`varejista` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `dados_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_varejista_dados1_idx` (`dados_id` ASC),
  CONSTRAINT `fk_varejista_dados1`
    FOREIGN KEY (`dados_id`)
    REFERENCES `frutlever`.`dados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`rastreio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`rastreio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `quantidade` INT NULL,
  `unidade` VARCHAR(45) NULL,
  `data_fabricacao` DATETIME NULL,
  `data_validade` DATETIME NULL,
  `nfe` VARCHAR(50) NULL,
  `tipo_lote` VARCHAR(45) NULL,
  `lote` VARCHAR(45) NULL,
  `lote_consolidado` VARCHAR(45) NULL,
  `produto_id` INT NOT NULL,
  `fornecedor_id` INT NULL,
  `varejista_id` INT NULL,
  `usuario_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_lote_produto1_idx` (`produto_id` ASC),
  INDEX `fk_lote_fornecedor1_idx` (`fornecedor_id` ASC),
  INDEX `fk_lote_varejista1_idx` (`varejista_id` ASC),
  INDEX `fk_lote_usuario1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_lote_produto1`
    FOREIGN KEY (`produto_id`)
    REFERENCES `frutlever`.`produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lote_fornecedor1`
    FOREIGN KEY (`fornecedor_id`)
    REFERENCES `frutlever`.`fornecedor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lote_varejista1`
    FOREIGN KEY (`varejista_id`)
    REFERENCES `frutlever`.`varejista` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lote_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `frutlever`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`usuario_propriedade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`usuario_propriedade` (
  `usuario_id` INT NOT NULL,
  `propriedade_id` INT NOT NULL,
  PRIMARY KEY (`usuario_id`, `propriedade_id`),
  INDEX `fk_usuario_has_propriedade_propriedade1_idx` (`propriedade_id` ASC),
  INDEX `fk_usuario_has_propriedade_usuario1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_usuario_has_propriedade_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `frutlever`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_propriedade_propriedade1`
    FOREIGN KEY (`propriedade_id`)
    REFERENCES `frutlever`.`propriedade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`dados_telefone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`dados_telefone` (
  `dados_id` INT NOT NULL,
  `telefone_id` INT NOT NULL,
  PRIMARY KEY (`dados_id`, `telefone_id`),
  INDEX `fk_dados_has_telefone_telefone1_idx` (`telefone_id` ASC),
  INDEX `fk_dados_has_telefone_dados1_idx` (`dados_id` ASC),
  CONSTRAINT `fk_dados_has_telefone_dados1`
    FOREIGN KEY (`dados_id`)
    REFERENCES `frutlever`.`dados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dados_has_telefone_telefone1`
    FOREIGN KEY (`telefone_id`)
    REFERENCES `frutlever`.`telefone` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`foto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`foto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`dados_foto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`dados_foto` (
  `dados_id` INT NOT NULL,
  `foto_id` INT NOT NULL,
  PRIMARY KEY (`dados_id`, `foto_id`),
  INDEX `fk_dados_has_foto_foto1_idx` (`foto_id` ASC),
  INDEX `fk_dados_has_foto_dados1_idx` (`dados_id` ASC),
  CONSTRAINT `fk_dados_has_foto_dados1`
    FOREIGN KEY (`dados_id`)
    REFERENCES `frutlever`.`dados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dados_has_foto_foto1`
    FOREIGN KEY (`foto_id`)
    REFERENCES `frutlever`.`foto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`produto_unidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`produto_unidade` (
  `produto_id` INT NOT NULL,
  `unidade_id` INT NOT NULL,
  PRIMARY KEY (`produto_id`, `unidade_id`),
  INDEX `fk_produto_has_unidade_unidade1_idx` (`unidade_id` ASC),
  INDEX `fk_produto_has_unidade_produto1_idx` (`produto_id` ASC),
  CONSTRAINT `fk_produto_has_unidade_produto1`
    FOREIGN KEY (`produto_id`)
    REFERENCES `frutlever`.`produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_has_unidade_unidade1`
    FOREIGN KEY (`unidade_id`)
    REFERENCES `frutlever`.`unidade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frutlever`.`produto_foto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frutlever`.`produto_foto` (
  `produto_id` INT NOT NULL,
  `foto_id` INT NOT NULL,
  PRIMARY KEY (`produto_id`, `foto_id`),
  INDEX `fk_produto_has_foto_foto1_idx` (`foto_id` ASC),
  INDEX `fk_produto_has_foto_produto1_idx` (`produto_id` ASC),
  CONSTRAINT `fk_produto_has_foto_produto1`
    FOREIGN KEY (`produto_id`)
    REFERENCES `frutlever`.`produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_has_foto_foto1`
    FOREIGN KEY (`foto_id`)
    REFERENCES `frutlever`.`foto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;