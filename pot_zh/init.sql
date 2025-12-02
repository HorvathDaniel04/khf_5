-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Varos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Varos` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Varos` (
  `idVaros` INT NOT NULL AUTO_INCREMENT,
  `Nev` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idVaros`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Szallas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Szallas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Szallas` (
  `idSzallas` INT NOT NULL,
  `Nev` VARCHAR(45) NOT NULL,
  `Cim` VARCHAR(45) NOT NULL,
  `Ertekeles` INT NOT NULL,
  `Varos_idVaros` INT NOT NULL,
  PRIMARY KEY (`idSzallas`, `Varos_idVaros`),
  INDEX `fk_Szallas_Varos_idx` (`Varos_idVaros` ASC),
  CONSTRAINT `fk_Szallas_Varos`
    FOREIGN KEY (`Varos_idVaros`)
    REFERENCES `mydb`.`Varos` (`idVaros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`Varos`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Varos` (`idVaros`, `Nev`) VALUES (1, 'Budapest');
INSERT INTO `mydb`.`Varos` (`idVaros`, `Nev`) VALUES (2, 'Berlin');
INSERT INTO `mydb`.`Varos` (`idVaros`, `Nev`) VALUES (3, 'Tata');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`Szallas`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Szallas` (`idSzallas`, `Nev`, `Cim`, `Ertekeles`, `Varos_idVaros`) VALUES (1, 'Gottwald', 'Valamilyen utca 3', 4, 3);
INSERT INTO `mydb`.`Szallas` (`idSzallas`, `Nev`, `Cim`, `Ertekeles`, `Varos_idVaros`) VALUES (2, 'Kiss', 'Ezis ut 4', 7, 3);
INSERT INTO `mydb`.`Szallas` (`idSzallas`, `Nev`, `Cim`, `Ertekeles`, `Varos_idVaros`) VALUES (3, 'Casa Blanca', 'Azis ut 12', 3, 3);
INSERT INTO `mydb`.`Szallas` (`idSzallas`, `Nev`, `Cim`, `Ertekeles`, `Varos_idVaros`) VALUES (4, 'Meriot', 'Citystreet  utca 32', 4, 1);
INSERT INTO `mydb`.`Szallas` (`idSzallas`, `Nev`, `Cim`, `Ertekeles`, `Varos_idVaros`) VALUES (5, 'Fancy', 'Valakinek ut 12', 6, 1);

COMMIT;

