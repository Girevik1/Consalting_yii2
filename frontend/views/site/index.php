<?php

/* @var $this yii\web\View */
/* @var $categories array */
/* @var $products array */

use yii\helpers\Url;
use yii\helpers\Html;

?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $categoryItem): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="<?= Url::toRoute(['category/index', 'id' => $categoryItem['id']]); ?>">
                                            <?php echo $categoryItem['title']; ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Весь товар</h2>
                    <?php foreach ($products as $product): ?>
                        <?php $image = $product->getImage(); ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <p>
                                            <a href="<?= Url::toRoute(['product/view', 'id' => $product['id']]); ?>">
                                                <?php echo $product['name']; ?>
                                            </a>
                                        </p>
                                        <h2><?php echo $product['cost']; ?>₽</h2>
                                        <a href="<?= Url::toRoute(['product/view', 'id' => $product['id']]); ?>"
                                           class="btn btn-default add-to-cart" data-id="">Обзор</a>
                                        <?= Html::a(Html::img($image->getUrl()), Url::toRoute(['product/view', 'id' => $product['id']])); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</section>