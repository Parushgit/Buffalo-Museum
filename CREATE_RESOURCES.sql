CREATE TABLE `Resources` (
  `id` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `value` varchar(2000) DEFAULT NULL,
  `seq` int(11) DEFAULT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `ref_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
