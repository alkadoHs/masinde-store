CREATE TABLE `masinde_store`.`stock_return` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `userId` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL, -- Specify the collation
  `branchId` INT NOT NULL,
  `vendorProductId` INT NOT NULL,
  `quantity` INT NOT NULL,
  `createdAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `st_branch_fkey_idx` (`branchId` ASC) VISIBLE,
  INDEX `vp_fkey_idx` (`vendorProductId` ASC) VISIBLE,
  CONSTRAINT `st_user_fkey`
    FOREIGN KEY (`userId`)
    REFERENCES `masinde_store`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `st_branch_fkey`
    FOREIGN KEY (`branchId`)
    REFERENCES `masinde_store`.`branch` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `vp_fkey`
    FOREIGN KEY (`vendorProductId`)
    REFERENCES `masinde_store`.`vendorproduct` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



ALTER TABLE `masinde_store`.`stock_return` 
ADD COLUMN `status` VARCHAR(45) NOT NULL AFTER `quantity`;