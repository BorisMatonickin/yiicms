<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="blog">
<div class="row">
    <div class="col-md-8">
        <div class="accordion">
            <div class="panel-group" id="accordion1">
            <?php $i = 0; ?>    
            <?php foreach ($categories as $key => $category) : ?>
                <?php $i++; ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse<?= $i; ?>">
                        <?= Html::encode($category['category_name']); ?>
                        <i class="fa fa-angle-right pull-right"></i>
                        </a>
                        </h3>
                    </div>
                    <div id="collapse<?= $i; ?>" class="panel-collapse collapse">
                    <?php foreach ($category->pages as $index => $page) : ?>
                        <div class="panel-body">
                            <div class="media accordion-inner">
                                <div class="pull-left">
                                    <?php $img = Html::img('@web/images/blog/' . Html::encode($page->cover_image), ['class' => 'img-responsive', 'width' => '150', 'height' => '105']); ?>
                                    <?= Html::a($img, ['page/view', 'id' => $page->id]); ?>
                                </div>
                                <div class="media-body">
                                    <h4><?= Html::a(Html::encode($page->title), ['page/view', 'id' => $page->id]); ?></h4>
                                    <p><?= Html::encode(StringHelper::byteSubstr($page->content, 0, 107)); ?>...
                                       <?= Html::a('Read More', ['page/view', 'id' => $page->id]); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>    
                    </div>
                </div>
            <?php endforeach; ?>    
            </div><!--/#accordion1-->
        </div>
    </div>    
    <?= $this->render('/partials/_sidebar', ['comments' => $comments, 'sidebarCategories' => $sidebarCategories, 'tags' => $tags]); ?>
</div>
</section>    
