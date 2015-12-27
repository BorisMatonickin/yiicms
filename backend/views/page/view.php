<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('message')) : ?>
        <div class="status alert alert-success">
            <?= Yii::$app->session->getFlash('message'); ?>
        </div>
    <?php endif; ?>
    
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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Author',
                'value' => Html::encode($model->user->getFullName())
            ],
            [
                'label' => 'Categories', 
                'value' => $model->getCategoriesString()
            ],
            [
                'label' => 'Live',
                'value' => $model->live === 1 ? "Yes" : "No"
            ],
            'title',
            'content:ntext',
            [
                'label' => 'Cover Image',
                'value' => Html::img('/uploads/' .  Html::encode($model->cover_image), ['width' => '150', 'height' => '80']),
                'format' => 'raw'
            ],
            [
                'label' => 'Tags',
                'value' => $model->getTagsString()
            ],
            [
                'label' => 'Created At',
                'value' => Yii::$app->formatter->asDatetime($model->created_at, 'php:F j, Y, g:i a')
            ],
            [
                'label' => 'Updated At',
                'value' => Yii::$app->formatter->asDatetime($model->updated_at, 'php:F j, Y, g:i a'),
            ],
        ],
    ]) ?>

</div>
