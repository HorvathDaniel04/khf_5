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
-- Table `mydb`.`Hir`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Hir` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Hir` (
  `idHir` INT NOT NULL AUTO_INCREMENT,
  `CIm` VARCHAR(80) NOT NULL,
  `Datum` DATE NOT NULL,
  `Szoveg` LONGTEXT NOT NULL,
  PRIMARY KEY (`idHir`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Hozzaszolasok`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Hozzaszolasok` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Hozzaszolasok` (
  `idHozzaszolasok` INT NOT NULL AUTO_INCREMENT,
  `Szerzo` VARCHAR(45) NOT NULL,
  `Szoveg` MEDIUMTEXT NOT NULL,
  `Hir_idHir` INT NOT NULL,
  PRIMARY KEY (`idHozzaszolasok`, `Hir_idHir`),
  INDEX `fk_Hozzaszolasok_Hir_idx` (`Hir_idHir` ASC),
  CONSTRAINT `fk_Hozzaszolasok_Hir`
    FOREIGN KEY (`Hir_idHir`)
    REFERENCES `mydb`.`Hir` (`idHir`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`Hir`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Hir` (`idHir`, `CIm`, `Datum`, `Szoveg`) VALUES (1, 'Új AI-eszköz Gmailhez', '2024-11-02', 'Google bejelentette legújabb AI-alapú funkcióját, amely automatikusan szűri és rendszerezi a beérkező e-maileket, hogy növelje a munka hatékonyságát');
INSERT INTO `mydb`.`Hir` (`idHir`, `CIm`, `Datum`, `Szoveg`) VALUES (2, 'Rekordot döntött az új AMD processzor', '2024-10-20', 'Google bejelentette legújabb AI-alapú funkcióját, amely automatikusan szűri és rendszerezi a beérkező e-maileket, hogy növelje a munka hatékonyságát');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`Hozzaszolasok`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Hozzaszolasok` (`idHozzaszolasok`, `Szerzo`, `Szoveg`, `Hir_idHir`) VALUES (1, 'Péter', 'Ez nagyon jól hangzik, végre kevesebb időt kell tölteni az e-mailek rendszerezésével!', 1);
INSERT INTO `mydb`.`Hozzaszolasok` (`idHozzaszolasok`, `Szerzo`, `Szoveg`, `Hir_idHir`) VALUES (2, 'Anna', 'Remélem, testreszabható lesz, mert nem minden szűrő működik jól mindenkinek.', 1);
INSERT INTO `mydb`.`Hozzaszolasok` (`idHozzaszolasok`, `Szerzo`, `Szoveg`, `Hir_idHir`) VALUES (3, 'Sanyi', 'Nagyon jo szoveg', 2);

COMMIT;

