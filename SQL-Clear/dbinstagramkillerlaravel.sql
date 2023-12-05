SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `dbinstagramkillerlaravel`.`usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `dbinstagramkillerlaravel`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `rol` VARCHAR(45) NULL ,
  `nombre` VARCHAR(45) NULL ,
  `apellido` VARCHAR(45) NULL ,
  `alias` VARCHAR(45) NULL ,
  `correo` VARCHAR(45) NULL ,
  `clave` VARCHAR(255) NULL ,
  `imagen` VARCHAR(255) NULL ,
  `remember_token` VARCHAR(255) NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbinstagramkillerlaravel`.`imagen`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `dbinstagramkillerlaravel`.`imagen` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `imagen` VARCHAR(255) NULL ,
  `descripcion` TEXT NULL ,
  `usuario_id` INT NOT NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`, `usuario_id`) ,
  INDEX `fk_imagen_usuario1_idx` (`usuario_id` ASC) ,
  CONSTRAINT `fk_imagen_usuario1`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `dbinstagramkillerlaravel`.`usuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbinstagramkillerlaravel`.`comentario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `dbinstagramkillerlaravel`.`comentario` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `contenido` VARCHAR(255) NULL ,
  `usuario_id` INT NOT NULL ,
  `imagen_id` INT NOT NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`, `usuario_id`, `imagen_id`) ,
  INDEX `fk_comentario_usuario_idx` (`usuario_id` ASC) ,
  INDEX `fk_comentario_imagen1_idx` (`imagen_id` ASC) ,
  CONSTRAINT `fk_comentario_usuario`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `dbinstagramkillerlaravel`.`usuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentario_imagen1`
    FOREIGN KEY (`imagen_id` )
    REFERENCES `dbinstagramkillerlaravel`.`imagen` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbinstagramkillerlaravel`.`like`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `dbinstagramkillerlaravel`.`like` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `usuario_id` INT NOT NULL ,
  `imagen_id` INT NOT NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`, `usuario_id`, `imagen_id`) ,
  INDEX `fk_like_usuario1_idx` (`usuario_id` ASC) ,
  INDEX `fk_like_imagen1_idx` (`imagen_id` ASC) ,
  CONSTRAINT `fk_like_usuario1`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `dbinstagramkillerlaravel`.`usuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_like_imagen1`
    FOREIGN KEY (`imagen_id` )
    REFERENCES `dbinstagramkillerlaravel`.`imagen` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
