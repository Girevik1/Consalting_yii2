<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    $gallery = $model->getImages();
    $img_str = '';
    foreach ($gallery as $image) {
        $img_str .= '<a class="fancybox img-thumbnail" rel="gallery1" href="' . $image->getUrl() . '">' . Html::img($image->getUrl('84x85'), ['alt' => '']) . '</a>';
    } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            [
                'attribute' => 'image',
                'value' => $img_str,
                'format' => "html",
            ],
            'name',
            'cost',
            'description',
        ],
    ]) ?>

</div>
