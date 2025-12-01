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
-- Table `mydb`.`Varosok`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Varosok` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Varosok` (
  `idVarosok` INT NOT NULL AUTO_INCREMENT,
  `Nev` VARCHAR(45) NOT NULL,
  `Lakossag` DECIMAL NOT NULL,
  PRIMARY KEY (`idVarosok`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Naplobejegyzesek`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Naplobejegyzesek` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Naplobejegyzesek` (
  `idNaplobejegyzesek` INT NOT NULL AUTO_INCREMENT,
  `Datum` DATE NOT NULL,
  `Homerseklet` VARCHAR(45) NOT NULL,
  `Varosok_idVarosok` INT NOT NULL,
  PRIMARY KEY (`idNaplobejegyzesek`, `Varosok_idVarosok`),
  INDEX `fk_Naplobejegyzesek_Varosok_idx` (`Varosok_idVarosok` ASC),
  CONSTRAINT `fk_Naplobejegyzesek_Varosok`
    FOREIGN KEY (`Varosok_idVarosok`)
    REFERENCES `mydb`.`Varosok` (`idVarosok`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`Varosok`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Varosok` (`idVarosok`, `Nev`, `Lakossag`) VALUES (1, 'London', 8.9);
INSERT INTO `mydb`.`Varosok` (`idVarosok`, `Nev`, `Lakossag`) VALUES (2, 'Parizs', 2.1);
INSERT INTO `mydb`.`Varosok` (`idVarosok`, `Nev`, `Lakossag`) VALUES (3, 'Budapest', 1.7);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`Naplobejegyzesek`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Naplobejegyzesek` (`idNaplobejegyzesek`, `Datum`, `Homerseklet`, `Varosok_idVarosok`) VALUES (1, '2024-11-28', '10', 1);
INSERT INTO `mydb`.`Naplobejegyzesek` (`idNaplobejegyzesek`, `Datum`, `Homerseklet`, `Varosok_idVarosok`) VALUES (2, '2024-12-12', '7', 1);
INSERT INTO `mydb`.`Naplobejegyzesek` (`idNaplobejegyzesek`, `Datum`, `Homerseklet`, `Varosok_idVarosok`) VALUES (3, '2023-12-01', '4', 3);
INSERT INTO `mydb`.`Naplobejegyzesek` (`idNaplobejegyzesek`, `Datum`, `Homerseklet`, `Varosok_idVarosok`) VALUES (4, '2024-04-23', '10', 3);
INSERT INTO `mydb`.`Naplobejegyzesek` (`idNaplobejegyzesek`, `Datum`, `Homerseklet`, `Varosok_idVarosok`) VALUES (5, '2025-01-30', '2', 3);

COMMIT;

