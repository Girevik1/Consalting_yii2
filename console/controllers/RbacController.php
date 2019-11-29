<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        $admin = $auth->createRole('admin');
        $manager = $auth->createRole('manager');
        $user = $auth->createRole('user');

        $auth->add($admin);
        $auth->add($manager);
        $auth->add($user);

        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $viewInfo = $auth->createPermission('viewInfo');
        $viewInfo->description = 'Просмотр операций';

        $auth->add($viewAdminPage);
        $auth->add($viewInfo);

        $auth->addChild($user, $viewInfo);

        $auth->addChild($manager, $user);


        $auth->addChild($manager, $viewAdminPage);

        $auth->addChild($admin, $manager);


        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 1);

        // Назначаем роль manager пользователю с ID 2
        $auth->assign($manager, 2);
    }

}