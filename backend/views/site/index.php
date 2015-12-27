<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\widgets\LinkPager;    

$this->title = 'My Yii Application';
?>
<div class="blog">
    <div class="row">
        <div class="col-md-8">
            <div class="col-sm-6 col-md-8">
                <h3>Welcome Jessica. You are site author and able to add new categories, new articles and new authors.</h3>
                <h2>Recently added articles:</h2>
                <div class="col-sm-12">
                    <?php foreach ($pages as $key => $page) : ?>
                        <div class="single_comments">
                            <div class="pull-left">
                                <?php $img = Html::img('/uploads/' . Html::encode($page->cover_image),
                                    ['class' => 'img-responsive', 'width' => '150', 'height' => '105']); ?>
                                <?= Html::a($img, ['/page/view', 'id' => $page->id]); ?>
                            </div>
                            <div class="media-body">
                                <h5><?= Html::a(Html::encode($page->title), ['/page/view', 'id' => $page->id]); ?></h5>
                                <p><small><?= Html::encode(StringHelper::byteSubstr($page->content, 0, 40)); ?>...
                                <?= Html::a('Read', ['/page/view', 'id' => $page->id]); ?></small></p>
                            </div>
                        </div>
                    <?php endforeach; ?>               
                </div>
                <?= LinkPager::widget([
                            'pagination' => $pagination,
                            'prevPageLabel' => 'Previous Page',
                            'nextPageLabel' => 'Next Page',
                    ]); ?>
            </div>    
        </div>
    </div>
</div>
