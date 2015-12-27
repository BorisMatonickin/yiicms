<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\VarDumper;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>profile/index</h1>

<div class="blog">
    <div class="row">
        <div class="col-md-8">
            <?php if (Yii::$app->session->hasFlash('updateMessage')) : ?>
                <div class="status alert alert-success">
                    <?= Yii::$app->session->getFlash('updateMessage'); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-sm-4 col-md-4">
                    <?= Html::img(($user->profile_image) ? '@web/images/blog/' . Html::encode($user->profile_image) : '@web/images/blog/avatar3.png', 
                            ['width' => '150', 'height' => '150']); ?>
                    <h2><?= $user->username; ?></h2>
                    <p><?= $user->getFullName(); ?></p>

                    <?php if ((!Yii::$app->user->isGuest) && ($user->id === Yii::$app->user->identity->id)) : ?>
                        <?= Html::a('Edit Info', ['/profile/update', 'id' => $user->id]); ?>
                    <?php endif; ?>
                </div>                         
                
                <?php if (count($user->comments) > 0) : ?>
                    <div class="col-sm-6 col-md-8">
                        <h2>Recently commented articles:</h2>
                        <div class="col-sm-12">
                            <?php foreach ($user->comments as $key => $comment) : ?>
                                <div class="single_comments">
                                    <div class="pull-left">
                                        <?php $img = Html::img('@web/images/blog/' . Html::encode($comment->page->cover_image), 
                                            ['class' => 'img-responsive', 'width' => '150', 'height' => '105']); ?>
                                        <?= Html::a($img, ['/page/view', 'id' => $comment->page->id]); ?>
                                    </div>
                                    <div class="media-body">
                                        <h5><?= Html::a(Html::encode($comment->page->title), ['/page/view', 'id' => $comment->page->id]); ?></h5>
                                        <p><small><?= Html::encode(StringHelper::byteSubstr($comment->page->content, 0, 45)); ?>...
                                        <?= Html::a('Read', ['/page/view', 'id' => $comment->page->id]); ?></small></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>                           
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if (count($user->pages) > 0) : ?>
                    <div class="col-sm-6 col-md-8">
                        <h2><?= $user->first_name; ?>'s articles:</h2>
                        <div class="col-sm-12">
                            <?php foreach ($user->pages as $key => $page) : ?>
                                <div class="single_comments">
                                    <div class="pull-left">
                                        <?php $img2 = Html::img('@web/images/blog/' . Html::encode($page->cover_image), 
                                            ['class' => 'img-responsive', 'width' => '150', 'height' => 105]); ?>
                                        <?= Html::a($img2, ['/page/view', 'id' => $page->id]); ?>
                                    </div>
                                    <div class="media-body">
                                        <h5><?= Html::a(Html::encode($page->title), ['/page/view', 'id' => $page->id]); ?></h5>
                                        <p><small><?= Html::encode(StringHelper::byteSubstr($page->content, 0, 45)); ?>...
                                        <?= Html::a('Read', ['/page/view', 'id' => $page->id]); ?></small></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>    
        </div> 
       <?= $this->render('/partials/_sidebar', ['comments' => $comments, 'sidebarCategories' => $sidebarCategories, 'tags' => $tags]); ?> 
    </div>
</div>
