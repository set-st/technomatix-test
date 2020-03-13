<?php

class m200312_175312_storage_tables extends CDbMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `goods` (
	`id` INT(12) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(256) NULL DEFAULT '',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

CREATE TABLE `plus_minus` (
	`id` INT(12) NOT NULL AUTO_INCREMENT,
	`goodId` INT(12) NULL DEFAULT '0',
	`operationId` INT(2) NULL DEFAULT '0',
	`value` BIGINT(20) NULL DEFAULT '0',
	`dateTime` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX `goodId` (`goodId`),
	INDEX `operationId` (`operationId`),
	CONSTRAINT `FK_plus_minus_goods` FOREIGN KEY (`goodId`) REFERENCES `goods` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

CREATE TABLE `log` (
	`id` INT(12) NOT NULL AUTO_INCREMENT,
	`goodId` INT(12) NOT NULL,
	`userId` INT(12) NOT NULL,
	`operationId` INT(2) NOT NULL,
	`dateTime` DATETIME NOT NULL,
	`isUpdate` SMALLINT(1) NOT NULL DEFAULT '0',
	`value` INT(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	INDEX `goodId` (`goodId`),
	INDEX `userId` (`userId`),
	INDEX `operationId` (`operationId`),
	INDEX `dateTime` (`dateTime`),
	INDEX `isUpdate` (`isUpdate`),
	CONSTRAINT `FK_log_user` FOREIGN KEY (`userId`) REFERENCES `user` (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;";
        Yii::app()->db->createCommand($sql)->execute();
    }

    public function down()
    {
        $sql = "DROP TABLE `goods`;
DROP TABLE `plus_minus`;
DROP TABLE `log`;";
        Yii::app()->db->createCommand($sql)->execute();
    }
}