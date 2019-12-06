<?php

namespace backend\controllers;

use common\models\User;
use frontend\controllers\behaviors\AccessBehavior;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            AccessBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;

        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 4,
            ],
        ]);

        return $this->render('index', [
            'user' => $user,
            'dataProvider' => $dataProvider
        ]);
    }
}