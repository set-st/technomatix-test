<?php

class RbacCommand extends CConsoleCommand
{

    public function actionInit()
    {
        $auth = Yii::app()->authManager;

        $auth->createOperation('addPosition', 'Добавлять Товар');
        $auth->createOperation('addPlusMinus', 'Добавлять Приход/Расход');
        $auth->createOperation('operationsHistory', 'История операций');

        $role = $auth->createRole('staff');
        $role->addChild('addPlusMinus');

        $role = $auth->createRole('manager');
        $role->addChild('addPosition');
        $role->addChild('addPlusMinus');
        $role->addChild('operationsHistory');

        $role = $auth->createRole('admin');
        $role->addChild('addPosition');
        $role->addChild('addPlusMinus');
        $role->addChild('operationsHistory');

        $auth->assign('staff', 'staff@local.com');
        $auth->assign('manager', 'manager@local.com');
        $auth->assign('admin', 'admin@local.com');

        // insert users
        $sql = "INSERT INTO `user` (`id`, `email`, `password`, `name`, `date`, `status`, `role`) VALUES (1, 'admin@local.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 1584035337, 0, 'user');
INSERT INTO `user` (`id`, `email`, `password`, `name`, `date`, `status`, `role`) VALUES (2, 'manager@local.com', '1d0258c2440a8d19e716292b231e3190', 'manager', 1584035383, 0, 'user');
INSERT INTO `user` (`id`, `email`, `password`, `name`, `date`, `status`, `role`) VALUES (3, 'staff@local.com', '1253208465b1efa876f982d8a9e73eef', 'staff', 1584035403, 0, 'user');";
        Yii::app()->db->createCommand($sql)->execute();
    }

}