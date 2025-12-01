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
-- Table `mydb`.`Filmek`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Filmek` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Filmek` (
  `idFilmek` INT NOT NULL AUTO_INCREMENT,
  `Cim` VARCHAR(45) NOT NULL,
  `Ev` INT NOT NULL,
  PRIMARY KEY (`idFilmek`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Ertekeles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Ertekeles` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Ertekeles` (
  `idErtekeles` INT NOT NULL AUTO_INCREMENT,
  `Szerzo` VARCHAR(45) NOT NULL,
  `Pontszam` INT NOT NULL,
  `Filmek_idFilmek` INT NOT NULL,
  PRIMARY KEY (`idErtekeles`, `Filmek_idFilmek`),
  INDEX `fk_Ertekeles_Filmek_idx` (`Filmek_idFilmek` ASC),
  CONSTRAINT `fk_Ertekeles_Filmek`
    FOREIGN KEY (`Filmek_idFilmek`)
    REFERENCES `mydb`.`Filmek` (`idFilmek`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`Filmek`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Filmek` (`idFilmek`, `Cim`, `Ev`) VALUES (1, 'Shrek', 2001);
INSERT INTO `mydb`.`Filmek` (`idFilmek`, `Cim`, `Ev`) VALUES (2, 'Thor', 2011);
INSERT INTO `mydb`.`Filmek` (`idFilmek`, `Cim`, `Ev`) VALUES (3, 'Dune', 2021);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`Ertekeles`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Ertekeles` (`idErtekeles`, `Szerzo`, `Pontszam`, `Filmek_idFilmek`) VALUES (1, 'Eniko', 4, 1);
INSERT INTO `mydb`.`Ertekeles` (`idErtekeles`, `Szerzo`, `Pontszam`, `Filmek_idFilmek`) VALUES (2, 'Tamas', 3, 1);
INSERT INTO `mydb`.`Ertekeles` (`idErtekeles`, `Szerzo`, `Pontszam`, `Filmek_idFilmek`) VALUES (3, 'Peter', 5, 2);
INSERT INTO `mydb`.`Ertekeles` (`idErtekeles`, `Szerzo`, `Pontszam`, `Filmek_idFilmek`) VALUES (4, 'Anna', 4, 2);
INSERT INTO `mydb`.`Ertekeles` (`idErtekeles`, `Szerzo`, `Pontszam`, `Filmek_idFilmek`) VALUES (5, 'Zoltan', 3, 2);

COMMIT;

