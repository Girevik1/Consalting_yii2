<?php

namespace frontend\controllers\behaviors;

use Yii;
use yii\base\Behavior;
use yii\web\Controller;

class AccessBehavior extends Behavior
{
    /**
     * @return array|string
     */
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'checkAccess'
        ];
    }

    /**
     * @return \yii\web\Response
     */
    public function checkAccess()
    {
        if (!Yii::$app->user->can('manager')) {
            return Yii::$app->controller->redirect('/user/login');
        }
    }
}