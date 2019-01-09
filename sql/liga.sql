-- Sistema para almacenar las competiciones 

-- -----------------------------------------------------
-- Table `competicion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `competicion` (
  `id` INT NOT NULL,
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
  `costeincripcionequipo` DOUBLE NULL,
  `ganar` INT NULL DEFAULT 3,
  `empatar` INT NULL DEFAULT 1,
  `perder` INT NULL DEFAULT 0,
  `fecha` DATETIME NULL,
  PRIMARY KEY (`id`))
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
-- Table `partida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `partida` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competicion_id` INT NOT NULL,
  `resultado` VARCHAR(45) NULL,
  `horainicio` DATETIME NULL,
  `jornada_id` INT NOT NULL,
  `jornada_competicion_id` INT NOT NULL,
  `comentario` VARCHAR(200) NULL,
  `verificado` TINYINT NULL DEFAULT 0,
  `estado` ENUM('pendiente', 'cerrada', 'jugando', 'disputa') NULL,
  PRIMARY KEY (`id`, `competicion_id`),
  INDEX `fk_partida_competicion_idx` (`competicion_id` ASC) ,
  INDEX `fk_partida_jornada1_idx` (`jornada_id` ASC, `jornada_competicion_id` ASC) ,
  CONSTRAINT `fk_partida_competicion`
    FOREIGN KEY (`competicion_id`)
    REFERENCES `competicion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_partida_jornada1`
    FOREIGN KEY (`jornada_id` , `jornada_competicion_id`)
    REFERENCES `jornada` (`id` , `competicion_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipoinscrito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipoinscrito` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competicion_id` INT NOT NULL,
  `capitan` INT NULL,
  `nombre` VARCHAR(200) NULL,
  `logotipo` VARCHAR(200) NULL,
  `info` VARCHAR(200) NULL,
  `fecha` DATETIME NULL,
  PRIMARY KEY (`id`, `competicion_id`),
  INDEX `fk_equipo_competicion1_idx` (`competicion_id` ASC) ,
  INDEX `fk_equipo_capitan_idx` (`capitan` ASC) ,
  CONSTRAINT `fk_equipo_competicion1`
    FOREIGN KEY (`competicion_id`)
    REFERENCES `competicion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipo_capitan`
    FOREIGN KEY (`capitan`)
    REFERENCES `jugadorinscrito` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jugadorinscrito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jugadorinscrito` (
  `competicion_id` INT NOT NULL,
  `id` INT NOT NULL,
  `equipo_id` INT NULL,
  `equipo_competicion_id` INT NULL,
  `nombre` VARCHAR(200) NULL,
  `logotipo` VARCHAR(200) NULL,
  `info` VARCHAR(200) NULL,
  `usuario_id` INT NOT NULL,
  `fecha` DATETIME NULL,
  PRIMARY KEY (`competicion_id`, `id`),
  INDEX `fk_competicion_has_usuario_competicion1_idx` (`competicion_id` ASC) ,
  INDEX `fk_inscrito_equipo1_idx` (`equipo_id` ASC, `equipo_competicion_id` ASC) ,
  INDEX `fk_jugadorinscrito_usuario1_idx` (`usuario_id` ASC) ,
  CONSTRAINT `fk_competicion_has_usuario_competicion1`
    FOREIGN KEY (`competicion_id`)
    REFERENCES `competicion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inscrito_equipo1`
    FOREIGN KEY (`equipo_id` , `equipo_competicion_id`)
    REFERENCES `equipoinscrito` (`id` , `competicion_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_jugadorinscrito_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `subecontenido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `subecontenido` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `partida_competicion_id` INT NOT NULL,
  `partida_id` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  `filename` VARCHAR(200) NULL,
  `tipo` VARCHAR(45) NULL,
  `comentario` VARCHAR(200) NULL,
  `fecha` DATETIME NULL,
  PRIMARY KEY (`id`, `partida_competicion_id`, `partida_id`, `usuario_id`),
  INDEX `fk_contenidomultimedia_partida1_idx` (`partida_id` ASC, `partida_competicion_id` ASC) ,
  INDEX `fk_multimedia_usuario1_idx` (`usuario_id` ASC) ,
  CONSTRAINT `fk_contenidomultimedia_partida1`
    FOREIGN KEY (`partida_id` , `partida_competicion_id`)
    REFERENCES `partida` (`id` , `competicion_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_multimedia_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comenta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `comenta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `partida_id` INT NOT NULL,
  `partida_competicion_id` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  `texto` TEXT NULL,
  `fecha` DATETIME NULL,
  PRIMARY KEY (`id`, `partida_id`, `partida_competicion_id`, `usuario_id`),
  INDEX `fk_partida_has_usuario_usuario1_idx` (`usuario_id` ASC) ,
  INDEX `fk_partida_has_usuario_partida1_idx` (`partida_id` ASC, `partida_competicion_id` ASC) ,
  CONSTRAINT `fk_partida_has_usuario_partida1`
    FOREIGN KEY (`partida_id` , `partida_competicion_id`)
    REFERENCES `partida` (`id` , `competicion_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_partida_has_usuario_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `periodosdescanso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `periodosdescanso` (
  `id` INT NOT NULL,
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
-- Table `participan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `participan` (
  `partida_id` INT NOT NULL,
  `partida_competicion_id` INT NOT NULL,
  `equipoinscrito_id` INT NOT NULL,
  `equipoinscrito_competicion_id` INT NOT NULL,
  `presentado` TINYINT NULL,
  `puntuacion` DOUBLE NULL,
  `conforme` ENUM('conforme', 'noconforme', 'sincontestar') NULL DEFAULT 'sincontestar',
  PRIMARY KEY (`partida_id`, `partida_competicion_id`, `equipoinscrito_id`, `equipoinscrito_competicion_id`),
  INDEX `fk_partida_has_equipoinscrito_equipoinscrito1_idx` (`equipoinscrito_id` ASC, `equipoinscrito_competicion_id` ASC) ,
  INDEX `fk_partida_has_equipoinscrito_partida1_idx` (`partida_id` ASC, `partida_competicion_id` ASC) ,
  CONSTRAINT `fk_partida_has_equipoinscrito_partida1`
    FOREIGN KEY (`partida_id` , `partida_competicion_id`)
    REFERENCES `partida` (`id` , `competicion_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_partida_has_equipoinscrito_equipoinscrito1`
    FOREIGN KEY (`equipoinscrito_id` , `equipoinscrito_competicion_id`)
    REFERENCES `equipoinscrito` (`id` , `competicion_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `juega`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `juega` (
  `jugadorinscrito_competicion_id` INT NOT NULL,
  `jugadorinscrito_id` INT NOT NULL,
  `partida_id` INT NOT NULL,
  `partida_competicion_id` INT NOT NULL,
  `puntuacion` DOUBLE NULL,
  `presentado` TINYINT NULL,
  `conforme` ENUM('conforme', 'noconforme', 'sincontestar') NULL DEFAULT 'sincontestar',
  PRIMARY KEY (`jugadorinscrito_competicion_id`, `partida_id`, `partida_competicion_id`, `jugadorinscrito_id`),
  INDEX `fk_jugadorinscrito_has_partida_partida1_idx` (`partida_id` ASC, `partida_competicion_id` ASC) ,
  INDEX `fk_jugadorinscrito_has_partida_jugadorinscrito1_idx` (`jugadorinscrito_competicion_id` ASC) ,
  INDEX `fk_juega_jugadadorinscrito_idx` (`jugadorinscrito_id` ASC) ,
  CONSTRAINT `fk_jugadorinscrito_has_partida_jugadorinscrito1`
    FOREIGN KEY (`jugadorinscrito_competicion_id`)
    REFERENCES `jugadorinscrito` (`competicion_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_jugadorinscrito_has_partida_partida1`
    FOREIGN KEY (`partida_id` , `partida_competicion_id`)
    REFERENCES `partida` (`id` , `competicion_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_juega_jugadadorinscrito`
    FOREIGN KEY (`jugadorinscrito_id`)
    REFERENCES `jugadorinscrito` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

