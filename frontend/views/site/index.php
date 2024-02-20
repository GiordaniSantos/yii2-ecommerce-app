<?php

/** @var yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */

use yii\bootstrap4\LinkPager;
use yii\widgets\ListView;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">
        <?php echo ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '{summary}<div class="row">{items}</div>{pager}',
            'itemView' => '_item_produto',
            'itemOptions' => [
                'class' => 'col-lg-4 col-md-6 mb-4 product-item'
            ],
            'pager' => [
                'class' => LinkPager::class
            ]
        ]) ?>

    </div>
</div>
