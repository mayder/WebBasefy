-- MySQL Workbench Synchronization
-- Generated: 2025-04-18 17:59
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Breno Mayder

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `basefy` DEFAULT CHARACTER SET utf8mb3 ;

CREATE TABLE IF NOT EXISTS `basefy`.`usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `senha_hash` VARCHAR(255) NULL DEFAULT NULL,
  `auth_key` VARCHAR(32) NULL DEFAULT NULL,
  `token_verificacao_email` VARCHAR(255) NULL DEFAULT NULL,
  `access_token` VARCHAR(255) NULL DEFAULT NULL,
  `token_reset_senha` VARCHAR(255) NULL DEFAULT NULL,
  `expira_token_reset` DATETIME NULL DEFAULT NULL,
  `status` BIT(1) NOT NULL DEFAULT b'1',
  `admin` BIT(1) NOT NULL DEFAULT b'0',
  `ultimo_acesso` DATETIME NULL DEFAULT NULL,
  `data_cadastro` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
