

CREATE USER 'admin'@'localhost' IDENTIFIED WITH mysql_native_password BY 'toor';
GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' WITH GRANT OPTION;
CREATE USER 'admin'@'%' IDENTIFIED WITH mysql_native_password BY 'toor';

GRANT ALL PRIVILEGES ON *.* TO 'admin'@'%' WITH GRANT OPTION;
GRANT ALL ON `newsletter2go_voucher_api_test`.* TO 'admin'@'%' ;
FLUSH PRIVILEGES ;






DROP DATABASE IF EXISTS `newsletter2go_voucher_api_test`;
CREATE DATABASE IF NOT EXISTS  `newsletter2go_voucher_api_test` CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `newsletter2go_voucher_api_test`;





CREATE TABLE IF NOT EXISTS `tasks` (
   `id` int(11) NOT NULL,
   `task` varchar(200) NOT NULL,
   `status` tinyint(1) NOT NULL DEFAULT '1',
   `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tasks` ADD PRIMARY KEY (`id`);
ALTER TABLE `tasks` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `tasks` (`id`, `task`, `status`, `created_at`) VALUES
 (1, 'Find bugs', 1, '2016-04-10 23:50:40'),
 (2, 'Review code', 1, '2016-04-10 23:50:40'),
 (3, 'Fix bugs', 1, '2016-04-10 23:50:40'),
 (4, 'Refactor Code', 1, '2016-04-10 23:50:40'),
 (5, 'Push to prod', 1, '2016-04-10 23:50:50');




DROP TABLE IF EXISTS `recipients`;
CREATE TABLE IF NOT EXISTS `recipients` (
  `recipient_id` int(10) NOT NULL auto_increment,
  `recipient_name` varchar(50) default NULL,
  `recipient_email` varchar(50) default NULL UNIQUE,
  PRIMARY KEY  (`recipient_id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;



INSERT INTO `recipients` (`recipient_id`, `recipient_name`, `recipient_email`) VALUES
(1, 'John', 'john@john.de'),
(2, 'Mary', 'mary@mary.de'),
(3, 'Jane', 'jane@jane.de'),
(4, 'Viktoria', 'viktoria@viktoria.de');


DROP TABLE IF EXISTS `special_offers`;
CREATE TABLE IF NOT EXISTS `special_offers` (
  `special_offer_id` int(10) NOT NULL auto_increment,
  `special_offer_name` varchar(50) default NULL,
  `special_offer_fixed_percentage_discount` DECIMAL(6,4) NOT NULL,
  PRIMARY KEY  (`special_offer_id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


INSERT INTO `special_offers` (`special_offer_id`, `special_offer_name`, `special_offer_fixed_percentage_discount`) VALUES
(1, '2 x Burguer', 0.50),
(2, 'Pizza + Soda', 0.20),
(3, 'Newsletter + Pizza', 0.10),
(4, 'Free Month', 1.0);

DROP TABLE IF EXISTS `voucher_codes`;

CREATE TABLE IF NOT EXISTS `voucher_codes` (
 `voucher_id` binary(16) NOT NULL,
 `voucher_uuid` varchar(36) generated always as
  (
   insert(
     insert(
       insert(
         insert(
           hex(
             concat(substr(voucher_id,5,4),substr(voucher_id,3,2),
                    substr(voucher_id,1,2),substr(voucher_id,9,8))
           ),
           9,0,'-'),
       14,0,'-'),
     19,0,'-'),
   24,0,'-')
  ) virtual,
  `recipient_link` int(10) default NULL,
  `special_offer_link` int(10) default NULL,
  `voucher_expiration_date` datetime NOT NULL,
  `voucher_usage_date` datetime default NULL,
  `voucher_used` TINYINT(1) default 0,
  `recipient_email` varchar(50) default NULL UNIQUE,
  PRIMARY KEY  (`voucher_id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

set @u = unhex(replace(uuid(),'-',''));

INSERT INTO `voucher_codes` (`voucher_id`, `recipient_link`, `special_offer_link`, `voucher_expiration_date`, `voucher_usage_date`, `voucher_used`, `recipient_email` ) VALUES
(concat(  substr(@u, 7, 2), substr(@u, 5, 2), substr(@u, 1, 4), substr(@u, 9, 8)), 1, 1, '2016-04-10 23:50:40', NULL, 0, 'john@john.de');

set @u = unhex(replace(uuid(),'-',''));

INSERT INTO `voucher_codes` (`voucher_id`, `recipient_link`, `special_offer_link`, `voucher_expiration_date`, `voucher_usage_date`, `voucher_used`, `recipient_email` ) VALUES
(concat(  substr(@u, 7, 2), substr(@u, 5, 2), substr(@u, 1, 4), substr(@u, 9, 8)), 1, 2, '2019-01-10 23:50:40', NULL, 0, 'john@john.de');

set @u = unhex(replace(uuid(),'-',''));

INSERT INTO `voucher_codes` (`voucher_id`, `recipient_link`, `special_offer_link`, `voucher_expiration_date`, `voucher_usage_date`, `voucher_used`, `recipient_email` ) VALUES
(concat(  substr(@u, 7, 2), substr(@u, 5, 2), substr(@u, 1, 4), substr(@u, 9, 8)), 2, 1, '2019-04-10 23:50:40', NULL, 0, 'mary@mar.de');

set @u = unhex(replace(uuid(),'-',''));

INSERT INTO `voucher_codes` (`voucher_id`, `recipient_link`, `special_offer_link`, `voucher_expiration_date`, `voucher_usage_date`, `voucher_used`, `recipient_email` ) VALUES
(concat(  substr(@u, 7, 2), substr(@u, 5, 2), substr(@u, 1, 4), substr(@u, 9, 8)), 3, 3, '2019-04-10 23:50:40', NULL, 0, 'jane@jane.de');

set @u = unhex(replace(uuid(),'-',''));

INSERT INTO `voucher_codes` (`voucher_id`, `recipient_link`, `special_offer_link`, `voucher_expiration_date`, `voucher_usage_date`, `voucher_used`, `recipient_email` ) VALUES
(concat(  substr(@u, 7, 2), substr(@u, 5, 2), substr(@u, 1, 4), substr(@u, 9, 8)), 4, 4, '2019-04-10 23:50:40', NULL, 0, 'viktoria@viktoria.de');


select voucher_id, hex(voucher_id), recipient_link, voucher_uuid from voucher_codes;

select * from voucher_codes;