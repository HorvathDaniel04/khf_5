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
-- Table `mydb`.`Hirek`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Hirek` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Hirek` (
  `idHirek` INT NOT NULL AUTO_INCREMENT,
  `Cim` VARCHAR(45) NOT NULL,
  `Datum` DATE NOT NULL,
  `Szoveg` LONGTEXT NOT NULL,
  PRIMARY KEY (`idHirek`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Hozzaszolas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Hozzaszolas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Hozzaszolas` (
  `idHozzaszolas` INT NOT NULL AUTO_INCREMENT,
  `Szerzo` VARCHAR(45) NOT NULL,
  `Szoveg` MEDIUMTEXT NOT NULL,
  `Hirek_idHirek` INT NOT NULL,
  PRIMARY KEY (`idHozzaszolas`, `Hirek_idHirek`),
  INDEX `fk_Hozzaszolas_Hirek_idx` (`Hirek_idHirek` ASC),
  CONSTRAINT `fk_Hozzaszolas_Hirek`
    FOREIGN KEY (`Hirek_idHirek`)
    REFERENCES `mydb`.`Hirek` (`idHirek`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`Hirek`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Hirek` (`idHirek`, `Cim`, `Datum`, `Szoveg`) VALUES (1, 'Elso cikknek a szovege', '2024-11-12', 'Jo hosszu szoveget ideirni hogy szep legyen majd az oldnak a strukturaja senkit nem erdekel amgy mi van itt.');
INSERT INTO `mydb`.`Hirek` (`idHirek`, `Cim`, `Datum`, `Szoveg`) VALUES (2, 'Masodik cikk ', '2024-10-23', 'Jo hosszu szoveget ideirni hogy szep legyen majd az oldnak a strukturaja senkit nem erdekel amgy mi van itt.');
INSERT INTO `mydb`.`Hirek` (`idHirek`, `Cim`, `Datum`, `Szoveg`) VALUES (3, 'Harmadik teszt', '2025-12-01', 'Csak tesztkent hasznalom');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`Hozzaszolas`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Hozzaszolas` (`idHozzaszolas`, `Szerzo`, `Szoveg`, `Hirek_idHirek`) VALUES (1, 'Peti', 'Komment1', 1);
INSERT INTO `mydb`.`Hozzaszolas` (`idHozzaszolas`, `Szerzo`, `Szoveg`, `Hirek_idHirek`) VALUES (2, 'Anna', 'Komment2', 1);
INSERT INTO `mydb`.`Hozzaszolas` (`idHozzaszolas`, `Szerzo`, `Szoveg`, `Hirek_idHirek`) VALUES (3, 'Sanyi', 'Teszt', 2);

COMMIT;

