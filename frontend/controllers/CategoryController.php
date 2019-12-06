<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Product;
use frontend\controllers\behaviors\AccessBehavior;
use yii\web\Controller;

/**
 * Контроллер CategoryController
 * Каталог товаров
 */
class CategoryController extends Controller
{
    public function behaviors()
    {
        return [
            AccessBehavior::className(),
        ];
    }

    /**
     * Action для страницы "Каталог товаров"
     * @param $id
     * @return string
     */
    public function actionIndex($id)
    {
        $categories = Category::getCategoriesList();
        $categoryProducts = Product::getProductsListByCategory($id);

        return $this->render('index', [
            'categories' => $categories,
            'categoryProducts' => $categoryProducts,
        ]);
    }

    /**
     * @brief Action для страницы "Категория товаров"
     * @param $categoryId integer
     * @return string
     */
    public function actionCategory($categoryId)
    {
        $categories = Category::getCategoriesList();

        return $this->render('index', [
            'categories' => $categories,
        ]);
    }

}
