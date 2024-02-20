<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Cadastrar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Por favor preencha os seguintes campos para se inscrever:</p>

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'primeiroNome')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'ultimoNome')->textInput(['autofocus' => true]) ?>
                    </div>
                </div>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
