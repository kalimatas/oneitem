SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `one` ;
CREATE SCHEMA IF NOT EXISTS `one` DEFAULT CHARACTER SET utf8 ;
DROP SCHEMA IF EXISTS `one` ;
CREATE SCHEMA IF NOT EXISTS `one` DEFAULT CHARACTER SET utf8 ;
USE `one` ;

-- -----------------------------------------------------
-- Table `one`.`shop_product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `one`.`shop_product` ;

CREATE  TABLE IF NOT EXISTS `one`.`shop_product` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `status` VARCHAR(255) NULL ,
  `category_id` BIGINT(20) UNSIGNED NOT NULL ,
  `name` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `price` DECIMAL(10,2) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`shop_category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `one`.`shop_category` ;

CREATE  TABLE IF NOT EXISTS `one`.`shop_category` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`shop_order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `one`.`shop_order` ;

CREATE  TABLE IF NOT EXISTS `one`.`shop_order` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `product_id` BIGINT(20) UNSIGNED NOT NULL ,
  `price` DECIMAL(10,2) NULL ,
  `name` VARCHAR(255) NULL ,
  `mobile` VARCHAR(255) NULL ,
  `address` VARCHAR(255) NULL ,
  `added` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_shop`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `one`.`one_shop` ;

CREATE  TABLE IF NOT EXISTS `one`.`one_shop` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `logo` VARCHAR(255) NULL ,
  `url` VARCHAR(255) NULL ,
  `order_mode` VARCHAR(45) NULL ,
  `order_url` VARCHAR(255) NULL ,
  `json_url` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_site`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `one`.`one_site` ;

CREATE  TABLE IF NOT EXISTS `one`.`one_site` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `url` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_user_shop`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `one`.`one_user_shop` ;

CREATE  TABLE IF NOT EXISTS `one`.`one_user_shop` (
  `user_id` BIGINT(20) UNSIGNED NOT NULL ,
  `shop_id` BIGINT(20) UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`, `shop_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_user_site`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `one`.`one_user_site` ;

CREATE  TABLE IF NOT EXISTS `one`.`one_user_site` (
  `user_id` BIGINT(20) UNSIGNED NOT NULL ,
  `site_id` BIGINT(20) UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`, `site_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_cpo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `one`.`one_cpo` ;

CREATE  TABLE IF NOT EXISTS `one`.`one_cpo` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `site_id` BIGINT(20) UNSIGNED NOT NULL ,
  `shop_id` BIGINT(20) UNSIGNED NOT NULL ,
  `product_id` BIGINT(20) UNSIGNED NOT NULL ,
  `name` VARCHAR(255) NULL ,
  `mobile` VARCHAR(255) NULL ,
  `address` VARCHAR(255) NULL ,
  `added` TIMESTAMP NULL ,
  `price` DECIMAL(10,2) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `one`.`one_category` ;

CREATE  TABLE IF NOT EXISTS `one`.`one_category` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_shop_product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `one`.`one_shop_product` ;

CREATE  TABLE IF NOT EXISTS `one`.`one_shop_product` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `shop_id` BIGINT(20) UNSIGNED NOT NULL ,
  `shop_product_id` BIGINT(20) UNSIGNED NOT NULL ,
  `status` VARCHAR(255) NULL ,
  `category_id` BIGINT(20) UNSIGNED NOT NULL ,
  `name` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `price` DECIMAL(10,2) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `shop_ui` (`shop_id` ASC, `shop_product_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_cpc`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `one`.`one_cpc` ;

CREATE  TABLE IF NOT EXISTS `one`.`one_cpc` (
  `site_id` BIGINT(20) UNSIGNED NOT NULL ,
  `shop_id` BIGINT(20) UNSIGNED NOT NULL ,
  PRIMARY KEY (`site_id`, `shop_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `one`.`one_user` ;

CREATE  TABLE IF NOT EXISTS `one`.`one_user` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) NULL ,
  `password` VARCHAR(32) NULL ,
  `group` VARCHAR(255) NULL ,
  `api_token` VARCHAR(32) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

USE `one` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
