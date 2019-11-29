<?php
namespace frontend\controllers;

use Yii;
//use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{

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

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['user/login']);
        }

//        if (!Yii::$app->user->can('viewInfo')) {
//            return $this->redirect(['user/login']);
//        }

        $user = Yii::$app->user->identity;
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $user->getTransactions(),
//            'pagination' => [
//                'pageSize' => 3,
//            ],
//        ]);
        if (!\Yii::$app->user->can('admin')) {
            throw new ForbiddenHttpException('Access denied');
        }
        return $this->render('index', [
            'user' => $user,
            //'dataProvider' => $dataProvider
        ]);
    }
}
