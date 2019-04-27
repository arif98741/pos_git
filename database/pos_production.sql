-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2019 at 11:21 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_production`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `customer_balance`
-- (See below for the actual view)
--
CREATE TABLE `customer_balance` (
`customer_id` varchar(100)
,`balance` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `customer_balancesheet`
-- (See below for the actual view)
--
CREATE TABLE `customer_balancesheet` (
`date` timestamp
,`Ref` varchar(20)
,`Customer` varchar(100)
,`Drescription` varchar(13)
,`Debit` double(13,2)
,`Credit` float
,`Balance` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `customer_statement`
-- (See below for the actual view)
--
CREATE TABLE `customer_statement` (
`sell_id` varchar(20)
,`customer_id` varchar(100)
,`date` timestamp
,`payable` double(13,2)
,`paid` float
,`Drescription` varchar(13)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `net_stock`
-- (See below for the actual view)
--
CREATE TABLE `net_stock` (
`product_id` varchar(15)
,`product_type` int(11)
,`product_group` int(11)
,`product_name` varchar(250)
,`stock` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `serial` int(6) NOT NULL,
  `customer_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `receiver` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `method` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `amount` float(8,2) DEFAULT NULL,
  `current_bal` float(8,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `profit`
-- (See below for the actual view)
--
CREATE TABLE `profit` (
`date` timestamp
,`sell_id` varchar(20)
,`customer_name` varchar(100)
,`product_id` int(11)
,`name` varchar(255)
,`profit` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `profit_report`
-- (See below for the actual view)
--
CREATE TABLE `profit_report` (
`sell_id` varchar(20)
,`seller` int(11)
,`customer_id` varchar(10)
,`customer_name` varchar(100)
,`product_id` int(11)
,`quantity` decimal(32,0)
,`purchase_price` double(8,2)
,`unit_price` double
,`date` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `stock`
-- (See below for the actual view)
--
CREATE TABLE `stock` (
`product_id` varchar(15)
,`pquantity` decimal(32,0)
,`squantity` decimal(32,0)
,`stock` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `supplier_statement`
-- (See below for the actual view)
--
CREATE TABLE `supplier_statement` (
`date` timestamp
,`supplier` int(11)
,`Drescription` varchar(255)
,`Debit` float(10,2)
,`Credit` float(10,2)
,`Balance` double(19,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accesslog`
--

CREATE TABLE `tbl_accesslog` (
  `id` int(5) NOT NULL,
  `ip` varchar(33) DEFAULT NULL,
  `user` varchar(30) DEFAULT NULL,
  `pass` varchar(35) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_accesslog`
--

INSERT INTO `tbl_accesslog` (`id`, `ip`, `user`, `pass`, `date`) VALUES
(330, '::1', 'admin', 'aDMIN', '2019-04-01 19:17:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandid` int(11) NOT NULL,
  `brandname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_color`
--

CREATE TABLE `tbl_color` (
  `colorid` int(11) NOT NULL,
  `colorname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `serial` int(11) NOT NULL,
  `customer_id` varchar(10) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `email` varchar(80) NOT NULL,
  `opening_balance` int(11) NOT NULL,
  `due` float(8,2) NOT NULL,
  `paid_limit` float(8,2) DEFAULT NULL,
  `remark` varchar(100) NOT NULL,
  `discount` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateby` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`serial`, `customer_id`, `customer_name`, `address`, `contact_no`, `email`, `opening_balance`, `due`, `paid_limit`, `remark`, `discount`, `date`, `updateby`) VALUES
(1, '1250', 'Ariful Islam', 'Dhaka, Bangladesh', '01750840217', 'arif@gmail.com', 27750, 15250.00, 20000.00, 'Good', 0, '2019-04-27 20:55:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

CREATE TABLE `tbl_group` (
  `groupid` int(11) NOT NULL,
  `groupname` varchar(50) NOT NULL,
  `updateby` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_group`
--

INSERT INTO `tbl_group` (`groupid`, `groupname`, `updateby`) VALUES
(1, 'Book', NULL),
(2, 'Garments', NULL),
(3, 'T-shirt', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `serial` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `carton` int(11) NOT NULL,
  `piece` int(11) NOT NULL,
  `purchase` int(6) NOT NULL,
  `subtotal` float(10,2) NOT NULL,
  `total` float(10,2) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `updateby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`serial`, `invoice_number`, `supplier_id`, `quantity`, `carton`, `piece`, `purchase`, `subtotal`, `total`, `date`, `status`, `updateby`) VALUES
(1, '20190001', 125, 5, 0, 0, 460, 1150.00, 1150.00, '2019-04-17', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_products`
--

CREATE TABLE `tbl_invoice_products` (
  `serial_no` int(11) NOT NULL,
  `invoice_id` varchar(20) NOT NULL,
  `product_id` varchar(15) NOT NULL,
  `quantity` int(11) NOT NULL,
  `carton` int(11) NOT NULL,
  `piece` double NOT NULL,
  `purchase` float(10,2) NOT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  `subtotal` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice_products`
--

INSERT INTO `tbl_invoice_products` (`serial_no`, `invoice_id`, `product_id`, `quantity`, `carton`, `piece`, `purchase`, `updateby`, `subtotal`) VALUES
(1, '20190001', '222', 3, 0, 0, 230.00, '1', 690.00),
(2, '20190001', '222', 2, 0, 0, 230.00, '1', 460.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laser`
--

CREATE TABLE `tbl_laser` (
  `serial` int(6) NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `debit` float(8,2) DEFAULT '0.00',
  `credit` float(8,2) DEFAULT '0.00',
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updateby` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_laser`
--

INSERT INTO `tbl_laser` (`serial`, `category`, `debit`, `credit`, `description`, `updateby`, `date`) VALUES
(1, '1', 2500.00, 0.00, 'Something is better', '1', '2019-03-30 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `serial` int(11) NOT NULL,
  `product_id` varchar(15) NOT NULL,
  `product_type` int(11) NOT NULL,
  `product_group` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_brand` int(11) NOT NULL,
  `size_h` int(4) NOT NULL,
  `size_w` int(4) NOT NULL,
  `color` varchar(10) NOT NULL,
  `sale_price` double NOT NULL DEFAULT '0',
  `purchase_price` double NOT NULL DEFAULT '0',
  `wholesale_price` float(10,2) DEFAULT NULL,
  `piece_in_a_carton` int(11) DEFAULT NULL,
  `stock_limit` varchar(10) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`serial`, `product_id`, `product_type`, `product_group`, `product_name`, `product_brand`, `size_h`, `size_w`, `color`, `sale_price`, `purchase_price`, `wholesale_price`, `piece_in_a_carton`, `stock_limit`, `last_update`, `updateby`) VALUES
(1, '125', 2, 1, 'Kazim IT', 125, 0, 0, '', 250, 200, NULL, 25, '', '2019-04-01 19:58:22', 1),
(2, '112', 0, 2, 'Akbor Steel', 125, 0, 0, '', 360, 300, NULL, 12, '', '2019-04-01 19:58:44', 1),
(3, '222', 2, 1, 'Google Addition Something', 125, 0, 0, '', 2500, 230, 150.00, 25, '15', '2019-04-27 20:52:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sell`
--

CREATE TABLE `tbl_sell` (
  `serial` int(11) NOT NULL,
  `sell_id` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `seller` int(11) NOT NULL,
  `sub_total` float NOT NULL,
  `dlcharge` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `vat` int(11) NOT NULL,
  `grand_total` float NOT NULL,
  `paid` float NOT NULL,
  `payable` float(10,2) NOT NULL,
  `due` float NOT NULL,
  `previous_balance` float(8,2) NOT NULL,
  `status` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sell`
--

INSERT INTO `tbl_sell` (`serial`, `sell_id`, `customer_id`, `seller`, `sub_total`, `dlcharge`, `discount`, `vat`, `grand_total`, `paid`, `payable`, `due`, `previous_balance`, `status`, `date`, `updateby`) VALUES
(1, '1904280001', 1250, 1, 16250, 0, 0, 0, 16250, 1000, 16250.00, 15250, 12500.00, 0, '2019-04-27 21:06:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sell_products`
--

CREATE TABLE `tbl_sell_products` (
  `serial_no` int(11) NOT NULL,
  `sell_id` varchar(20) NOT NULL,
  `product_serial` varchar(10) DEFAULT NULL,
  `customer_id` int(5) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `product_piece` int(5) DEFAULT NULL,
  `unit_price` double NOT NULL,
  `purchase_price` double(8,2) NOT NULL,
  `discount` varchar(5) NOT NULL DEFAULT 'null',
  `warranty_expire` date DEFAULT NULL,
  `subtotal` double NOT NULL,
  `updateby` varchar(10) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sell_products`
--

INSERT INTO `tbl_sell_products` (`serial_no`, `sell_id`, `product_serial`, `customer_id`, `product_id`, `quantity`, `product_piece`, `unit_price`, `purchase_price`, `discount`, `warranty_expire`, `subtotal`, `updateby`, `status`) VALUES
(1, '1904280001', '65', 1250, 125, 5, NULL, 250, 200.00, 'null', '2019-05-05', 1250, '1', 1),
(2, '1904280001', '456', 1250, 222, 6, NULL, 2500, 230.00, 'null', '2019-06-12', 15000, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `serial` int(11) NOT NULL,
  `supplier_id` varchar(10) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `opening_balance` float NOT NULL,
  `remark` varchar(80) NOT NULL,
  `updateby` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`serial`, `supplier_id`, `supplier_name`, `address`, `contact_no`, `email`, `contact_person`, `opening_balance`, `remark`, `updateby`) VALUES
(1, '125', 'Azizul Hakim', 'Dhaka, bangladesh', '01750840217', 'azizul@gmail.com', 'Aziz', 0, 'Good', 1),
(2, '112', 'Shamim Al-Deen', 'Elenga, Tangail', '01754051776', 'shamimaldeen@gmail.com', 'Shamim', 0, 'bad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier_transaction`
--

CREATE TABLE `tbl_supplier_transaction` (
  `id` int(11) NOT NULL,
  `supplier` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `purchase` float(10,2) DEFAULT NULL,
  `payment` float(10,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactioncat`
--

CREATE TABLE `tbl_transactioncat` (
  `id` int(5) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_type` varchar(50) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updateby` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transactioncat`
--

INSERT INTO `tbl_transactioncat` (`id`, `category_name`, `category_type`, `last_update`, `updateby`) VALUES
(1, 'Electrict Bill', 'Debit', '2019-04-27 21:07:22', '1'),
(2, 'Gas bill', 'Debit', '2019-04-27 21:07:30', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `typeid` int(11) NOT NULL,
  `typename` varchar(255) NOT NULL,
  `updateby` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`typeid`, `typename`, `updateby`) VALUES
(1, 'KG', NULL),
(2, 'Feet', NULL),
(3, 'Liter', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'stuff',
  `company_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL DEFAULT 'uploads/logo_1.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `password`, `name`, `email`, `status`, `company_name`, `address`, `logo`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Hasan Ali', 'admin@gmail.com', 'admin', 'HAPPY PRODUCTS', 'Dighapatia Bazar, Natore, Mobile: 01751001326', 'uploads/logo_1.png'),
(8, 'Happy', '6b6ab521cb9bcced96aad441f3adea5f', 'Happy', 'happyproduct123@gmail.com', 'stuff', 'HAPPY PRODUCTS', 'Dighapatia Bazar, Natore, Mobile: 01751001326', 'uploads/logo_1.png');

-- --------------------------------------------------------

--
-- Stand-in structure for view `tpurchase`
-- (See below for the actual view)
--
CREATE TABLE `tpurchase` (
`product_id` varchar(15)
,`pquantity` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tsold`
-- (See below for the actual view)
--
CREATE TABLE `tsold` (
`product_id` int(11)
,`squantity` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Structure for view `customer_balance`
--
DROP TABLE IF EXISTS `customer_balance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `customer_balance`  AS  select `customer_statement`.`customer_id` AS `customer_id`,sum((`customer_statement`.`payable` - `customer_statement`.`paid`)) AS `balance` from `customer_statement` group by `customer_statement`.`customer_id` ;

-- --------------------------------------------------------

--
-- Structure for view `customer_balancesheet`
--
DROP TABLE IF EXISTS `customer_balancesheet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `customer_balancesheet`  AS  select `t1`.`date` AS `date`,`t1`.`sell_id` AS `Ref`,`t1`.`customer_id` AS `Customer`,`t1`.`Drescription` AS `Drescription`,`t1`.`payable` AS `Debit`,`t1`.`paid` AS `Credit`,(select sum((`customer_statement`.`payable` - `customer_statement`.`paid`)) AS `Balance` from `customer_statement` where ((`customer_statement`.`customer_id` = `t1`.`customer_id`) and (`customer_statement`.`date` <= `t1`.`date`))) AS `Balance` from `customer_statement` `t1` order by `t1`.`date` ;

-- --------------------------------------------------------

--
-- Structure for view `customer_statement`
--
DROP TABLE IF EXISTS `customer_statement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `customer_statement`  AS  select `tbl_sell`.`sell_id` AS `sell_id`,`tbl_sell`.`customer_id` AS `customer_id`,`tbl_sell`.`date` AS `date`,`tbl_sell`.`payable` AS `payable`,`tbl_sell`.`paid` AS `paid`,'Sales Invoice' AS `Drescription` from `tbl_sell` union select `tbl_customer`.`serial` AS `serial`,`tbl_customer`.`customer_id` AS `customer_id`,`tbl_customer`.`date` AS `date`,`tbl_customer`.`opening_balance` AS `opening_balance`,0 AS `0`,'Opening' AS `Opening` from `tbl_customer` union select `payment`.`serial` AS `serial`,`payment`.`customer_id` AS `customer_id`,`payment`.`date` AS `date`,0 AS `0`,`payment`.`amount` AS `amount`,'Payment' AS `Payment` from `payment` ;

-- --------------------------------------------------------

--
-- Structure for view `net_stock`
--
DROP TABLE IF EXISTS `net_stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `net_stock`  AS  select `tbl_product`.`product_id` AS `product_id`,`tbl_product`.`product_type` AS `product_type`,`tbl_product`.`product_group` AS `product_group`,`tbl_product`.`product_name` AS `product_name`,`stock`.`stock` AS `stock` from (`tbl_product` join `stock` on((convert(`tbl_product`.`product_id` using utf8) = convert(`stock`.`product_id` using utf8)))) ;

-- --------------------------------------------------------

--
-- Structure for view `profit`
--
DROP TABLE IF EXISTS `profit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profit`  AS  select `pr`.`date` AS `date`,`pr`.`sell_id` AS `sell_id`,`pr`.`customer_name` AS `customer_name`,`pr`.`product_id` AS `product_id`,`tu`.`name` AS `name`,((`pr`.`unit_price` * `pr`.`quantity`) - (`pr`.`purchase_price` * `pr`.`quantity`)) AS `profit` from (`profit_report` `pr` join `tbl_user` `tu` on((`pr`.`seller` = `tu`.`userid`))) group by `pr`.`sell_id` ;

-- --------------------------------------------------------

--
-- Structure for view `profit_report`
--
DROP TABLE IF EXISTS `profit_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profit_report`  AS  select `tsp`.`sell_id` AS `sell_id`,`ts`.`seller` AS `seller`,`tc`.`customer_id` AS `customer_id`,`tc`.`customer_name` AS `customer_name`,`tsp`.`product_id` AS `product_id`,sum(`tsp`.`quantity`) AS `quantity`,`tsp`.`purchase_price` AS `purchase_price`,`tsp`.`unit_price` AS `unit_price`,`ts`.`date` AS `date` from ((`tbl_sell_products` `tsp` join `tbl_customer` `tc` on((`tc`.`customer_id` = `tsp`.`customer_id`))) join `tbl_sell` `ts` on((`tsp`.`sell_id` = `ts`.`sell_id`))) where (`tsp`.`status` = '1') group by `tsp`.`sell_id`,`tsp`.`product_id` ;

-- --------------------------------------------------------

--
-- Structure for view `stock`
--
DROP TABLE IF EXISTS `stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stock`  AS  select `tpurchase`.`product_id` AS `product_id`,`tpurchase`.`pquantity` AS `pquantity`,`tsold`.`squantity` AS `squantity`,(`tpurchase`.`pquantity` - ifnull(`tsold`.`squantity`,0)) AS `stock` from (`tpurchase` left join `tsold` on((`tpurchase`.`product_id` = `tsold`.`product_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `supplier_statement`
--
DROP TABLE IF EXISTS `supplier_statement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `supplier_statement`  AS  select `t1`.`date` AS `date`,`t1`.`supplier` AS `supplier`,`t1`.`description` AS `Drescription`,`t1`.`purchase` AS `Debit`,`t1`.`payment` AS `Credit`,(select sum((`tbl_supplier_transaction`.`purchase` - `tbl_supplier_transaction`.`payment`)) AS `Balance` from `tbl_supplier_transaction` where ((`tbl_supplier_transaction`.`supplier` = `t1`.`supplier`) and (`tbl_supplier_transaction`.`date` <= `t1`.`date`))) AS `Balance` from `tbl_supplier_transaction` `t1` order by `t1`.`date` ;

-- --------------------------------------------------------

--
-- Structure for view `tpurchase`
--
DROP TABLE IF EXISTS `tpurchase`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tpurchase`  AS  select `tbl_invoice_products`.`product_id` AS `product_id`,sum(`tbl_invoice_products`.`quantity`) AS `pquantity` from `tbl_invoice_products` group by `tbl_invoice_products`.`product_id` ;

-- --------------------------------------------------------

--
-- Structure for view `tsold`
--
DROP TABLE IF EXISTS `tsold`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tsold`  AS  select `tbl_sell_products`.`product_id` AS `product_id`,sum(`tbl_sell_products`.`quantity`) AS `squantity` from `tbl_sell_products` group by `tbl_sell_products`.`product_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_accesslog`
--
ALTER TABLE `tbl_accesslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandid`);

--
-- Indexes for table `tbl_color`
--
ALTER TABLE `tbl_color`
  ADD PRIMARY KEY (`colorid`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_group`
--
ALTER TABLE `tbl_group`
  ADD PRIMARY KEY (`groupid`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_invoice_products`
--
ALTER TABLE `tbl_invoice_products`
  ADD PRIMARY KEY (`serial_no`);

--
-- Indexes for table `tbl_laser`
--
ALTER TABLE `tbl_laser`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_sell`
--
ALTER TABLE `tbl_sell`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_sell_products`
--
ALTER TABLE `tbl_sell_products`
  ADD PRIMARY KEY (`serial_no`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_supplier_transaction`
--
ALTER TABLE `tbl_supplier_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transactioncat`
--
ALTER TABLE `tbl_transactioncat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`typeid`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `serial` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_accesslog`
--
ALTER TABLE `tbl_accesslog`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `colorid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_group`
--
ALTER TABLE `tbl_group`
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_invoice_products`
--
ALTER TABLE `tbl_invoice_products`
  MODIFY `serial_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_laser`
--
ALTER TABLE `tbl_laser`
  MODIFY `serial` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_sell`
--
ALTER TABLE `tbl_sell`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_sell_products`
--
ALTER TABLE `tbl_sell_products`
  MODIFY `serial_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_supplier_transaction`
--
ALTER TABLE `tbl_supplier_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transactioncat`
--
ALTER TABLE `tbl_transactioncat`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `typeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
