<?php

$installer = $this;
$installer->startSetup();
$installer->run("
    CREATE TABLE IF NOT EXISTS `{$installer->getTable('stbadges/badge')}` (
        `badge_id` INT(10) unsigned NOT NULL auto_increment,
        `title` VARCHAR(128),
        `description` text,
        `icon_path` text,
        `trigger_purchase_amount` INT(10),
        PRIMARY KEY (`badge_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    INSERT IGNORE INTO `{$installer->getTable('stbadges/badge')}` (`badge_id`, `title`, `description`, `icon_path`, `trigger_purchase_amount`) VALUES (1, 'Bronze', 'Congratulations, you\'ve earned bronze status by spending more than $100!', 'stbadges/badges/bronze.png', 100), (2, 'Silver', 'Congratulations, you\'ve earned silver status by spending more than $500!', 'stbadges/badges/silver.png', 500), (3, 'Gold', 'Congratulations, you\'ve earned gold status by spending more than $1,000!', 'stbadges/badges/gold.png', 1000);

    CREATE TABLE IF NOT EXISTS `{$installer->getTable('stbadges/badgecustomer')}` (
        `badge_customer_id` INT(10) unsigned NOT NULL auto_increment,
        `customer_id` INT(10) unsigned NOT NULL,
        `badge_id` INT(10) unsigned NOT NULL,
        `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
        PRIMARY KEY (`badge_customer_id`),
        UNIQUE KEY `customer_id_unique` (`customer_id`),
        CONSTRAINT `badge_id_to_customer_fk`
            FOREIGN KEY (`badge_id`) REFERENCES `{$this->getTable('stbadges/badge')}` (`badge_id`) ON DELETE CASCADE,
        CONSTRAINT `customer_id_fk` 
            FOREIGN KEY (`customer_id`) REFERENCES `{$this->getTable('customer_entity')}` (`entity_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
$installer->endSetup();
