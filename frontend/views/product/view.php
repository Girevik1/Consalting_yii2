<?php

/* @var $this yii\web\View */
/* @var $categories array */

/* @var $product array */

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
                                            <?= $categoryItem['title']; ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php $mainImg = $product->getImage(); ?>
            <?php $gallery = $product->getImages(); ?>
            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="view-product">
                                <?= Html::img($mainImg->getUrl()); ?>
                                <h3>ZOOM</h3>
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <?php $count = count($gallery);
                                    $i = 0;
                                    foreach ($gallery as $img) : ?>
                                        <?php if ($i % 3 == 0) : ?>
                                            <div class="item <?= ($i == 0) ? ' active' : ''; ?>">
                                        <?php endif; ?>
                                        <a href=""><?= Html::img($img->getUrl('84x85')); ?></a>
                                        <?php $i++;
                                        if ($i % 3 == 0 || $i == $count) : ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Controls -->

                                <a class="left recommended-item-control" id="prev" href=""
                                   data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right recommended-item-control" id="next" href=""
                                   data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <div class="product-information">
                                <h2><?php echo $product['name']; ?></h2>
                                <span>
                                    <span><?php echo $product['cost']; ?>₽</span>
                                </span>
                                <p>
                                <h5>Описание товара</h5>
                                <?php echo $product['description']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
