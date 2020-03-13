<?php

class m200312_164805_create_user_table extends CDbMigration
{
    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `user` (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `email` varchar(255) NOT NULL,
            `password` varchar(255) NOT NULL,
            `name` varchar(255) NOT NULL,
            `date` int(11) NOT NULL,
            `status` int(11) NOT NULL,
            `role` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
        Yii::app()->db->createCommand($sql)->execute();
    }

    public function down()
    {
        $sql = "DROP TABLE user";
        Yii::app()->db->createCommand($sql)->execute();
    }
}