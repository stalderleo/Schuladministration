SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `schulAdministration` ;
CREATE SCHEMA IF NOT EXISTS `schulAdministration` DEFAULT CHARACTER SET utf8 ;
USE `schulAdministration` ;

-- -----------------------------------------------------
-- Table `person`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `person` ;

CREATE  TABLE IF NOT EXISTS `person` (
  `pid` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL ,
  `password` VARCHAR(100) NOT NULL ,
  `name` VARCHAR(50) NOT NULL ,
  `vorname` VARCHAR(50) NOT NULL ,
  `geburtsdatum` DATE NULL ,
  `geschlecht` VARCHAR(1) NULL ,
  `kuerzel` VARCHAR(10) NULL ,
  `mail` VARCHAR(100) NULL ,
  `status` INT NULL ,
  PRIMARY KEY (`pid`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schueler`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `schueler` ;

CREATE  TABLE IF NOT EXISTS `schueler` (
  `sid` INT NOT NULL ,
  INDEX `fk_schueler_person` (`sid` ASC) ,
  PRIMARY KEY (`sid`) ,
  CONSTRAINT `fk_schueler_person`
    FOREIGN KEY (`sid` )
    REFERENCES `person` (`pid` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lehrperson`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lehrperson` ;

CREATE  TABLE IF NOT EXISTS `lehrperson` (
  `lid` INT NOT NULL ,
  INDEX `fk_lehrperson_person1` (`lid` ASC) ,
  PRIMARY KEY (`lid`) ,
  CONSTRAINT `fk_lehrperson_person1`
    FOREIGN KEY (`lid` )
    REFERENCES `person` (`pid` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `angestellte`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `angestellte` ;

CREATE  TABLE IF NOT EXISTS `angestellte` (
  `aid` INT NOT NULL ,
  INDEX `fk_angestellte_person1` (`aid` ASC) ,
  PRIMARY KEY (`aid`) ,
  CONSTRAINT `fk_angestellte_person1`
    FOREIGN KEY (`aid` )
    REFERENCES `person` (`pid` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fach`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fach` ;

CREATE  TABLE IF NOT EXISTS `fach` (
  `fid` INT NOT NULL AUTO_INCREMENT ,
  `kuerzel` VARCHAR(45) NULL ,
  `bezeichnung` VARCHAR(45) NULL ,
  PRIMARY KEY (`fid`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `klasse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `klasse` ;

CREATE  TABLE IF NOT EXISTS `klasse` (
  `kid` INT NOT NULL AUTO_INCREMENT ,
  `kuerzel` VARCHAR(10) NULL ,
  `bezeichnung` VARCHAR(45) NULL ,
  PRIMARY KEY (`kid`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schueler_has_klasse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `schueler_has_klasse` ;

CREATE  TABLE IF NOT EXISTS `schueler_has_klasse` (
  `sid` INT NOT NULL ,
  `kid` INT NOT NULL ,
  `isZweitausbildung` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`sid`, `kid`) ,
  INDEX `fk_schueler_has_klasse_klasse1` (`kid` ASC) ,
  INDEX `fk_schueler_has_klasse_schueler1` (`sid` ASC) ,
  CONSTRAINT `fk_schueler_has_klasse_schueler1`
    FOREIGN KEY (`sid` )
    REFERENCES `schueler` (`sid` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_schueler_has_klasse_klasse1`
    FOREIGN KEY (`kid` )
    REFERENCES `klasse` (`kid` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lehrperson_klasse_fach`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lehrperson_klasse_fach` ;

CREATE  TABLE IF NOT EXISTS `lehrperson_klasse_fach` (
  `lid` INT NOT NULL ,
  `kid` INT NOT NULL ,
  `fid` INT NOT NULL ,
  PRIMARY KEY (`lid`, `kid`, `fid`) ,
  INDEX `fk_lehrperson_has_klasse_klasse1` (`kid` ASC) ,
  INDEX `fk_lehrperson_has_klasse_lehrperson1` (`lid` ASC) ,
  INDEX `fk_lehrperson_has_klasse_fach1` (`fid` ASC) ,
  CONSTRAINT `fk_lehrperson_has_klasse_lehrperson1`
    FOREIGN KEY (`lid` )
    REFERENCES `lehrperson` (`lid` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_lehrperson_has_klasse_klasse1`
    FOREIGN KEY (`kid` )
    REFERENCES `klasse` (`kid` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_lehrperson_has_klasse_fach1`
    FOREIGN KEY (`fid` )
    REFERENCES `fach` (`fid` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
