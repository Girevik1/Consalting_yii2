<?php

namespace backend\controllers;

use Yii;
use common\models\LoginForm;

class UserController extends \yii\web\Controller
{
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login() && Yii::$app->user->can('manager')) {
            Yii::$app->session->setFlash('success', 'Здраствуйте, ' . Yii::$app->user->identity->username . '!');
            return $this->redirect(['site/index']);
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
