<?php

use common\models\Produto;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\ProdutoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Produtos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Produto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'nome',
            [
                'label' => 'Imagem do Produto',
                'attribute' => 'imagem',
                'content' => function($model){
                    return Html::img($model->getImageUrl(), ['style' => 'width: 60px']);
                }
            ],
            'preco:currency',
            [
                'attribute' => 'status',
                'content' => function ($model) {
                    return Html::tag('span', $model->status ? 'Ativo' : 'Inativo', [
                        'class' => $model->status ? 'badge badge-success' : 'badge badge-danger'
                    ]);
                }
            ],
            'data_criacao:datetime',
            'data_modificacao:datetime',
            //'criado_por',
            //'atualizado_por',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Produto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
