CREATE TABLE `masinde_store`.`vendorcartitem` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `vendorProductId` INT NOT NULL,
  `cartId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` INT NULL,
  `quantity` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `vci_vp_fkey`
    FOREIGN KEY (`vendorProductId`)
    REFERENCES `masinde_store`.`vendorproduct` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `vci_cart_fkey`
    FOREIGN KEY (`cartId`)
    REFERENCES `masinde_store`.`cart` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


DELETE FROM `masinde_store`.`sales` WHERE (`id` = '2');
DELETE FROM `masinde_store`.`sales` WHERE (`id` = '3');