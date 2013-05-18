DROP SCHEMA IF EXISTS `one` ;
CREATE SCHEMA IF NOT EXISTS `one` DEFAULT CHARACTER SET utf8 ;
USE `one` ;

-- -----------------------------------------------------
-- Table `one`.`shop_product`
-- -----------------------------------------------------
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
CREATE  TABLE IF NOT EXISTS `one`.`shop_category` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`shop_order`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `one`.`shop_order` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `product_id` BIGINT(20) UNSIGNED NULL ,
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
CREATE  TABLE IF NOT EXISTS `one`.`one_shop` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `logo` VARCHAR(255) NULL ,
  `order_mode` VARCHAR(45) NULL ,
  `order_url` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_site`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `one`.`one_site` (
  `id` INT NOT NULL ,
  `name` VARCHAR(255) NULL ,
  `url` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_user_shop`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `one`.`one_user_shop` (
  `user_id` BIGINT(20) UNSIGNED NOT NULL ,
  `shop_id` BIGINT(20) UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`, `shop_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_user_site`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `one`.`one_user_site` (
  `user_id` BIGINT(20) UNSIGNED NOT NULL ,
  `site_id` BIGINT(20) UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`, `site_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_cpo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `one`.`one_cpo` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `site_id` BIGINT(20) UNSIGNED NOT NULL ,
  `shop_id` BIGINT(20) UNSIGNED NOT NULL ,
  `product_id` BIGINT(20) UNSIGNED NULL ,
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
CREATE  TABLE IF NOT EXISTS `one`.`one_category` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_site_product`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `one`.`one_site_product` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `shop_id` BIGINT(20) UNSIGNED NULL ,
  `status` VARCHAR(255) NULL ,
  `category_id` BIGINT(20) UNSIGNED NOT NULL ,
  `name` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `price` DECIMAL(10,2) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_site_category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `one`.`one_site_category` (
  `site_id` BIGINT(20) UNSIGNED NOT NULL ,
  `category_id` BIGINT(20) UNSIGNED NOT NULL ,
  PRIMARY KEY (`site_id`, `category_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_cpc`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `one`.`one_cpc` (
  `site_id` BIGINT(20) UNSIGNED NOT NULL ,
  `shop_id` BIGINT(20) UNSIGNED NOT NULL ,
  PRIMARY KEY (`site_id`, `shop_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `one`.`one_user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `one`.`one_user` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) NULL ,
  `password` VARCHAR(32) NULL ,
  `group` VARCHAR(255) NULL ,
  `api_token` VARCHAR(32) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

