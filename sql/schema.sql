SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `schulAdministration` ;
CREATE SCHEMA IF NOT EXISTS `schulAdministration` DEFAULT CHARACTER SET utf8 ;
USE `schulAdministration` ;

-- -----------------------------------------------------
-- Table `schulAdministration`.`person`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `schulAdministration`.`person` ;

CREATE  TABLE IF NOT EXISTS `schulAdministration`.`person` (
  `pid` INT NOT NULL ,
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
-- Table `schulAdministration`.`schueler`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `schulAdministration`.`schueler` ;

CREATE  TABLE IF NOT EXISTS `schulAdministration`.`schueler` (
  `sid` INT NOT NULL ,
  INDEX `fk_schueler_person` (`sid` ASC) ,
  PRIMARY KEY (`sid`) ,
  CONSTRAINT `fk_schueler_person`
    FOREIGN KEY (`sid` )
    REFERENCES `schulAdministration`.`person` (`pid` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schulAdministration`.`lehrperson`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `schulAdministration`.`lehrperson` ;

CREATE  TABLE IF NOT EXISTS `schulAdministration`.`lehrperson` (
  `lid` INT NOT NULL ,
  INDEX `fk_lehrperson_person1` (`lid` ASC) ,
  PRIMARY KEY (`lid`) ,
  CONSTRAINT `fk_lehrperson_person1`
    FOREIGN KEY (`lid` )
    REFERENCES `schulAdministration`.`person` (`pid` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schulAdministration`.`angestellte`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `schulAdministration`.`angestellte` ;

CREATE  TABLE IF NOT EXISTS `schulAdministration`.`angestellte` (
  `aid` INT NOT NULL ,
  INDEX `fk_angestellte_person1` (`aid` ASC) ,
  PRIMARY KEY (`aid`) ,
  CONSTRAINT `fk_angestellte_person1`
    FOREIGN KEY (`aid` )
    REFERENCES `schulAdministration`.`person` (`pid` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schulAdministration`.`fach`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `schulAdministration`.`fach` ;

CREATE  TABLE IF NOT EXISTS `schulAdministration`.`fach` (
  `fid` INT NOT NULL AUTO_INCREMENT ,
  `kuerzel` VARCHAR(45) NULL ,
  `bezeichnung` VARCHAR(45) NULL ,
  PRIMARY KEY (`fid`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schulAdministration`.`klasse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `schulAdministration`.`klasse` ;

CREATE  TABLE IF NOT EXISTS `schulAdministration`.`klasse` (
  `kid` INT NOT NULL AUTO_INCREMENT ,
  `kuerzel` VARCHAR(10) NULL ,
  `bezeichnung` VARCHAR(45) NULL ,
  PRIMARY KEY (`kid`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schulAdministration`.`schueler_has_klasse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `schulAdministration`.`schueler_has_klasse` ;

CREATE  TABLE IF NOT EXISTS `schulAdministration`.`schueler_has_klasse` (
  `sid` INT NOT NULL ,
  `kid` INT NOT NULL ,
  `isZweitausbildung` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`sid`, `kid`) ,
  INDEX `fk_schueler_has_klasse_klasse1` (`kid` ASC) ,
  INDEX `fk_schueler_has_klasse_schueler1` (`sid` ASC) ,
  CONSTRAINT `fk_schueler_has_klasse_schueler1`
    FOREIGN KEY (`sid` )
    REFERENCES `schulAdministration`.`schueler` (`sid` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_schueler_has_klasse_klasse1`
    FOREIGN KEY (`kid` )
    REFERENCES `schulAdministration`.`klasse` (`kid` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schulAdministration`.`lehrperson_klasse_fach`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `schulAdministration`.`lehrperson_klasse_fach` ;

CREATE  TABLE IF NOT EXISTS `schulAdministration`.`lehrperson_klasse_fach` (
  `lid` INT NOT NULL ,
  `kid` INT NOT NULL ,
  `fid` INT NOT NULL ,
  PRIMARY KEY (`lid`, `kid`, `fid`) ,
  INDEX `fk_lehrperson_has_klasse_klasse1` (`kid` ASC) ,
  INDEX `fk_lehrperson_has_klasse_lehrperson1` (`lid` ASC) ,
  INDEX `fk_lehrperson_has_klasse_fach1` (`fid` ASC) ,
  CONSTRAINT `fk_lehrperson_has_klasse_lehrperson1`
    FOREIGN KEY (`lid` )
    REFERENCES `schulAdministration`.`lehrperson` (`lid` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lehrperson_has_klasse_klasse1`
    FOREIGN KEY (`kid` )
    REFERENCES `schulAdministration`.`klasse` (`kid` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lehrperson_has_klasse_fach1`
    FOREIGN KEY (`fid` )
    REFERENCES `schulAdministration`.`fach` (`fid` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
