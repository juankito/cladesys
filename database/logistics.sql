-- MySQL Script generated by MySQL Workbench
-- 05/31/17 19:36:43
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema logistics
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `logistics` ;

-- -----------------------------------------------------
-- Schema logistics
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `logistics` DEFAULT CHARACTER SET utf8 ;
USE `logistics` ;

-- -----------------------------------------------------
-- Table `logistics`.`brand`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`brand` ;

CREATE TABLE IF NOT EXISTS `logistics`.`brand` (
  `brandid` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `flagstate` VARCHAR(45) NULL DEFAULT '1',
  `updated_at` TIMESTAMP NULL,
  `added_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`brandid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logistics`.`category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`category` ;

CREATE TABLE IF NOT EXISTS `logistics`.`category` (
  `categoryid` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `flagstate` TINYINT(1) NULL DEFAULT 1,
  `added_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`categoryid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logistics`.`product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`product` ;

CREATE TABLE IF NOT EXISTS `logistics`.`product` (
  `productid` INT NOT NULL AUTO_INCREMENT,
  `categoryid` INT NOT NULL,
  `brandid` INT NOT NULL,
  `detail` TEXT NOT NULL,
  `status` ENUM('bad', 'average', 'good') NOT NULL,
  `flagstate` TINYINT(1) NULL DEFAULT 1,
  `updated_at` TIMESTAMP NULL,
  `added_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productid`),
  INDEX `brandid_idx` (`brandid` ASC),
  INDEX `categoryid1_idx` (`categoryid` ASC),
  CONSTRAINT `brandid`
    FOREIGN KEY (`brandid`)
    REFERENCES `logistics`.`brand` (`brandid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `categoryid`
    FOREIGN KEY (`categoryid`)
    REFERENCES `logistics`.`category` (`categoryid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logistics`.`packs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`packs` ;

CREATE TABLE IF NOT EXISTS `logistics`.`packs` (
  `packsid` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `flagstate` TINYINT(1) NULL DEFAULT 1,
  `updated_at` TIMESTAMP NULL,
  `added_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`packsid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logistics`.`packing`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`packing` ;

CREATE TABLE IF NOT EXISTS `logistics`.`packing` (
  `packingid` INT NOT NULL AUTO_INCREMENT,
  `packsid` INT NOT NULL,
  `factor` FLOAT NOT NULL,
  `packing_parentid` INT NULL,
  `added_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`packingid`),
  INDEX `packing_has_packing` (`packing_parentid` ASC),
  INDEX `packsid1_idx` (`packsid` ASC),
  CONSTRAINT `packing_id`
    FOREIGN KEY (`packing_parentid`)
    REFERENCES `logistics`.`packing` (`packingid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `packsid1`
    FOREIGN KEY (`packsid`)
    REFERENCES `logistics`.`packs` (`packsid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logistics`.`identity`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`identity` ;

CREATE TABLE IF NOT EXISTS `logistics`.`identity` (
  `identityid` INT NOT NULL AUTO_INCREMENT,
  `abreviation` VARCHAR(10) NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  `flagstate` TINYINT(1) NULL DEFAULT 1,
  `added_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`identityid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logistics`.`supplier`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`supplier` ;

CREATE TABLE IF NOT EXISTS `logistics`.`supplier` (
  `supplierid` INT NOT NULL AUTO_INCREMENT,
  `identityid` INT NOT NULL,
  `idn_number` VARCHAR(15) NOT NULL,
  `companyname` VARCHAR(40) NOT NULL,
  `contactname` VARCHAR(30) NOT NULL,
  `address` VARCHAR(60) NULL,
  `phone` VARCHAR(15) NULL,
  `postalcode` VARCHAR(10) NULL,
  `region` VARCHAR(15) NULL,
  `country` VARCHAR(15) NULL,
  `homepage` TEXT NULL,
  `email` VARCHAR(45) NULL,
  `flagstate` TINYINT(1) NULL DEFAULT 1,
  `added_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`supplierid`),
  INDEX `identityid1_idx` (`identityid` ASC),
  CONSTRAINT `identityid1`
    FOREIGN KEY (`identityid`)
    REFERENCES `logistics`.`identity` (`identityid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logistics`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`user` ;

CREATE TABLE IF NOT EXISTS `logistics`.`user` (
  `userid` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(16) NOT NULL,
  `password` CHAR(32) NOT NULL,
  `email` VARCHAR(45) NULL,
  `type` ENUM('A', 'B', 'C', 'D') NULL,
  `flagstate` TINYINT(1) NULL DEFAULT 1,
  `updated_at` TIMESTAMP NULL,
  `added_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logistics`.`storage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`storage` ;

CREATE TABLE IF NOT EXISTS `logistics`.`storage` (
  `storageid` INT NOT NULL AUTO_INCREMENT,
  `userid` INT NOT NULL,
  `name` VARCHAR(40) NULL,
  `flagstate` TINYINT(1) NULL DEFAULT 1,
  `updated_at` TIMESTAMP NULL,
  `added_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`storageid`),
  INDEX `userid1_idx` (`userid` ASC),
  CONSTRAINT `userid1`
    FOREIGN KEY (`userid`)
    REFERENCES `logistics`.`user` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logistics`.`input`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`input` ;

CREATE TABLE IF NOT EXISTS `logistics`.`input` (
  `inputid` INT NOT NULL AUTO_INCREMENT,
  `supplierid` INT NOT NULL,
  `date` DATE NOT NULL,
  `status` TINYINT(1) NULL DEFAULT 1,
  `added_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`inputid`),
  INDEX `supplierid1_idx` (`supplierid` ASC),
  CONSTRAINT `supplierid1`
    FOREIGN KEY (`supplierid`)
    REFERENCES `logistics`.`supplier` (`supplierid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logistics`.`inputdetail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`inputdetail` ;

CREATE TABLE IF NOT EXISTS `logistics`.`inputdetail` (
  `inputdetailid` INT NOT NULL AUTO_INCREMENT,
  `inputid` INT NOT NULL,
  `productid` INT NOT NULL,
  `packingid` INT NOT NULL,
  `unitprice` DECIMAL(11,2) NOT NULL,
  `quantity` INT NOT NULL,
  `added_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`inputdetailid`),
  INDEX `inputid1_idx` (`inputid` ASC),
  INDEX `productid1_idx` (`productid` ASC),
  INDEX `packingid4_idx` (`packingid` ASC),
  CONSTRAINT `inputid1`
    FOREIGN KEY (`inputid`)
    REFERENCES `logistics`.`input` (`inputid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `productid1`
    FOREIGN KEY (`productid`)
    REFERENCES `logistics`.`product` (`productid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `packingid4`
    FOREIGN KEY (`packingid`)
    REFERENCES `logistics`.`packing` (`packingid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logistics`.`stock`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`stock` ;

CREATE TABLE IF NOT EXISTS `logistics`.`stock` (
  `stockid` INT NOT NULL AUTO_INCREMENT,
  `productid` INT NOT NULL,
  `packingid` INT NOT NULL,
  `storageid` INT NOT NULL,
  `quantity` INT NOT NULL DEFAULT 0,
  `unitprice` FLOAT NULL DEFAULT 0,
  `shelf` VARCHAR(8) NULL,
  `updated_at` DATETIME NULL,
  `added_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`stockid`, `productid`, `packingid`, `storageid`),
  INDEX `productid2_idx` (`productid` ASC),
  INDEX `storageid1_idx` (`storageid` ASC),
  INDEX `packingid1_idx` (`packingid` ASC),
  CONSTRAINT `storageid1`
    FOREIGN KEY (`storageid`)
    REFERENCES `logistics`.`storage` (`storageid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `productid2`
    FOREIGN KEY (`productid`)
    REFERENCES `logistics`.`product` (`productid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `packingid1`
    FOREIGN KEY (`packingid`)
    REFERENCES `logistics`.`packing` (`packingid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logistics`.`output`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`output` ;

CREATE TABLE IF NOT EXISTS `logistics`.`output` (
  `outputid` INT NOT NULL AUTO_INCREMENT,
  `storageid_out` INT NOT NULL,
  `storageid_in` INT NOT NULL,
  `date` DATE NOT NULL,
  `status` TINYINT(1) NOT NULL,
  `updated_at` TIMESTAMP NULL,
  `added_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`outputid`),
  INDEX `storageid3_idx` (`storageid_out` ASC),
  INDEX `storageid4_idx` (`storageid_in` ASC),
  CONSTRAINT `storageid3`
    FOREIGN KEY (`storageid_out`)
    REFERENCES `logistics`.`storage` (`storageid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `storageid4`
    FOREIGN KEY (`storageid_in`)
    REFERENCES `logistics`.`storage` (`storageid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logistics`.`order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`order` ;

CREATE TABLE IF NOT EXISTS `logistics`.`order` (
  `orderid` INT NOT NULL AUTO_INCREMENT,
  `storageid` INT NOT NULL,
  `date` DATE NOT NULL,
  `shippingdate` DATE NULL,
  `status` ENUM('request', 'shipped', 'arrived', 'stored') NULL,
  `updated_at` TIMESTAMP NULL,
  `added_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderid`),
  UNIQUE INDEX `status_UNIQUE` (`status` ASC),
  INDEX `storageid2_idx` (`storageid` ASC),
  CONSTRAINT `storageid2`
    FOREIGN KEY (`storageid`)
    REFERENCES `logistics`.`storage` (`storageid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logistics`.`orderdetail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`orderdetail` ;

CREATE TABLE IF NOT EXISTS `logistics`.`orderdetail` (
  `orderdetailid` INT NOT NULL AUTO_INCREMENT,
  `orderid` INT NOT NULL,
  `productid` INT NOT NULL,
  `packingid` INT NOT NULL,
  `quantity` INT NOT NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`orderdetailid`),
  INDEX `orderid1_idx` (`orderid` ASC),
  INDEX `productid3_idx` (`productid` ASC),
  INDEX `packingid2_idx` (`packingid` ASC),
  CONSTRAINT `orderid1`
    FOREIGN KEY (`orderid`)
    REFERENCES `logistics`.`order` (`orderid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `productid3`
    FOREIGN KEY (`productid`)
    REFERENCES `logistics`.`product` (`productid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `packingid2`
    FOREIGN KEY (`packingid`)
    REFERENCES `logistics`.`packing` (`packingid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logistics`.`outputdetail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logistics`.`outputdetail` ;

CREATE TABLE IF NOT EXISTS `logistics`.`outputdetail` (
  `outputdetailid` INT NOT NULL AUTO_INCREMENT,
  `outputid` INT NOT NULL,
  `productid` INT NOT NULL,
  `packingid` INT NOT NULL,
  `unitprice` DECIMAL(11,2) NOT NULL,
  `quantity` INT NOT NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`outputdetailid`),
  INDEX `outputid1_idx` (`outputid` ASC),
  INDEX `productid4_idx` (`productid` ASC),
  INDEX `packingid3_idx` (`packingid` ASC),
  CONSTRAINT `outputid1`
    FOREIGN KEY (`outputid`)
    REFERENCES `logistics`.`output` (`outputid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `productid4`
    FOREIGN KEY (`productid`)
    REFERENCES `logistics`.`product` (`productid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `packingid3`
    FOREIGN KEY (`packingid`)
    REFERENCES `logistics`.`packing` (`packingid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `logistics` ;

-- -----------------------------------------------------
-- procedure add_input_to_stock
-- -----------------------------------------------------

USE `logistics`;
DROP procedure IF EXISTS `logistics`.`add_input_to_stock`;

DELIMITER $$
USE `logistics`$$
CREATE PROCEDURE `add_input_to_stock` (IN `input` INT)
BEGIN
	CREATE TEMPORARY TABLE temptab (productid INT, packingid INT, quantity INT); 
	INSERT INTO temptab 
	(SELECT productid, packingid, quantity 
	FROM inputdetail 
	WHERE inputdetail.inputid = input); 
	UPDATE stock, temptab 
	SET stock.quantity = stock.quantity + temptab.quantity 
	WHERE stock.productid = temptab.productid AND stock.packingid = temptab.packingid; 
	DROP TEMPORARY TABLE IF EXISTS temptab;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure remove_input_from_stock
-- -----------------------------------------------------

USE `logistics`;
DROP procedure IF EXISTS `logistics`.`remove_input_from_stock`;

DELIMITER $$
USE `logistics`$$
CREATE PROCEDURE `remove_input_from_stock` (IN `input` INT)
BEGIN
	CREATE TEMPORARY TABLE temptab (productid INT, packingid INT, quantity INT); 
	INSERT INTO temptab 
	(SELECT productid, packingid, quantity 
	FROM inputdetail 
	WHERE inputdetail.inputid = input); 
	UPDATE stock, temptab 
	SET stock.quantity = stock.quantity - temptab.quantity 
	WHERE stock.productid = temptab.productid AND stock.packingid = temptab.packingid; 
	DROP TEMPORARY TABLE IF EXISTS temptab; 
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure accept_output
-- -----------------------------------------------------

USE `logistics`;
DROP procedure IF EXISTS `logistics`.`accept_output`;

DELIMITER $$
USE `logistics`$$
CREATE PROCEDURE `accept_output` (IN `outputv` INT, IN `storein` INT, IN `storeout` INT)
BEGIN
CREATE TEMPORARY TABLE aux (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            productid INT, packingID INT, quantity INT);
INSERT INTO aux (productid, packingid, quantity)
	SELECT productid, packingid, quantity
    FROM outputdetail WHERE outputid = outputv;
SET @hmany = (SELECT COUNT(*) FROM aux);
SET @counter = 1;
WHILE counter < @hmany + 1 DO
	SET @xprod = (SELECT productid FROM aux WHERE aux.id = @counter);
    SET @xpack = (SELECT packingid FROM aux WHERE aux.id = @counter);
    SET @xquan = (SELECT quantity  FROM aux WHERE aux.id = @counter);
	IF EXISTS 
    (SELECT stock.productid, stock.packingid, stock.storageid
     FROM stock
     WHERE stock.productid = @xprod
     AND stock.packingid = @xpack
     AND stock.storageid = @xquan) THEN
        UPDATE stock
        	SET stock.quantity = stock.quantity + @xquan
        	WHERE stock.productid = @xprod
        	AND stock.packingid = @xpack
        	AND stock.storageid = @storein;
	ELSE
    	INSERT INTO stock (productid, packingid, quantity)
        VALUES (@xprod, @xpack, @xquan, @storein);
    END IF;
	UPDATE stock
    	SET stock.quantity = stock.quantity - @xquan
        WHERE stock.productid = @xprod
        AND stock.packingid = @xpack
        AND stock.storageid = storeout;
	SET @counter = @counter + 1;
END WHILE;
DROP TEMPORARY TABLE aux;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure decline_output
-- -----------------------------------------------------

USE `logistics`;
DROP procedure IF EXISTS `logistics`.`decline_output`;

DELIMITER $$
USE `logistics`$$
CREATE PROCEDURE `decline_output` (IN `outputv` INT, IN `storein` INT, IN `storeout` INT)
BEGIN
CREATE TEMPORARY TABLE aux (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            productid INT, packingid INT, quantity INT);
INSERT INTO aux (productid, packingid, quantity)
	SELECT outputdetail.productid, outputdetail.packingid,
    	outputdetail.quantity
    FROM inputdetail WHERE outputdetail.outputid = outputv;
UPDATE stock, aux
	SET stock.quantity = stock.quantity - aux.quantity
    WHERE stock.productid = aux.productid
    AND stock.packingid = aux.packingid
    AND stock.storageid = storein;
UPDATE stock, aux
	SET stock.quantity = stock.quantity + aux.quantity
    WHERE stock.productid = aux.productid
    AND stock.packingid = aux.packingid
    AND stock.storageid = storeout;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure convertpack
-- -----------------------------------------------------

USE `logistics`;
DROP procedure IF EXISTS `logistics`.`convertpack`;

DELIMITER $$
USE `logistics`$$
CREATE PROCEDURE `convertpack` ()
BEGIN
	
END$$

DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
