<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\helpers\StringHelper;
use yii\widgets\LinkPager;

$this->title = 'My Yii Application';
?>
<aside class="col-md-4">
    <div class="widget search">
        <form role="form">
                <input type="text" class="form-control search_box" autocomplete="off" placeholder="Search Here">
        </form>
    </div><!--/.search-->

    <div class="widget categories">
        <h3>Recent Comments</h3>
        <div class="row">
            <div class="col-sm-12">
                <?php foreach ($comments as $key => $comment) : ?>
                <div class="single_comments">
                    <?= Html::img(($comment->user->profile_image) ? '@web/images/blog/' . Html::encode($comment->user->profile_image) : '@web/images/blog/avatar3.png', 
                            ['width' => '64', 'height' => '64']); ?>
                    <p><?= Html::encode(StringHelper::byteSubstr($comment->comment, 0, 70)); ?></p>
                    <div class="entry-meta small muted">
                        <span>By <?= Html::a(Html::encode($comment->user->username), ['/profile', 'id' => $comment->user->id]); ?></span> <span>On 
                            <?php $title = Html::encode(StringHelper::byteSubstr($comment->page->title, 0, 23)); ?>...</span>
                            <?= Html::a($title, ['page/view', 'id' => $comment->page->id]); ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>                     
    </div><!--/.recent comments-->

    <div class="widget categories">
        <h3>Categories</h3>
        <div class="row">
            <div class="col-sm-6">
                <ul class="blog_category">
                    <?php foreach($sidebarCategories as $key => $category) : ?>
                        <li><?= Html::a(Html::encode($category->category_name), ['/page']); ?><span class="badge"><?= count($category->pages); ?></span></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>                     
    </div><!--/.categories-->

    <div class="widget tags">
        <h3>Tag Cloud</h3>
        <ul class="tag-cloud">
            <?php foreach($tags as $key => $tag) : ?>
                <li><a class="btn btn-xs btn-primary" href=""><?= Html::encode($tag->tag_title); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div><!--/.tags-->
</aside>

