
-- -----------------------------------------------------
-- Table `competicion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `competicion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) NULL,
  `maxequipos` INT NULL DEFAULT 0,
  `minequipos` INT NULL DEFAULT 0,
  `maxjugadoresequipo` INT NULL DEFAULT 0,
  `minjugadoresequipo` INT NULL DEFAULT 0,
  `minjugadores` INT NULL DEFAULT 0,
  `maxjugadores` INT NULL DEFAULT 0,
  `inicioinscripcion` DATETIME NULL,
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
  `porequipos` TINYINT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `partida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `partida` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competicion_id` INT NOT NULL,
  `jornada_id` INT NULL,
  `resultado` VARCHAR(45) NULL,
  `horainicio` DATETIME NULL,
  `comentario` VARCHAR(200) NULL,
  `verificado` TINYINT NULL DEFAULT 0,
  `estado` ENUM('pendiente', 'cerrada', 'jugando', 'disputa') NULL,
  PRIMARY KEY (`id`, `competicion_id`),
  INDEX `fk_partida_competicion_idx` (`competicion_id` ASC) ,
  CONSTRAINT `fk_partida_competicion`
    FOREIGN KEY (`competicion_id`)
    REFERENCES `competicion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jugadorinscrito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jugadorinscrito` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competicion_id` INT NOT NULL,
  `nombre` VARCHAR(200) NULL,
  `equipoinscrito_id` INT NULL,
  `users_id` INT NULL,
  `logotipo` VARCHAR(200) NULL,
  `info` VARCHAR(200) NULL,
  `fecha` DATETIME NULL,
  PRIMARY KEY (`id`, `competicion_id`),
  INDEX `fk_competicion_has_usuario_competicion1_idx` (`competicion_id` ASC) ,
  CONSTRAINT `fk_competicion_has_usuario_competicion1`
    FOREIGN KEY (`competicion_id`)
    REFERENCES `competicion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipoinscrito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipoinscrito` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competicion_id` INT NOT NULL,
  `nombre` VARCHAR(200) NULL,
  `logotipo` VARCHAR(200) NULL,
  `info` VARCHAR(200) NULL,
  `fecha` DATETIME NULL,
  `capitan` INT NULL,
  PRIMARY KEY (`id`, `competicion_id`),
  INDEX `fk_equipo_competicion1_idx` (`competicion_id` ASC) ,
  CONSTRAINT `fk_equipo_competicion1`
    FOREIGN KEY (`competicion_id`)
    REFERENCES `competicion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `subecontenido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `subecontenido` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competicion_id` INT NOT NULL,
  `partida_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  `filename` VARCHAR(200) NULL,
  `tipo` VARCHAR(45) NULL,
  `comentario` VARCHAR(200) NULL,
  `fecha` DATETIME NULL,
  PRIMARY KEY (`id`, `competicion_id`, `partida_id`, `users_id`),
  INDEX `fk_contenidomultimedia_partida1_idx` (`partida_id` ASC, `competicion_id` ASC) ,
  CONSTRAINT `fk_contenidomultimedia_partida1`
    FOREIGN KEY (`partida_id` , `competicion_id`)
    REFERENCES `partida` (`id` , `competicion_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comenta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `comenta` (
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
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
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
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jornada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jornada` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competicion_id` INT NOT NULL,
  `fechainicio` DATETIME NULL,
  `fechafin` DATETIME NULL,
  `comentario` VARCHAR(200) NULL,
  PRIMARY KEY (`id`, `competicion_id`),
  INDEX `fk_jornada_competicion1_idx` (`competicion_id` ASC) ,
  CONSTRAINT `fk_jornada_competicion1`
    FOREIGN KEY (`competicion_id`)
    REFERENCES `competicion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `participan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `participan` (
  `competicion_id` INT NOT NULL,
  `partida_id` INT NOT NULL,
  `equipoinscrito_id` INT NOT NULL,
  `presentado` TINYINT NULL,
  `puntuacion` DOUBLE NULL,
  `conforme` ENUM('conforme', 'noconforme', 'sincontestar') NULL DEFAULT 'sincontestar',
  PRIMARY KEY (`competicion_id`, `partida_id`, `equipoinscrito_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `juega`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `juega` (
  `competicion_id` INT NOT NULL,
  `partida_id` INT NOT NULL,
  `jugadorinscrito_id` INT NOT NULL,
  `puntuacion` DOUBLE NULL,
  `presentado` TINYINT NULL,
  `conforme` ENUM('conforme', 'noconforme', 'sincontestar') NULL DEFAULT 'sincontestar',
  PRIMARY KEY (`competicion_id`, `partida_id`, `jugadorinscrito_id`))
ENGINE = InnoDB;

