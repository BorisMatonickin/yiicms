<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['id' => 'update-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'avatar')->fileInput(); ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'update-button']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
