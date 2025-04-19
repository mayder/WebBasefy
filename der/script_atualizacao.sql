-- MySQL Workbench Synchronization
-- Generated: 2025-04-18 21:13
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Breno Mayder

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `basefy`.`usuario` 
ADD COLUMN `idioma_id` INT(11) NULL DEFAULT NULL AFTER `foto_perfil`,
ADD INDEX `fk_usuario_idioma1_idx` (`idioma_id` ASC) VISIBLE;
;

CREATE TABLE IF NOT EXISTS `basefy`.`perfil` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `sigla` VARCHAR(20) NOT NULL,
  `status` BIT(1) NOT NULL DEFAULT b'1',
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`funcionalidade` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `chave` VARCHAR(45) NOT NULL,
  `modulo_id` INT(11) NULL DEFAULT NULL,
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_funcionalidade_modulo1_idx` (`modulo_id` ASC) VISIBLE,
  CONSTRAINT `fk_funcionalidade_modulo1`
    FOREIGN KEY (`modulo_id`)
    REFERENCES `basefy`.`modulo` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`perfil_funcionalidade` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `perfil_id` INT(11) NOT NULL,
  `funcionalidade_id` INT(11) NOT NULL,
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_perfil_funcionalidade_perfil_idx` (`perfil_id` ASC) VISIBLE,
  UNIQUE INDEX `uq_perfil_funcionalidade` (`perfil_id` ASC, `funcionalidade_id` ASC) VISIBLE,
  INDEX `fk_perfil_funcionalidade_funcionalidade1_idx` (`funcionalidade_id` ASC) VISIBLE,
  CONSTRAINT `fk_perfil_funcionalidade_funcionalidade1`
    FOREIGN KEY (`funcionalidade_id`)
    REFERENCES `basefy`.`funcionalidade` (`id`),
  CONSTRAINT `fk_perfil_funcionalidade_perfil`
    FOREIGN KEY (`perfil_id`)
    REFERENCES `basefy`.`perfil` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`cliente` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `plano_id` INT(11) NOT NULL,
  `status` BIT(1) NOT NULL DEFAULT b'1',
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_cliente_plano1_idx` (`plano_id` ASC) VISIBLE,
  CONSTRAINT `fk_cliente_plano1`
    FOREIGN KEY (`plano_id`)
    REFERENCES `basefy`.`plano` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`plano` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `status` BIT(1) NOT NULL DEFAULT b'1',
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`cliente_usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` INT(11) NOT NULL,
  `usuario_id` INT(11) NOT NULL,
  `perfil_id` INT(11) NOT NULL,
  `status` BIT(1) NOT NULL DEFAULT b'1',
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `uq_cliente_usuario` (`cliente_id` ASC, `usuario_id` ASC) VISIBLE,
  INDEX `fk_cliente_usuario_cliente1_idx` (`cliente_id` ASC) VISIBLE,
  INDEX `fk_cliente_usuario_usuario1_idx` (`usuario_id` ASC) VISIBLE,
  INDEX `fk_cliente_usuario_perfil1_idx` (`perfil_id` ASC) VISIBLE,
  CONSTRAINT `fk_cliente_usuario_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `basefy`.`cliente` (`id`),
  CONSTRAINT `fk_cliente_usuario_perfil1`
    FOREIGN KEY (`perfil_id`)
    REFERENCES `basefy`.`perfil` (`id`),
  CONSTRAINT `fk_cliente_usuario_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `basefy`.`usuario` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`modulo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `icone` VARCHAR(45) NULL DEFAULT NULL,
  `ordem` INT(11) NULL DEFAULT NULL,
  `status` BIT(1) NOT NULL DEFAULT b'1',
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`plano_modulo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `plano_id` INT(11) NOT NULL,
  `modulo_id` INT(11) NOT NULL,
  `status` BIT(1) NOT NULL DEFAULT b'1',
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `uq_plano_modulo` (`plano_id` ASC, `modulo_id` ASC) VISIBLE,
  INDEX `fk_plano_modulo_plano1_idx` (`plano_id` ASC) VISIBLE,
  INDEX `fk_plano_modulo_modulo1_idx` (`modulo_id` ASC) VISIBLE,
  CONSTRAINT `fk_plano_modulo_modulo1`
    FOREIGN KEY (`modulo_id`)
    REFERENCES `basefy`.`modulo` (`id`),
  CONSTRAINT `fk_plano_modulo_plano1`
    FOREIGN KEY (`plano_id`)
    REFERENCES `basefy`.`plano` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`plano_restricao` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `plano_id` INT(11) NOT NULL,
  `chave` VARCHAR(45) NOT NULL,
  `valor` VARCHAR(45) NOT NULL,
  `tipo` VARCHAR(20) NOT NULL,
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_plano_restricao_plano1_idx` (`plano_id` ASC) VISIBLE,
  CONSTRAINT `fk_plano_restricao_plano1`
    FOREIGN KEY (`plano_id`)
    REFERENCES `basefy`.`plano` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`session` (
  `id` CHAR(40) NOT NULL,
  `expire` INT(11) NULL DEFAULT NULL,
  `data` BLOB NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`queue` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `channel` VARCHAR(255) NOT NULL,
  `job` BLOB NOT NULL,
  `pushed_at` INT(11) NULL DEFAULT NULL,
  `ttr` INT(11) NULL DEFAULT NULL,
  `delay` INT(11) NULL DEFAULT NULL,
  `priority` INT(11) NULL DEFAULT NULL,
  `reserved_at` INT(11) NULL DEFAULT NULL,
  `done_at` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`idioma` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `sigla` VARCHAR(10) NOT NULL,
  `status` BIT(1) NOT NULL DEFAULT b'1',
  `padrao` BIT(1) NOT NULL DEFAULT b'0',
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`mensagem` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tipo` ENUM('email', 'push', 'sms', 'webhook', 'whatsapp') NOT NULL,
  `usuario_id` INT(11) NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `conteudo` LONGTEXT NOT NULL,
  `status_envio` ENUM('pendente', 'enviado', 'erro') NOT NULL DEFAULT 'pendente',
  `tentativa` INT(11) NOT NULL DEFAULT 0,
  `max_tentativa` INT(11) NOT NULL DEFAULT 5,
  `data_agendada` DATETIME NULL DEFAULT NULL,
  `data_envio` DATETIME NULL DEFAULT NULL,
  `erro` TEXT NULL DEFAULT NULL,
  `usuario_id_cad` INT(11) NOT NULL,
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_mensagem_usuario1_idx` (`usuario_id` ASC) VISIBLE,
  INDEX `fk_mensagem_usuario2_idx` (`usuario_id_cad` ASC) VISIBLE,
  CONSTRAINT `fk_mensagem_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `basefy`.`usuario` (`id`),
  CONSTRAINT `fk_mensagem_usuario2`
    FOREIGN KEY (`usuario_id_cad`)
    REFERENCES `basefy`.`usuario` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`notificacao_sistema` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(11) NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `conteudo` TEXT NULL DEFAULT NULL,
  `tipo` ENUM('info', 'warning', 'success', 'danger') NOT NULL,
  `link` TEXT NULL DEFAULT NULL,
  `lida` BIT(1) NOT NULL DEFAULT b'0',
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_notificacao_sistema_usuario1_idx` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_notificacao_sistema_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `basefy`.`usuario` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`ticket` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(11) NOT NULL,
  `cliente_id` INT(11) NULL DEFAULT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  `tipo_id` INT(11) NOT NULL,
  `status_id` INT(11) NOT NULL,
  `publico` BIT(1) NOT NULL DEFAULT b'0',
  `prioridade` ENUM('baixa', 'media', 'alta') NULL DEFAULT NULL,
  `voto` INT(11) NULL DEFAULT 0,
  `data_resposta` DATETIME NULL DEFAULT NULL,
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_ticket_usuario1_idx` (`usuario_id` ASC) VISIBLE,
  INDEX `fk_ticket_cliente1_idx` (`cliente_id` ASC) VISIBLE,
  INDEX `fk_ticket_ticket_tipo1_idx` (`tipo_id` ASC) VISIBLE,
  INDEX `fk_ticket_ticket_status1_idx` (`status_id` ASC) VISIBLE,
  CONSTRAINT `fk_ticket_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `basefy`.`cliente` (`id`),
  CONSTRAINT `fk_ticket_ticket_status1`
    FOREIGN KEY (`status_id`)
    REFERENCES `basefy`.`ticket_status` (`id`),
  CONSTRAINT `fk_ticket_ticket_tipo1`
    FOREIGN KEY (`tipo_id`)
    REFERENCES `basefy`.`ticket_tipo` (`id`),
  CONSTRAINT `fk_ticket_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `basefy`.`usuario` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`ticket_tipo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `publico` BIT(1) NOT NULL DEFAULT b'0',
  `status` BIT(1) NOT NULL DEFAULT b'1',
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`ticket_status` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `status` BIT(1) NOT NULL DEFAULT b'1',
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`ticket_voto` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` INT(11) NOT NULL,
  `usuario_id` INT(11) NOT NULL,
  `voto` ENUM('aprova', 'reprova') NOT NULL,
  `observacao` TEXT NULL DEFAULT NULL,
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_ticket_voto_ticket1_idx` (`ticket_id` ASC) VISIBLE,
  INDEX `fk_ticket_voto_usuario1_idx` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_ticket_voto_ticket1`
    FOREIGN KEY (`ticket_id`)
    REFERENCES `basefy`.`ticket` (`id`),
  CONSTRAINT `fk_ticket_voto_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `basefy`.`usuario` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

CREATE TABLE IF NOT EXISTS `basefy`.`ticket_resposta` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` INT(11) NOT NULL,
  `usuario_id` INT(11) NOT NULL,
  `conteudo` TEXT NOT NULL,
  `publico` BIT(1) NOT NULL DEFAULT b'0',
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_ticket_resposta_ticket1_idx` (`ticket_id` ASC) VISIBLE,
  INDEX `fk_ticket_resposta_usuario1_idx` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_ticket_resposta_ticket1`
    FOREIGN KEY (`ticket_id`)
    REFERENCES `basefy`.`ticket` (`id`),
  CONSTRAINT `fk_ticket_resposta_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `basefy`.`usuario` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

ALTER TABLE `basefy`.`usuario` 
ADD CONSTRAINT `fk_usuario_idioma1`
  FOREIGN KEY (`idioma_id`)
  REFERENCES `basefy`.`idioma` (`id`);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
