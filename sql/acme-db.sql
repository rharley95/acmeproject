-- Host: localhost
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `acme`
-- --------------------------------------------------------

--
-- Table structure for table `inventory`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `invId` int(11) UNSIGNED NOT NULL,
  `invName` varchar(50) NOT NULL DEFAULT '',
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL DEFAULT '',
  `invThumbnail` varchar(50) NOT NULL DEFAULT '',
  `invPrice` decimal(10,0) NOT NULL DEFAULT '0',
  `invStock` smallint(6) NOT NULL DEFAULT '0',
  `invSize` smallint(6) NOT NULL DEFAULT '0',
  `invWeight` smallint(6) NOT NULL DEFAULT '0',
  `invLocation` varchar(35) NOT NULL DEFAULT '',
  `categoryId` int(10) UNSIGNED NOT NULL,
  `invVendor` varchar(20) NOT NULL DEFAULT '',
  `invStyle` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Acme Inc. Inventory Table';

--
-- Dumping data for table `inventory`
-- --------------------------------------------------------

INSERT INTO `inventory` (`invId`, `invName`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invSize`, `invWeight`, `invLocation`, `categoryId`, `invVendor`, `invStyle`) VALUES
(2, 'Back-mounted Rocket', 'Rocket for multiple purposes. This can be launched independently to deliver a payload or strapped on to help get you to where you want to be FAST!!! Really Fast!', '/acme/images/rocket.gif', '/acme/images/tn_rocket.gif', '1320', 5, 60, 90, 'California', 4, 'Goddard', 'metal'),
(3, 'Mortar', 'Our Mortar is very powerful. This cannon can launch a projectile or bomb 3 miles. Made of solid steel and mounted on cement or metal stands [not included].', '/acme/images/mortar.gif', '/acme/images/tn_mortar.gif', '1500', 26, 250, 750, 'San Jose', 1, 'Smith & Wesson', 'Metal'),
(4, 'Catapult', 'Our best wooden catapult. Ideal for hurling objects for up to 1000 yards. Payloads of up to 300 lbs.', '/acme/images/catapult.gif', '/acme/images/tn_catapult.gif', '2500', 4, 1569, 400, 'Cedar Point, IO', 1, 'Wooden Creations', 'Wood'),
(5, 'Female RoadRuner Cutout', 'This carbon fiber backed cutout of a female roadrunner is sure to catch the eye of any male roadrunner.', '/acme/images/roadrunner.jpg', '/acme/images/tn_roadrunner.jpg', '20', 500, 27, 2, 'San Jose', 5, 'Picture Perfect', 'Carbon Fiber'),
(6, 'Giant Mouse Trap', 'Our big mouse trap. This trap is multifunctional. It can be used to catch dogs, mountain lions, road runners or even muskrats. Must be staked for larger varmints [stakes not included] and baited with approptiate bait [sold seperately].\r\n', '/acme/images/trap.gif', '/acme/images/tn_trap.gif', '20', 34, 470, 28, 'Cedar Point, IO', 5, 'Rodent Control', 'Wood'),
(7, 'Instant Hole', 'Instant hole - Wonderful for creating the appearance of openings.', '/acme/images/black_circle.gif', '/acme/images/tn_black_circle.gif', '25', 269, 24, 2, 'San Jose', 3, 'Hidden Valley', 'Ether'),
(8, 'Koenigsegg CCX', 'This high performance car is sure to get you where you are going fast. It holds the production car land speed record at an amazing 250mph.', '/acme/images/ccxcar.jpg', '/acme/images/tn_ccxcar.jpg', '500000', 1, 25000, 3000, 'San Jose', 3, 'Koenigsegg', 'Metal'),
(9, 'Large Anvil', '50 lb. Anvil - perfect for any task requireing lots of weight. Made of solid, tempered steel.', '/acme/images/anvil.gif', '/acme/images/tn_anvil.gif', '150', 15, 80, 50, 'San Jose', 5, 'Steel Made', 'Metal'),
(10, 'Medium Anvil', 'This solid iron 35 lb. anvil is sure to crush anything under it and provide a solid surface for all metal on it.', '/acme/images/anvil.jpg', '/acme/images/tn_anvil.jpg', '65', 5000, 60, 35, 'San Jose', 5, 'Steel Made', 'Metal'),
(11, 'Monster Rubber Band', 'These are not tiny rubber bands. These are MONSTERS! These bands can stop a train locamotive or be used as a slingshot for cows. Only the best materials are used!', '/acme/images/rubberband.gif', '/acme/images/tn_rubberband.gif', '4', 4589, 75, 1, 'Cedar Point, IO', 3, 'Rubbermaid', 'Rubber'),
(12, 'Mallet', 'Ten pound mallet for bonking roadrunners on the head. Can also be used for bunny rabbits.', '/acme/images/mallet.gif', '/acme/images/tn_mallet.gif', '25', 100, 36, 10, 'Cedar Point, IA', 3, 'Wooden Creations', 'Wood'),
(13, 'TNT', 'The biggest bang for your buck with our nitro-based TNT. Price is per stick.', '/acme/images/tnt.jpg', '/acme/images/tn_tnt.jpg', '10', 1000, 25, 2, 'San Jose', 2, 'Nobel Enterprises', 'Plastic'),
(14, 'Roadrunner Custom Bird Seed Mix', 'Our best varmint seed mix - varmints on two or four legs can''t resist this mix. Contains meat, nuts, cereals and our own special ingredient. Guaranteed to bring them in. Can be used with our monster trap.', '/acme/images/seed.jpg', '/acme/images/tn_seed.jpg', '8', 150, 24, 3, 'San Jose', 5, 'Acme', 'Plastic'),
(15, 'Grand Piano', 'This upright grand piano is guaranteed to play well and smash anything beneath it if dropped from a height.', '/acme/images/upright.gif', '/acme/images/tn_upright.gif', '3500', 36, 500, 1200, 'Cedar Point, IA', 3, 'Wulitzer', 'Wood'),
(16, 'Crash Helmet', 'This carbon fiber and plastic helmet is the ultimate in protection for your head. comes in assorted colors.', '/acme/images/helmet.gif', '/acme/images/tn_helmet.gif', '100', 25, 48, 9, 'San Jose', 3, 'Suzuki', 'Carbon Fiber'),
(17, 'Nylon Rope', 'This nylon rope is ideal for all uses. Each rope is the highest quality nylon and comes in 100 foot lengths.', '/acme/images/nylon.gif', '/acme/images/tn_nylon.gif', '15', 200, 200, 6, 'San Jose', 3, 'Marina Sales', 'Nylon'),
(18, 'Sticky Fence', 'This fence is covered with Gorilla Glue and is guaranteed to stick to anything that touches it and is sure to hold it tight.', '/acme/images/stickyfence.jpg', '/acme/images/tn_stickyfence.jpg', '75', 15, 48, 2, 'San Jose', 3, 'Acme', 'Nylon'),
(19, 'Small Bomb', 'Bomb with a fuse - A little old fashioned, but highly effective. This bomb has the ability to devistate anything within 30 feet.', '/acme/images/bomb.gif', '/acme/images/tn_bomb.gif', '275', 58, 30, 12, 'San Jose', 2, 'Nobel Enterprises', 'Metal');

--
-- Table structure for table `categories`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `categoryId` int(10) UNSIGNED NOT NULL,
  `categoryName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Category classifications of inventory items';

--
-- Data for table `categories`
-- --------------------------------------------------------

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Cannon'),
(2, 'Explosive'),
(3, 'Misc'),
(4, 'Rocket'),
(5, 'Trap');
-- --------------------------------------------------------

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `categoryId` (`categoryId`);


--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

-- ---------------------------------------------
-- Clients Table
--

--
-- Table structure for table `clients`
-- --------------------------------------------------------

 DROP TABLE IF EXISTS `clients`;
 CREATE TABLE `clients` (
   `clientId` int(10) UNSIGNED NOT NULL,
   `clientFirstname` varchar(15) NOT NULL,
   `clientLastname` varchar(25) NOT NULL,
   `clientEmail` varchar(40) NOT NULL,
   `clientPassword` varchar(255) NOT NULL,
   `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
   `comments` text NOT NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `clients`
-- --------------------------------------------------------
 ALTER TABLE `clients`
   ADD PRIMARY KEY (`clientId`);
  
--
-- AUTO_INCREMENT for table `clients`
-- --------------------------------------------------------
 ALTER TABLE `clients`
   MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
