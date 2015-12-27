<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'username',
            'first_name',
            'last_name',
            [
                'header' => 'Status',
                'value' => function($data) {
                    return ($data->status === 1) ? 'Active' : 'Not Active';
                }
            ],
            [
                'header' => 'Admin',
                'value' => function($data) {
                    return ($data->role === 20) ? 'Admin' : 'Regular User'; 
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function($url, $model) {
                        return ($model->role === 10) ? Html::a('Set as Admin', $url, ['class' => 'btn-xs', 'title' => 'Set as Admin']) : 
                                Html::a('Remove Admin', $url, ['class' => 'btn-xs', 'title' => 'Remove Admin']);
                    }
                ],
                'template' => '{update}{delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
