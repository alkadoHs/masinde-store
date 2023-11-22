ALTER TABLE `masinde_store`.`order` 
DROP FOREIGN KEY `orderId_fkeyyy`;
ALTER TABLE `masinde_store`.`order` 
CHANGE COLUMN `customerId` `customerId` VARCHAR(100) NULL DEFAULT NULL ,
DROP INDEX `orderId_fkeyyy_idx` ;


ALTER TABLE `masinde_store`.`order` 
CHANGE COLUMN `customerId` `customerId` VARCHAR(100) NULL DEFAULT 'UNKOWN' ;



ALTER TABLE `masinde_store`.`transferedproduct` 
DROP FOREIGN KEY `TransferedProduct_fromBranchId_fkey`,
DROP FOREIGN KEY `TransferedProduct_toBranchId_fkey`;
ALTER TABLE `masinde_store`.`transferedproduct` 
CHANGE COLUMN `fromBranchId` `fromBranchId` INT NULL ,
CHANGE COLUMN `toBranchId` `toBranchId` INT NULL ;
ALTER TABLE `masinde_store`.`transferedproduct` 
ADD CONSTRAINT `TransferedProduct_fromBranchId_fkey`
  FOREIGN KEY (`fromBranchId`)
  REFERENCES `masinde_store`.`branch` (`id`)
  ON DELETE SET NULL
  ON UPDATE CASCADE,
ADD CONSTRAINT `TransferedProduct_toBranchId_fkey`
  FOREIGN KEY (`toBranchId`)
  REFERENCES `masinde_store`.`branch` (`id`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;
