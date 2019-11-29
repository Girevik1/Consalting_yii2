<?php

namespace backend\controllers;

use Yii;
use common\models\LoginForm;

class UserController extends \yii\web\Controller
{
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->can('viewAdminPage')) {
                Yii::$app->session->setFlash('success', 'Здраствуйте, админ ' . Yii::$app->user->identity->username . '!');
                return $this->redirect(['site/index']);
            }
            Yii::$app->session->setFlash('danger', 'К сожалению у Вас нет доступа');
            return $this->redirect(['user/login']);
        }

        return $this->render('login', [
            'model' => $model
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['user/login']);
    }
}
