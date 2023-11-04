-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: masinde_store
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `branch` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch`
--

LOCK TABLES `branch` WRITE;
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` VALUES (1,'MAIN STORE','store','2023-10-27 01:23:18.800'),(2,'UYOLE SHOP','shop','2023-10-27 03:15:18.634'),(3,'MBALIZI STORE','store','2023-10-27 03:15:18.635');
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branchproduct`
--

DROP TABLE IF EXISTS `branchproduct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `branchproduct` (
  `id` int NOT NULL AUTO_INCREMENT,
  `productId` int NOT NULL,
  `branchId` int NOT NULL,
  `damages` int NOT NULL DEFAULT '0',
  `quantity` int NOT NULL,
  `inventory` int NOT NULL,
  `stockLimit` int NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `BranchProduct_productId_fkey` (`productId`),
  KEY `BranchProduct_branchId_fkey` (`branchId`),
  CONSTRAINT `BranchProduct_branchId_fkey` FOREIGN KEY (`branchId`) REFERENCES `branch` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `BranchProduct_productId_fkey` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branchproduct`
--

LOCK TABLES `branchproduct` WRITE;
/*!40000 ALTER TABLE `branchproduct` DISABLE KEYS */;
INSERT INTO `branchproduct` VALUES (1,1,2,0,340,340,20,'2023-10-30 06:25:36','2023-10-31 07:29:21'),(2,3,1,0,340,100,30,'2023-10-30 06:25:36','2023-11-04 06:58:20'),(3,2,3,0,850,850,100,'2023-10-30 06:25:36','2023-10-31 08:46:31'),(5,4,1,0,600,600,120,'2023-10-30 09:42:50',NULL),(6,8,1,0,1000,1000,100,'2023-10-30 09:42:50','2023-10-30 19:12:15'),(7,1,1,0,900,900,100,'2023-10-30 09:42:50','2023-10-30 19:02:50'),(8,2,1,2,4600,4570,340,'2023-10-30 12:25:32',NULL),(9,9,1,10,2000,2000,105,'2023-10-30 12:48:06','2023-10-31 08:37:34'),(11,11,1,1,980,980,126,'2023-10-30 12:48:06','2023-10-31 08:39:21'),(12,9,1,10,2000,2000,105,'2023-10-30 17:26:29','2023-10-31 08:39:06'),(18,13,1,0,1500,1500,110,'2023-10-31 05:29:05','2023-10-31 07:07:38'),(19,2,2,0,2005,2005,100,'2023-10-31 08:40:01',NULL),(20,3,2,0,1200,1200,100,'2023-10-31 08:42:45',NULL),(21,4,2,10,1230,1230,100,'2023-10-31 08:43:16',NULL),(23,1,3,0,500,500,100,'2023-10-31 08:46:55',NULL),(24,9,3,0,5500,5500,102,'2023-10-31 08:47:45','2023-10-31 08:48:00'),(25,8,2,0,120,120,50,'2023-10-31 09:02:38',NULL),(28,12,2,0,50,50,50,'2023-10-31 09:06:42',NULL);
/*!40000 ALTER TABLE `branchproduct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
  PRIMARY KEY (`id`),
  KEY `Cart_userId_fkey` (`userId`),
  CONSTRAINT `Cart_userId_fkey` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cartitem`
--

DROP TABLE IF EXISTS `cartitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cartitem` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cartId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchProductId` int NOT NULL,
  `price` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `CartItem_cartId_fkey` (`cartId`),
  KEY `CartItem_branchProductId_fkey` (`branchProductId`),
  CONSTRAINT `CartItem_branchProductId_fkey` FOREIGN KEY (`branchProductId`) REFERENCES `branchproduct` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `CartItem_cartId_fkey` FOREIGN KEY (`cartId`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartitem`
--

LOCK TABLES `cartitem` WRITE;
/*!40000 ALTER TABLE `cartitem` DISABLE KEYS */;
/*!40000 ALTER TABLE `cartitem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'Manase Juma',87765544,'Kyela','2023-11-03 04:26:30.461'),(2,'Asa Kimaro',754345666,'Mbeya','2023-11-03 04:26:30.463'),(3,'Jim Soney',643555433,'kiwanja','2023-11-03 04:26:30.464'),(4,'Salome Mwaweya',75533566,'Ubaruku','2023-11-03 04:26:30.464');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense`
--

DROP TABLE IF EXISTS `expense`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expense` (
  `id` int NOT NULL AUTO_INCREMENT,
  `totalAmount` int NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense`
--

LOCK TABLES `expense` WRITE;
/*!40000 ALTER TABLE `expense` DISABLE KEYS */;
/*!40000 ALTER TABLE `expense` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenseitem`
--

DROP TABLE IF EXISTS `expenseitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expenseitem` (
  `id` int NOT NULL AUTO_INCREMENT,
  `expenseId` int NOT NULL,
  `description` int NOT NULL,
  `amount` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ExpenseItem_expenseId_fkey` (`expenseId`),
  CONSTRAINT `ExpenseItem_expenseId_fkey` FOREIGN KEY (`expenseId`) REFERENCES `expense` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenseitem`
--

LOCK TABLES `expenseitem` WRITE;
/*!40000 ALTER TABLE `expenseitem` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenseitem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newstock`
--

DROP TABLE IF EXISTS `newstock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `newstock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `productBranchId` int NOT NULL,
  `branchId` int NOT NULL,
  `quantity` int NOT NULL,
  `userId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `NewStock_productBranchId_fkey` (`productBranchId`),
  KEY `NewStock_branchId_fkey` (`branchId`),
  KEY `NewStock_userId_fkey` (`userId`),
  CONSTRAINT `NewStock_branchId_fkey` FOREIGN KEY (`branchId`) REFERENCES `branch` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `NewStock_productBranchId_fkey` FOREIGN KEY (`productBranchId`) REFERENCES `branchproduct` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `NewStock_userId_fkey` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newstock`
--

LOCK TABLES `newstock` WRITE;
/*!40000 ALTER TABLE `newstock` DISABLE KEYS */;
/*!40000 ALTER TABLE `newstock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchId` int NOT NULL,
  `customerId` int DEFAULT NULL,
  `totalPrice` int NOT NULL,
  `amountPaid` int NOT NULL,
  `paymentMethod` enum('CASH','CREDIT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `Order_branchId_fkey` (`branchId`),
  KEY `Order_userId_fkey` (`userId`),
  KEY `orderId_fkeyyy_idx` (`customerId`),
  CONSTRAINT `Order_branchId_fkey` FOREIGN KEY (`branchId`) REFERENCES `branch` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `Order_userId_fkey` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `orderId_fkeyyy` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES ('0de8ddd7-c889-45f7-9fc8-559895a89ce9','527cb4db-d980-4626-8fa0-607ca82d2ebc',1,NULL,8500,8500,'CASH','2023-11-04 09:57:28.341'),('3f52d0fa-7783-4476-a0c4-a4fe4303ca93','527cb4db-d980-4626-8fa0-607ca82d2ebc',1,NULL,882000,882000,'CASH','2023-11-04 09:58:20.328'),('4ab3c653-2415-4bf8-aad4-a85ecbdf8e6d','527cb4db-d980-4626-8fa0-607ca82d2ebc',1,NULL,12500,12500,'CASH','2023-11-03 16:01:54.350'),('4b7881a7-2e82-4a39-927b-98d770f80a79','527cb4db-d980-4626-8fa0-607ca82d2ebc',1,NULL,881750,881750,'CASH','2023-11-04 09:16:45.543'),('55eb9cfe-5330-4148-a8cb-9f510dd16ec3','527cb4db-d980-4626-8fa0-607ca82d2ebc',1,NULL,448500,448500,'CASH','2023-11-03 16:42:20.197'),('b4d91fb6-70af-4dea-ab2b-f578ab44d4da','527cb4db-d980-4626-8fa0-607ca82d2ebc',1,NULL,360000,360000,'CASH','2023-11-04 09:54:23.373'),('e3e1ef91-8f05-450d-baa8-b2c4c25968de','527cb4db-d980-4626-8fa0-607ca82d2ebc',1,NULL,858500,858500,'CASH','2023-11-04 09:57:59.645'),('e6576564-c28d-4471-a7b1-aced7d4cfb19','527cb4db-d980-4626-8fa0-607ca82d2ebc',1,NULL,209000,209000,'CASH','2023-11-04 08:23:03.169');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderitem`
--

DROP TABLE IF EXISTS `orderitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orderitem` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchProductId` int NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
  PRIMARY KEY (`id`),
  KEY `OrderItem_branchProductId_fkey` (`branchProductId`),
  KEY `oifkey` (`order_id`),
  CONSTRAINT `oifkey` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `OrderItem_branchProductId_fkey` FOREIGN KEY (`branchProductId`) REFERENCES `branchproduct` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderitem`
--

LOCK TABLES `orderitem` WRITE;
/*!40000 ALTER TABLE `orderitem` DISABLE KEYS */;
INSERT INTO `orderitem` VALUES (2,'e6576564-c28d-4471-a7b1-aced7d4cfb19',6,6,13000,'2023-11-04 08:23:03.170'),(3,'e6576564-c28d-4471-a7b1-aced7d4cfb19',7,2,2050,'2023-11-04 08:23:03.171'),(4,'e6576564-c28d-4471-a7b1-aced7d4cfb19',8,8,7000,'2023-11-04 08:23:03.171'),(5,'e6576564-c28d-4471-a7b1-aced7d4cfb19',6,6,12500,'2023-11-04 08:23:03.172'),(6,'4b7881a7-2e82-4a39-927b-98d770f80a79',7,3,2050,'2023-11-04 09:16:45.544'),(7,'4b7881a7-2e82-4a39-927b-98d770f80a79',18,3,45000,'2023-11-04 09:16:45.545'),(8,'4b7881a7-2e82-4a39-927b-98d770f80a79',1,10,2050,'2023-11-04 09:16:45.545'),(9,'4b7881a7-2e82-4a39-927b-98d770f80a79',1,11,2100,'2023-11-04 09:16:45.546'),(10,'4b7881a7-2e82-4a39-927b-98d770f80a79',19,21,7000,'2023-11-04 09:16:45.546'),(11,'4b7881a7-2e82-4a39-927b-98d770f80a79',20,12,9000,'2023-11-04 09:16:45.546'),(12,'4b7881a7-2e82-4a39-927b-98d770f80a79',20,7,8500,'2023-11-04 09:16:45.547'),(13,'4b7881a7-2e82-4a39-927b-98d770f80a79',21,90,500,'2023-11-04 09:16:45.547'),(14,'4b7881a7-2e82-4a39-927b-98d770f80a79',21,120,300,'2023-11-04 09:16:45.547'),(15,'4b7881a7-2e82-4a39-927b-98d770f80a79',25,1,13000,'2023-11-04 09:16:45.547'),(16,'4b7881a7-2e82-4a39-927b-98d770f80a79',25,1,12500,'2023-11-04 09:16:45.548'),(17,'4b7881a7-2e82-4a39-927b-98d770f80a79',28,2,138000,'2023-11-04 09:16:45.548'),(19,'b4d91fb6-70af-4dea-ab2b-f578ab44d4da',2,40,9000,'2023-11-04 09:54:23.374'),(20,'0de8ddd7-c889-45f7-9fc8-559895a89ce9',2,1,8500,'2023-11-04 09:57:28.342'),(21,'e3e1ef91-8f05-450d-baa8-b2c4c25968de',2,101,8500,'2023-11-04 09:57:59.646'),(22,'3f52d0fa-7783-4476-a0c4-a4fe4303ca93',2,98,9000,'2023-11-04 09:58:20.329');
/*!40000 ALTER TABLE `orderitem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyPrice` int NOT NULL,
  `wholePrice` int NOT NULL,
  `retailPrice` int NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
  `updatedAt` datetime(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Product_name_key` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Malta Embe','Azam','',2000,2050,2100,'2023-10-29 22:13:20.254','0000-00-00 00:00:00.000'),(2,'Millinda Embe','New','unit',6000,6500,7000,'2023-10-29 22:01:10.691','0000-00-00 00:00:00.000'),(3,'Juice Cora','Moo','unit',8000,8500,9000,'2023-10-29 20:05:20.973','0000-00-00 00:00:00.000'),(4,'Binzar Nyeusi','Sonn','',200,300,500,'2023-10-29 20:08:48.202','0000-00-00 00:00:00.000'),(5,'BigBom Kubwa','BigSheper','packet',3000,4000,4500,'2023-10-29 20:10:27.582','0000-00-00 00:00:00.000'),(6,'Vinega King','Gozena','unit',30000,35000,40000,'2023-10-31 20:45:26.197','0000-00-00 00:00:00.000'),(8,'Pepsi Big','Peps','creti',12000,12500,13000,'2023-10-29 22:10:41.796','0000-00-00 00:00:00.000'),(9,'Azam Unga','Azam','gram',30000,35000,37000,'2023-10-30 15:41:13.915','0000-00-00 00:00:00.000'),(10,'Dofi','wsah','packet',9000,10000,10800,'2023-10-31 20:45:51.420','0000-00-00 00:00:00.000'),(11,'Family Sabuni','Simba','mche',50000,53000,58000,'2023-10-30 15:44:44.357','0000-00-00 00:00:00.000'),(12,'Betri KB','KB','',128000,138000,138000,'2023-10-30 20:32:21.701','0000-00-00 00:00:00.000'),(13,'Chocos','choc','paket',42000,45000,48000,'2023-10-31 08:19:19.931','0000-00-00 00:00:00.000');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchaseorder`
--

DROP TABLE IF EXISTS `purchaseorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchaseorder` (
  `id` varchar(255) NOT NULL,
  `supplierId` int DEFAULT NULL,
  `total` int NOT NULL,
  `paid` int NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `po_suplier_fkey_idx` (`supplierId`),
  CONSTRAINT `po_suplier_fkey` FOREIGN KEY (`supplierId`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchaseorder`
--

LOCK TABLES `purchaseorder` WRITE;
/*!40000 ALTER TABLE `purchaseorder` DISABLE KEYS */;
INSERT INTO `purchaseorder` VALUES ('0c0ac7d0-7e56-4d6d-b160-64ed263d6072',1,0,0,'pending','2023-10-31 20:44:02'),('12ee4d57-3c3c-41fb-ba62-9d23f5bac655',NULL,0,0,'pending','2023-11-01 12:12:20'),('130c49ec-b3f4-465d-8228-bf5939dfef4c',2,780000,300000,'complete','2023-11-01 12:12:36'),('18c1956b-e7ec-4d09-a890-5044ceff3918',1,0,0,'pending','2023-10-31 20:43:38'),('1b36715b-74a0-441c-bf9b-5435df818bfe',1,0,0,'pending','2023-10-31 20:43:45'),('1c897ee8-8835-48fa-926b-e01bb19ec2ae',2,0,0,'pending','2023-10-31 14:16:10'),('293c3e63-46fc-4e8d-b8b5-fddd54aab43f',1,0,0,'pending','2023-10-31 17:12:23'),('2cf84f42-0ef3-4000-a2b0-44dcef519e6f',2,1122000,1104000,'complete','2023-11-01 06:11:17'),('31a76c1f-d4b9-4cbe-9be3-6c216f3fb5c9',2,293600,213600,'complete','2023-11-01 10:19:24'),('42d48fa5-4668-4284-b3b4-bae36f84cb72',1,328000,320000,'complete','2023-11-01 10:26:03'),('4596618d-5e8a-4230-a001-6ccb6ce2367f',1,0,0,'pending','2023-10-31 20:44:00'),('49d7ed96-b311-4e02-bdec-8a70223c0a3a',2,0,0,'pending','2023-10-31 18:26:22'),('51722f58-753e-4464-a021-3cf7ead9f28b',1,1095000,600000,'complete','2023-11-01 12:14:10'),('520b8ef1-4f6d-4230-bb38-c15c8a8d38a7',2,961200,961200,'complete','2023-11-01 05:18:39'),('7b31ead1-aae6-4e5f-a8c5-c5535a0c6e1d',2,0,0,'pending','2023-10-31 15:28:09'),('83048ed3-81d2-40a2-aea8-5366b18dea86',1,934200,934200,'complete','2023-11-01 05:42:07'),('8bece99d-7ae4-41d8-9c62-57ddbb61f4bb',NULL,0,0,'pending','2023-11-01 12:13:19'),('9d93eee2-4417-4c44-93c1-85db5fee5c0e',2,162000,162000,'complete','2023-11-01 06:17:49'),('b82e9614-b1f3-43d1-a035-3c03c0ac707f',2,834000,200000,'complete','2023-11-01 12:13:31'),('c84ba7f2-3cd7-45cb-9349-90679ce03df1',NULL,0,0,'pending','2023-11-01 13:31:53'),('ced625ad-161b-4221-8df6-d592685a78cb',NULL,0,0,'pending','2023-11-01 12:00:33'),('fa630071-4e18-47f7-a603-47e57ad4ee13',2,0,0,'pending','2023-10-31 19:19:16');
/*!40000 ALTER TABLE `purchaseorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchaseorderitem`
--

DROP TABLE IF EXISTS `purchaseorderitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchaseorderitem` (
  `id` int NOT NULL AUTO_INCREMENT,
  `purchaseorderId` varchar(255) NOT NULL,
  `productId` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `poId_fkey_idx` (`purchaseorderId`),
  KEY `po_productId_fkey_idx` (`productId`),
  CONSTRAINT `po_productId_fkey` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `poi_fkey` FOREIGN KEY (`purchaseorderId`) REFERENCES `purchaseorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchaseorderitem`
--

LOCK TABLES `purchaseorderitem` WRITE;
/*!40000 ALTER TABLE `purchaseorderitem` DISABLE KEYS */;
INSERT INTO `purchaseorderitem` VALUES (33,'520b8ef1-4f6d-4230-bb38-c15c8a8d38a7',1,1,'2023-11-01 05:18:39'),(34,'520b8ef1-4f6d-4230-bb38-c15c8a8d38a7',2,10,'2023-11-01 05:18:39'),(35,'520b8ef1-4f6d-4230-bb38-c15c8a8d38a7',3,9,'2023-11-01 05:18:39'),(36,'520b8ef1-4f6d-4230-bb38-c15c8a8d38a7',4,11,'2023-11-01 05:18:39'),(37,'520b8ef1-4f6d-4230-bb38-c15c8a8d38a7',5,19,'2023-11-01 05:18:39'),(38,'520b8ef1-4f6d-4230-bb38-c15c8a8d38a7',6,21,'2023-11-01 05:18:39'),(39,'520b8ef1-4f6d-4230-bb38-c15c8a8d38a7',8,4,'2023-11-01 05:18:39'),(40,'520b8ef1-4f6d-4230-bb38-c15c8a8d38a7',9,3,'2023-11-01 05:18:39'),(41,'83048ed3-81d2-40a2-aea8-5366b18dea86',1,8,'2023-11-01 05:42:07'),(42,'83048ed3-81d2-40a2-aea8-5366b18dea86',2,90,'2023-11-01 05:42:07'),(43,'83048ed3-81d2-40a2-aea8-5366b18dea86',3,7,'2023-11-01 05:42:07'),(44,'83048ed3-81d2-40a2-aea8-5366b18dea86',4,6,'2023-11-01 05:42:07'),(45,'83048ed3-81d2-40a2-aea8-5366b18dea86',5,7,'2023-11-01 05:42:07'),(46,'83048ed3-81d2-40a2-aea8-5366b18dea86',6,10,'2023-11-01 05:42:07'),(47,'2cf84f42-0ef3-4000-a2b0-44dcef519e6f',10,4,'2023-11-01 06:11:17'),(48,'2cf84f42-0ef3-4000-a2b0-44dcef519e6f',11,3,'2023-11-01 06:11:17'),(49,'2cf84f42-0ef3-4000-a2b0-44dcef519e6f',12,6,'2023-11-01 06:11:17'),(50,'2cf84f42-0ef3-4000-a2b0-44dcef519e6f',13,4,'2023-11-01 06:11:17'),(51,'9d93eee2-4417-4c44-93c1-85db5fee5c0e',2,6,'2023-11-01 06:17:49'),(52,'9d93eee2-4417-4c44-93c1-85db5fee5c0e',3,10,'2023-11-01 06:17:49'),(53,'9d93eee2-4417-4c44-93c1-85db5fee5c0e',4,230,'2023-11-01 06:17:49'),(54,'31a76c1f-d4b9-4cbe-9be3-6c216f3fb5c9',2,18,'2023-11-01 10:19:24'),(55,'31a76c1f-d4b9-4cbe-9be3-6c216f3fb5c9',3,19,'2023-11-01 10:19:24'),(56,'31a76c1f-d4b9-4cbe-9be3-6c216f3fb5c9',4,18,'2023-11-01 10:19:24'),(57,'31a76c1f-d4b9-4cbe-9be3-6c216f3fb5c9',5,10,'2023-11-01 10:19:24'),(58,'42d48fa5-4668-4284-b3b4-bae36f84cb72',3,5,'2023-11-01 10:26:03'),(59,'42d48fa5-4668-4284-b3b4-bae36f84cb72',4,600,'2023-11-01 10:26:03'),(60,'42d48fa5-4668-4284-b3b4-bae36f84cb72',5,56,'2023-11-01 10:26:03'),(61,'130c49ec-b3f4-465d-8228-bf5939dfef4c',1,14,'2023-11-01 12:12:36'),(62,'130c49ec-b3f4-465d-8228-bf5939dfef4c',3,19,'2023-11-01 12:12:36'),(63,'130c49ec-b3f4-465d-8228-bf5939dfef4c',5,10,'2023-11-01 12:12:36'),(64,'130c49ec-b3f4-465d-8228-bf5939dfef4c',6,19,'2023-11-01 12:12:36'),(65,'b82e9614-b1f3-43d1-a035-3c03c0ac707f',2,133,'2023-11-01 12:13:31'),(66,'b82e9614-b1f3-43d1-a035-3c03c0ac707f',5,12,'2023-11-01 12:13:31'),(67,'51722f58-753e-4464-a021-3cf7ead9f28b',2,40,'2023-11-01 12:14:10'),(68,'51722f58-753e-4464-a021-3cf7ead9f28b',5,45,'2023-11-01 12:14:10'),(69,'51722f58-753e-4464-a021-3cf7ead9f28b',6,24,'2023-11-01 12:14:10');
/*!40000 ALTER TABLE `purchaseorderitem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchId` int NOT NULL,
  `total` int NOT NULL,
  `upatedAt` datetime(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Sales_branchId_key` (`branchId`),
  CONSTRAINT `Sales_branchId_fkey` FOREIGN KEY (`branchId`) REFERENCES `branch` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` int DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `supplyType` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'John Heche',98876659,'Mbeya','Juice, Mango, Vinega','2023-10-31 11:01:27'),(2,'Baretha',75443225,'Dar es salaam','Soda, Unga, Mafuta','2023-10-31 11:01:27');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transferedproduct`
--

DROP TABLE IF EXISTS `transferedproduct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transferedproduct` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branchProductId` int NOT NULL,
  `fromBranchId` int NOT NULL,
  `toBranchId` int NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
  PRIMARY KEY (`id`),
  KEY `TransferedProduct_branchProductId_fkey` (`branchProductId`),
  KEY `TransferedProduct_fromBranchId_fkey` (`fromBranchId`),
  KEY `TransferedProduct_toBranchId_fkey` (`toBranchId`),
  CONSTRAINT `TransferedProduct_branchProductId_fkey` FOREIGN KEY (`branchProductId`) REFERENCES `branchproduct` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `TransferedProduct_fromBranchId_fkey` FOREIGN KEY (`fromBranchId`) REFERENCES `branch` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `TransferedProduct_toBranchId_fkey` FOREIGN KEY (`toBranchId`) REFERENCES `branch` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transferedproduct`
--

LOCK TABLES `transferedproduct` WRITE;
/*!40000 ALTER TABLE `transferedproduct` DISABLE KEYS */;
/*!40000 ALTER TABLE `transferedproduct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('ADMIN','SELLER','STORE_KEEPER','VENDOR') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'SELLER',
  `isStaff` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branchId` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `User_username_key` (`username`),
  KEY `User_branchId_fkey` (`branchId`),
  CONSTRAINT `User_branchId_fkey` FOREIGN KEY (`branchId`) REFERENCES `branch` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('0930b851-2701-4ef3-a463-97e4d91a2962','Zia Woodward','mexyvyvy','VENDOR',1,'Anim impedit invent',1),('13f10f65-022b-45d4-bdbd-e8fc95be2061','BiNab','Sojohn','SELLER',1,'Ea eos quis deserunt',2),('264c7e45-cc7b-4d87-ad4a-133f63636259','Logan Bullock','muwajujul','STORE_KEEPER',1,'Saepe similique solu',1),('2d73c63c-2be7-430a-925f-30242fd985c2','Brett Ferguson','zodepelece','STORE_KEEPER',1,'Commodi quod ut ut d',3),('364ebc84-2680-4d3a-aa49-66592163d14c','Candace Rodriguez','jerel','STORE_KEEPER',1,'Est quis accusamus ',1),('3ea9cab7-b7b3-43d7-af01-8b141c326b4e','Buffy Molina','mymaji','SELLER',1,'Amet ad obcaecati e',2),('527cb4db-d980-4626-8fa0-607ca82d2ebc','alkado sihone','alkadohs','ADMIN',1,'$2y$12$6OeEZV6WWhtOInhIhrIXWued/m722gAqOkT.2WqZXaJeNoATDk6fa',2),('5851a269-5b0e-4254-92fa-742343c4f5a9','kilan','kilan','VENDOR',1,'1234',3),('5ec0a791-f262-44f1-8a43-567646eaa490','Hadassah Kramer','gofulih','VENDOR',1,'R90m',3),('5f84963a-981e-4e59-a4d1-686183d1ea2e','Miriana','Miss','SELLER',1,'1234',1),('727d5864-07dd-4f6e-9046-1dc8aa13aaa7','alkado sichone','kado2','VENDOR',1,'1234',2),('84aaec05-cda3-4c48-bb48-03a941280712','Ninan anahah','Michael','ADMIN',1,'$2y$12$qfDyQuwNvINpNY4aOFEHYeSiVCX1pYcxsBnPE7vB/bXRkm./EReRy',2),('fe803237-6ba0-4076-8a9f-c57713915938','minanah baha','mimi','SELLER',1,'$2y$12$5fAwRaFbz97CcFGtI5rbXeo4eqU0/vcwB1sLAwj3WDEZHq..5MBXK',2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendorproduct`
--

DROP TABLE IF EXISTS `vendorproduct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendorproduct` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branchProductId` int NOT NULL,
  `branchId` int NOT NULL,
  `userId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
  PRIMARY KEY (`id`),
  KEY `VendorProduct_branchProductId_fkey` (`branchProductId`),
  KEY `VendorProduct_branchId_fkey` (`branchId`),
  KEY `VendorProduct_userId_fkey` (`userId`),
  CONSTRAINT `VendorProduct_branchId_fkey` FOREIGN KEY (`branchId`) REFERENCES `branch` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `VendorProduct_branchProductId_fkey` FOREIGN KEY (`branchProductId`) REFERENCES `branchproduct` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `VendorProduct_userId_fkey` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendorproduct`
--

LOCK TABLES `vendorproduct` WRITE;
/*!40000 ALTER TABLE `vendorproduct` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendorproduct` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-04 10:03:47
