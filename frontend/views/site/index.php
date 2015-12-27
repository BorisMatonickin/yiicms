<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\helpers\StringHelper;
use yii\widgets\LinkPager;

$this->title = 'My Yii Application';
?>
<section id="blog">
    <div class="center">
        <h2 class="about-title">News</h2>
        <p class="lead">Pellentesque habitant morbi tristique senectus et netus et malesuada</p>
    </div>

    <div class="blog">
        <div class="row">
             <div class="col-md-8">
                <?php foreach ($pages as $key => $page) : ?>
                <div class="blog-item">
                    <div class="row">
                        <div class="col-xs-12 col-sm-2 text-center">
                            <div class="entry-meta">
                                <span id="publish_date"><?= Html::encode(Yii::$app->formatter->asDate($page['created_at'], 'php:d M')); ?></span>
                                <span><i class="fa fa-user"></i><?= Html::a(Html::encode($page->user->getFullName()), ['/profile', 'id' => $page->user->id]); ?></span>
                                <span><i class="fa fa-comment"></i> <a href="blog-item.html#comments"><?= count($page->comments); ?> Comments</a></span>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-10 blog-content">
                            <?php $img = Html::img('@web/images/blog/' . Html::encode($page->cover_image), ['class' => 'img-responsive img-blog', 'width' => '100%']); ?>
                            <?= Html::a($img, ['page/view', 'id' => $page->id]); ?>
                            <h2><?= Html::a(Html::encode($page->title), ['page/view', 'id' => $page->id]); ?></h2>
                            <h3><?= Html::encode(StringHelper::byteSubstr($page->content, 0, 215)); ?>...</h3>
                            <?= Html::a('Read More', ['page/view', 'id' => $page->id], ['class' => 'btn btn-primary readmore']); ?>
                        </div>
                    </div>    
                </div><!--/.blog-item-->
                <?php endforeach; ?>

                <?= LinkPager::widget(['pagination' => $pagination,
                                       'prevPageLabel' => 'Previous Page',
                                       'nextPageLabel' => 'Next Page', 
                                    ]); ?><!--/.pagination-->
            </div><!--/.col-md-8-->
            <?= $this->render('/partials/_sidebar', ['comments' => $comments, 'sidebarCategories' => $sidebarCategories, 'tags' => $tags]); ?>
        </div><!--/.row-->
    </div>
</section><!--/#blog-->
