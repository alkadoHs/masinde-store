ALTER TABLE `masinde_store`.`order` 
DROP FOREIGN KEY `Order_userId_fkey`;
ALTER TABLE `masinde_store`.`order` 
CHANGE COLUMN `userId` `userId` VARCHAR(191) NULL ;
ALTER TABLE `masinde_store`.`order` 
ADD CONSTRAINT `Order_userId_fkey`
  FOREIGN KEY (`userId`)
  REFERENCES `masinde_store`.`user` (`id`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;


  ALTER TABLE `masinde_store`.`branchproduct` 
DROP FOREIGN KEY `BranchProduct_productId_fkey`;
ALTER TABLE `masinde_store`.`branchproduct` 
ADD CONSTRAINT `BranchProduct_productId_fkey`
  FOREIGN KEY (`productId`)
  REFERENCES `masinde_store`.`product` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;