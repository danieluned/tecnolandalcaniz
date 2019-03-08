SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `competicion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `media` ;
DROP TABLE IF EXISTS `comentaliga` ;
DROP TABLE IF EXISTS `juega` ;
DROP TABLE IF EXISTS `juegaequipo` ;
DROP TABLE IF EXISTS `jornada` ;
DROP TABLE IF EXISTS `periodosdescanso` ;
DROP TABLE IF EXISTS `comentapartida` ;
DROP TABLE IF EXISTS `subecontenidoliga` ;
DROP TABLE IF EXISTS `inscritoequipo` ;
DROP TABLE IF EXISTS `inscrito` ;
DROP TABLE IF EXISTS `partida` ;
DROP TABLE IF EXISTS `competicion` ;

CREATE TABLE IF NOT EXISTS `competicion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) NULL,
  `info` TEXT NULL,
  `logotipo` VARCHAR(200) NULL,
  `maxequipos` INT NULL DEFAULT 0,
  `minequipos` INT NULL DEFAULT 0,
  `maxjugadoresequipo` INT NULL DEFAULT 0,
  `minjugadoresequipo` INT NULL DEFAULT 0,
  `minjugadores` INT NULL DEFAULT 0,
  `maxjugadores` INT NULL DEFAULT 0,
  `inicioinscripcion` DATETIME NULL ,
  `fininscripcion` DATETIME NULL,
  `iniciofaseregular` DATETIME NULL,
  `finfaseregular` DATETIME NULL,
  `iniciofechapresencial` DATETIME NULL,
  `finfechapresencial` DATETIME NULL,
  `costeinscripcion` DOUBLE NULL,
  `costeinscripcionequipo` DOUBLE NULL,
  `ganar` INT NULL DEFAULT 3,
  `empatar` INT NULL DEFAULT 1,
  `perder` INT NULL DEFAULT 0,
  `fecha` DATETIME NULL,
  `modo` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `partida`
-- 

-- Pendiente: aun no se ha jugado y esta prevista que se juegue 
-- fechada: los jugadores han se
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `partida` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competicion_id` INT NOT NULL,
  `jornada_id` INT NULL,
  `resultado` VARCHAR(45) NULL,
  `horainicio` DATETIME NULL,
  `comentario` VARCHAR(200) NULL,
  `verificado` TINYINT NULL DEFAULT 0,
  `mapa1` VARCHAR(60) NULL,
  `mapa1_resultado` VARCHAR(45) NULL,
  `mapa2` VARCHAR(60) NULL, 
  `mapa2_resultado` VARCHAR(45) NULL,
  `mapa3` VARCHAR(60) NULL, 
  `mapa3_resultado` VARCHAR(45) NULL,
  `mapa4` VARCHAR(60) NULL, 
  `mapa4_resultado` VARCHAR(45) NULL,
  `mapa5` VARCHAR(60) NULL, 
  `mapa5_resultado` VARCHAR(45) NULL,
  `propone_fecha` INT NULL,
  `estado` ENUM('pendiente','cerrada', 'jugando', 'disputa', 'verificando') NULL ,
  
  `info` VARCHAR(200) NULL,
  PRIMARY KEY (`id`, `competicion_id`),
  INDEX `fk_partida_competicion_idx` (`competicion_id` ASC) ,
  CONSTRAINT `fk_partida_competicion`
    FOREIGN KEY (`competicion_id`)
    REFERENCES `competicion` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `inscrito`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `inscrito` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competicion_id` INT NOT NULL,
  `nombre` VARCHAR(200) NULL,
  `equipoinscrito_id` INT NULL,
  `users_id` INT NULL,
  `logotipo` VARCHAR(200) NULL,
  `info` TEXT NULL,
  `fecha` DATETIME NULL,
  PRIMARY KEY (`id`, `competicion_id`),
  INDEX `fk_competicion_has_usuario_competicion1_idx` (`competicion_id` ASC) ,
  CONSTRAINT `fk_competicion_has_usuario_competicion1`
    FOREIGN KEY (`competicion_id`)
    REFERENCES `competicion` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `inscritoequipo`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `inscritoequipo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competicion_id` INT NOT NULL,
  `nombre` VARCHAR(200) NULL,
  `logotipo` VARCHAR(200) NULL,
  `info` TEXT NULL,
  `fecha` DATETIME NULL,
  `capitan` INT NULL,
  PRIMARY KEY (`id`, `competicion_id`),
  INDEX `fk_equipo_competicion1_idx` (`competicion_id` ASC) ,
  CONSTRAINT `fk_equipo_competicion1`
    FOREIGN KEY (`competicion_id`)
    REFERENCES `competicion` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `subecontenidoliga`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `subecontenidoliga` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competicion_id` INT NOT NULL,
  `partida_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  `filename` VARCHAR(200) NULL,
  `tipo` VARCHAR(45) NULL,
  `info` TEXT NULL,
  `fecha` DATETIME NULL,
  PRIMARY KEY (`id`, `competicion_id`, `partida_id`, `users_id`),
  INDEX `fk_contenidomultimedia_partida1_idx` (`partida_id` ASC, `competicion_id` ASC) ,
  CONSTRAINT `fk_contenidomultimedia_partida1`
    FOREIGN KEY (`partida_id` , `competicion_id`)
    REFERENCES `partida` (`id` , `competicion_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comentapartida`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `comentapartida` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competicion_id` INT NOT NULL,
  `partida_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  `texto` TEXT NULL,
  `fecha` DATETIME NULL,
  PRIMARY KEY (`id`, `competicion_id`, `partida_id`, `users_id`),
  INDEX `fk_partida_has_usuario_partida1_idx` (`partida_id` ASC, `competicion_id` ASC) ,
  CONSTRAINT `fk_partida_has_usuario_partida1`
    FOREIGN KEY (`partida_id` , `competicion_id`)
    REFERENCES `partida` (`id` , `competicion_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `periodosdescanso`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `periodosdescanso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competicion_id` INT NOT NULL,
  `fechainicio` DATETIME NULL,
  `fechafin` DATETIME NULL,
  PRIMARY KEY (`id`, `competicion_id`),
  INDEX `fk_periodosdescanso_competicion1_idx` (`competicion_id` ASC) ,
  CONSTRAINT `fk_periodosdescanso_competicion1`
    FOREIGN KEY (`competicion_id`)
    REFERENCES `competicion` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jornada`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `jornada` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competicion_id` INT NOT NULL,
  `fechainicio` DATETIME NULL,
  `fechafin` DATETIME NULL,
  `info` TEXT NULL,
  `estado` ENUM('pendiente','cerrada', 'jugando') NULL,
  PRIMARY KEY (`id`, `competicion_id`),
  INDEX `fk_jornada_competicion1_idx` (`competicion_id` ASC) ,
  CONSTRAINT `fk_jornada_competicion1`
    FOREIGN KEY (`competicion_id`)
    REFERENCES `competicion` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `juegaequipo`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `juegaequipo` (
  `competicion_id` INT NOT NULL,
  `partida_id` INT NOT NULL,
  `equipoinscrito_id` INT NOT NULL,
  `presentado` TINYINT NULL DEFAULT 0,
  `puntuacion` DOUBLE NULL DEFAULT 0,
  `posicion`  INT NULL DEFAULT 1,
  `aceptafecha` INT NULL DEFAULT 0,
  `conforme` INT NULL DEFAULT 0,
  PRIMARY KEY (`competicion_id`, `partida_id`, `equipoinscrito_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `juega`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `juega` (
  `competicion_id` INT NOT NULL,
  `partida_id` INT NOT NULL,
  `jugadorinscrito_id` INT NOT NULL,
  `puntuacion` DOUBLE NULL DEFAULT 0,
  `presentado` TINYINT NULL DEFAULT 0,
  `posicion`  INT NULL DEFAULT 0,
  `aceptafecha` INT NULL DEFAULT 0,
  `conforme` INT NULL DEFAULT 0,
  PRIMARY KEY (`competicion_id`, `partida_id`, `jugadorinscrito_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comentaliga`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `comentaliga` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competicion_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  `info` TEXT NULL,
  `fecha` DATETIME NULL,
  PRIMARY KEY (`id`, `competicion_id`, `users_id`),
  INDEX `fk_comentaliga_competicion1_idx` (`competicion_id` ASC) ,
  CONSTRAINT `fk_comentaliga_competicion1`
    FOREIGN KEY (`competicion_id`)
    REFERENCES `competicion` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `media`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `media` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `filename` VARCHAR(200) NULL,
  `tipo` VARCHAR(45) NULL,
  `info` TEXT NULL,
  `fecha` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
