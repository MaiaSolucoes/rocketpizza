SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `rocketpizza`;
CREATE SCHEMA IF NOT EXISTS `rocketpizza` DEFAULT CHARACTER SET latin1 ;
USE `rocketpizza` ;

-- -----------------------------------------------------
-- Table `product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `product` ;

CREATE  TABLE IF NOT EXISTS `product` (
  `product_id` INT NOT NULL AUTO_INCREMENT ,
  `product_name` VARCHAR(100) NOT NULL ,
  `product_validity` DATE NOT NULL ,
  `product_description_short` VARCHAR(250) NULL ,
  `product_description_long` TEXT NULL ,
  PRIMARY KEY (`product_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE UNIQUE INDEX `product_name_UNIQUE` ON `product` (`product_name` ASC) ;


-- -----------------------------------------------------
-- Table `product_addon`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `product_addon` ;

CREATE  TABLE IF NOT EXISTS `product_addon` (
  `product_addon_id` INT NOT NULL AUTO_INCREMENT ,
  `product_addon_product_id` INT NOT NULL ,
  `product_addon_name` VARCHAR(100) NOT NULL ,
  `product_addon_description_short` VARCHAR(250) NULL ,
  `product_addon_price` DECIMAL(6,2) NOT NULL ,
  PRIMARY KEY (`product_addon_id`) ,
  CONSTRAINT `fk_product_addon_product2`
    FOREIGN KEY (`product_addon_product_id` )
    REFERENCES `product` (`product_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE UNIQUE INDEX `product_addon_name_UNIQUE` ON `product_addon` (`product_addon_name` ASC) ;

CREATE INDEX `fk_product_addon_product1` ON `product_addon` (`product_addon_product_id` ASC) ;


-- -----------------------------------------------------
-- Table `product_size`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `product_size` ;

CREATE  TABLE IF NOT EXISTS `product_size` (
  `product_size_id` INT NOT NULL AUTO_INCREMENT ,
  `product_size_product` INT NOT NULL ,
  `product_size_weight` DECIMAL(6,3) NOT NULL ,
  `product_size` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`product_size_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `product_price`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `product_price` ;

CREATE  TABLE IF NOT EXISTS `product_price` (
  `product_price_id` INT NOT NULL AUTO_INCREMENT ,
  `product_price_product_id` INT NOT NULL ,
  `product_price_size_id` INT NOT NULL ,
  `product_price` DECIMAL(6,2) NOT NULL ,
  PRIMARY KEY (`product_price_id`) ,
  CONSTRAINT `fk_product_price_product2`
    FOREIGN KEY (`product_price_product_id` )
    REFERENCES `product` (`product_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_price_product_size2`
    FOREIGN KEY (`product_price_size_id` )
    REFERENCES `product_size` (`product_size_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `fk_product_price_product1` ON `product_price` (`product_price_product_id` ASC) ;

CREATE INDEX `fk_product_price_product_size1` ON `product_price` (`product_price_size_id` ASC) ;


-- -----------------------------------------------------
-- Table `district`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `district` ;

CREATE  TABLE IF NOT EXISTS `district` (
  `district_id` INT NOT NULL AUTO_INCREMENT ,
  `district_name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`district_id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `district_name_UNIQUE` ON `district` (`district_name` ASC) ;


-- -----------------------------------------------------
-- Table `city`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `city` ;

CREATE  TABLE IF NOT EXISTS `city` (
  `city_id` INT NOT NULL AUTO_INCREMENT ,
  `city_state` INT NOT NULL ,
  `city_name` VARCHAR(100) NOT NULL ,
  `city_po_box` INT NOT NULL ,
  PRIMARY KEY (`city_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `po_box`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `po_box` ;

CREATE  TABLE IF NOT EXISTS `po_box` (
  `po_box_id` INT NOT NULL ,
  `po_box_address` VARCHAR(100) NOT NULL ,
  `po_box_district_id` INT NULL ,
  `po_box_city_id` INT NOT NULL ,
  PRIMARY KEY (`po_box_id`) ,
  CONSTRAINT `fk_po_box_district10`
    FOREIGN KEY (`po_box_district_id` )
    REFERENCES `district` (`district_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_po_box_city10`
    FOREIGN KEY (`po_box_city_id` )
    REFERENCES `city` (`city_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_po_box_district1` ON `po_box` (`po_box_district_id` ASC) ;

CREATE INDEX `fk_po_box_city1` ON `po_box` (`po_box_city_id` ASC) ;


-- -----------------------------------------------------
-- Table `email`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `email` ;

CREATE  TABLE IF NOT EXISTS `email` (
  `email_id` INT NOT NULL AUTO_INCREMENT ,
  `email_name` VARCHAR(100) NOT NULL ,
  `email_type` SET('P','W','O') NOT NULL DEFAULT 'P' COMMENT 'Personal, Work, Other' ,
  `email_is_active` BIT NOT NULL DEFAULT 1 ,
  `email_can_send_promotion` BIT NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`email_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `phone`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `phone` ;

CREATE  TABLE IF NOT EXISTS `phone` (
  `phone_id` INT NOT NULL AUTO_INCREMENT ,
  `phone_number` VARCHAR(12) NOT NULL ,
  `phone_type` SET('P','W','O') NOT NULL DEFAULT 'P' COMMENT 'Personal, Work, Other' ,
  `phone_is_active` BIT NOT NULL DEFAULT 1 ,
  `phone_can_call_promotion` BIT NOT NULL DEFAULT 1 ,
  `phone_can_send_sms` BIT NOT NULL DEFAULT 0 ,
  `phone_area_code` VARCHAR(3) NOT NULL ,
  `phone_country_code` VARCHAR(4) NOT NULL DEFAULT '+55' ,
  PRIMARY KEY (`phone_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `customer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `customer` ;

CREATE  TABLE IF NOT EXISTS `customer` (
  `customer_id` INT NOT NULL AUTO_INCREMENT ,
  `customer_po_box_id` INT NOT NULL COMMENT 'CEP' ,
  `customer_phone_id` INT NULL ,
  `customer_email_id` INT NULL ,
  `customer_address_number` INT NULL ,
  `customer_address_complement` VARCHAR(250) NULL ,
  `customer_name` VARCHAR(100) NOT NULL ,
  `customer_bdate` DATE NULL ,
  `customer_observation` TEXT NULL ,
  PRIMARY KEY (`customer_id`) ,
  CONSTRAINT `fk_customer_po_box10`
    FOREIGN KEY (`customer_po_box_id` )
    REFERENCES `po_box` (`po_box_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_customer_email10`
    FOREIGN KEY (`customer_email_id` )
    REFERENCES `email` (`email_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_customer_phone10`
    FOREIGN KEY (`customer_phone_id` )
    REFERENCES `phone` (`phone_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_customer_po_box1` ON `customer` (`customer_po_box_id` ASC) ;

CREATE INDEX `fk_customer_email1` ON `customer` (`customer_email_id` ASC) ;

CREATE INDEX `fk_customer_phone1` ON `customer` (`customer_phone_id` ASC) ;


-- -----------------------------------------------------
-- Table `sale_payment_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sale_payment_type` ;

CREATE  TABLE IF NOT EXISTS `sale_payment_type` (
  `sale_payment_type_id` INT NOT NULL AUTO_INCREMENT ,
  `sale_payment_type_name` VARCHAR(50) NOT NULL ,
  `sale_payment_type_description_short` VARCHAR(250) NULL ,
  PRIMARY KEY (`sale_payment_type_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE UNIQUE INDEX `sale_payment_type_name_UNIQUE` ON `sale_payment_type` (`sale_payment_type_name` ASC) ;


-- -----------------------------------------------------
-- Table `sale`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sale` ;

CREATE  TABLE IF NOT EXISTS `sale` (
  `sale_id` INT NOT NULL AUTO_INCREMENT ,
  `sale_date_time` DATETIME NULL ,
  `sale_payment_type_id` INT NOT NULL ,
  `sale_value_receipt` DECIMAL(6,2) NOT NULL ,
  PRIMARY KEY (`sale_id`) ,
  CONSTRAINT `fk_sale_sale_payment_type2`
    FOREIGN KEY (`sale_payment_type_id` )
    REFERENCES `sale_payment_type` (`sale_payment_type_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `fk_sale_sale_payment_type3` ON `sale` (`sale_payment_type_id` ASC) ;


-- -----------------------------------------------------
-- Table `sale_payment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sale_payment` ;

CREATE  TABLE IF NOT EXISTS `sale_payment` (
  `sale_payment_customer_id` INT NOT NULL ,
  `sale_payment_product_price_id` INT NOT NULL ,
  `sale_payment_sale_id` INT NOT NULL ,
  `sale_payment_discount_percentage` DECIMAL(5,2) NULL ,
  PRIMARY KEY (`sale_payment_customer_id`, `sale_payment_product_price_id`, `sale_payment_sale_id`) ,
  CONSTRAINT `fk_sale_payment_sale4`
    FOREIGN KEY (`sale_payment_sale_id` )
    REFERENCES `sale` (`sale_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sale_payment_product_price2`
    FOREIGN KEY (`sale_payment_product_price_id` )
    REFERENCES `product_price` (`product_price_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sale_payment_customer1`
    FOREIGN KEY (`sale_payment_customer_id` )
    REFERENCES `customer` (`customer_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `fk_sale_payment_sale1` ON `sale_payment` (`sale_payment_sale_id` ASC) ;

CREATE INDEX `fk_sale_payment_product_price1` ON `sale_payment` (`sale_payment_product_price_id` ASC) ;

CREATE INDEX `fk_sale_payment_customer1` ON `sale_payment` (`sale_payment_customer_id` ASC) ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
