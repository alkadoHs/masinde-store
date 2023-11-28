ALTER TABLE `masinde_store`.`vendorproduct` 
ADD COLUMN `inventory` INT NOT NULL AFTER `createdAt`;

ALTER TABLE `masinde_store`.`vendorproduct` 
ADD COLUMN `status` VARCHAR(45) NULL DEFAULT 'pending' AFTER `inventory`;