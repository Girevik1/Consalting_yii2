<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Product;
use frontend\controllers\behaviors\AccessBehavior;
use Yii;
//use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
        $categories = Category::getCategoriesList();
        $products = Product::find()->all();
        $user = Yii::$app->user->identity;

        return $this->render('index', [
            'user' => $user,
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
