<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\forms\SignupForm;

class UserController extends \yii\web\Controller
{
    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', 'Поздравляю, Вы вошли!');
            return $this->redirect(['site/index']);
        }

        return $this->render('login', [
            'model' => $model
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $user = $model->save()) {
            Yii::$app->user->login($user);
            Yii::$app->session->setFlash('success', 'Вы зарегистрировались!');
            return $this->redirect(['site/index']);
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['user/login']);
    }
}
