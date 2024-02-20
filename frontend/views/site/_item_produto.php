<?php
/**
 * User: TheCodeholic
 * Date: 12/12/2020
 * Time: 11:53 AM
 */
/** @var \common\models\Product $model */

use yii\helpers\StringHelper;
use yii\helpers\Url;

?>
<div class="card h-100">
    <a href="#" class="img-wrapper">
        <img class="card-img-top" src="<?= $model->getImageUrl() ?>" alt="">
    </a>
    <div class="card-body">
        <h5 class="card-title">
            <a href="#" class="text-dark"><?= StringHelper::truncateWords($model->nome, 20) ?></a>
        </h5>
        <h5><?= Yii::$app->formatter->asCurrency($model->preco) ?></h5>
        <div class="card-text">
            <?= $model->getShortDescription() ?>
        </div>
    </div>
    <div class="card-footer text-right">
        <a href="" class="btn btn-primary btn-add-to-cart">
            Add to Cart
        </a>
    </div>
</div>
