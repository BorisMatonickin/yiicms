<?php

use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = $model->title;
?>
<div class="center">
    <h2 class="about-title"><?= Html::encode($model->title); ?></h2>
</div>

<div class="blog">
    <div class="row">
        <div class="col-md-8">
            <div class="blog-item">
                <?= Html::img('@web/images/blog/' . Html::encode($model->cover_image), ['class' => 'img-responsive img-blog', 'width' => '100%']); ?>
                <div class="row">  
                    <div class="col-xs-12 col-sm-2 text-center">
                        <div class="entry-meta">
                            <span id="publish_date"><?= Html::encode(Yii::$app->formatter->asDate($model->created_at, 'php:d M')); ?></span>
                            <span><i class="fa fa-user"></i><?= Html::a(Html::encode($model->user->getFullName()), ['/profile', 'id' => $model->user->id]); ?></span>
                            <span><i class="fa fa-comment"></i> <a href="blog-item.html#comments"><?= count($model->comments); ?></a></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-10 blog-content">
                        <p><?= Html::encode($model->content); ?></p>
                        <div class="post-tags">
                            <strong>Tag:</strong>
                            <?php $tagsArray = []; ?>
                            <?php foreach ($model->tags as $tag) : ?>
                                <?php $tagsArray[] = '<a href="#">' . Html::encode($tag['tag_title']) . '</a>'; ?>
                            <?php endforeach; ?>
                            <?= implode(' / ', $tagsArray); ?>
                        </div>
                    </div>
                </div>
            </div><!--/.blog-item-->

            <div class="media reply_section">
                <div class="pull-left post_reply">
                    <?php $img1 = Html::img(($model->user->profile_image) ? '@web/images/blog/' . Html::encode($model->user->profile_image) : '@web/images/blog/avatar3.png', 
                            ['class' => 'img-circle']); ?>
                    <?= Html::a($img1, ['/profile', 'id' => $model->user->id]); ?>
                    <div class="pull-right post_reply">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i> </a></li>
                        </ul>
                    </div>    
                </div>
                <div class="media-body post_reply_content">
                    <h3><?= Html::encode($model->user->getFullName()); ?></h3>
                </div>
            </div>
            
            <?php if (Yii::$app->session->hasFlash('commentMessage')) : ?>
                <div class="status alert alert-success">
                    <?= Yii::$app->session->getFlash('commentMessage'); ?>
                </div>
            <?php endif; ?>
            
            <h1 id="comments_title"><?= count($model->comments); ?> Comments</h1>
            <?php foreach ($model->comments as $key => $comment) : ?>
                <div class="media reply_section row">
                    <div class="col-md-2">
                        <?php $img = Html::img(($comment->user->profile_image) ? '@web/images/blog/' . Html::encode($comment->user->profile_image) : '@web/images/blog/avatar3.png', 
                                    ['class' => 'img-circle', 'width' => '70', 'height' => '70']); ?>
                        <?= Html::a($img, ['/profile', 'id' => $comment->user->id]); ?>
                    </div>
                    <div class="col-md-10">
                        <h3><?= Html::encode($comment->user->username); ?></h3>
                        <h4><?= Html::encode(Yii::$app->formatter->asDate($comment->created_at, 'php:F j, Y, g:i a')); ?></h4>
                        <p><?= Html::encode($comment->comment); ?></p>
                        
                        <?php $replyForm = ActiveForm::begin(['id' => 'reply-form']); ?>
                            <?= $replyForm->field($replyModel, 'reply')->textInput(['class' => 'form-control'])->label(false); ?>
                            <?= $replyForm->field($replyModel, 'comment_id')->hiddenInput(['value' => $comment->id])->label(false); ?>
                            <?= Html::submitButton('Reply', ['class' => 'btn btn-primary', 'name' => 'create-reply']); ?>
                        <?php ActiveForm::end(); ?>
                        
                    </div>
                    <?php foreach($comment->replies as $index => $reply) : ?>
                        <div class="reply_section reply">
                            <div class="col-md-2">
                                <?php $img2 = Html::img(($reply->user->profile_image) ? '@web/images/blog/' . Html::encode($reply->user->profile_image) : '@web/images/blog/avatar3.png', 
                                            ['class' => 'img-circle', 'width' => '70', 'height' => '70']); ?>
                                <?= Html::a($img2, ['/profile', 'id' => $reply->user->id]); ?>
                            </div>
                            <div class="col-md-10">
                                <h3><?= Html::encode($reply->user->username); ?></h3>
                                <h4><?= Html::encode(Yii::$app->formatter->asDate($reply->created_at, 'php:F j, Y, g:i a')); ?></h4>
                                <p><?= Html::encode($reply->reply); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <div id="contact-page clearfix">               
                <?php if (Yii::$app->user->getIsGuest()) : ?>
                    <div class="message_heading">
                        <h4>Please login if you want to leave comment.</h4>
                    </div> 
                    <div class="row">
                        <div class="col-lg-5">
                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                                <?= $form->field($loginModel, 'username') ?>

                                <?= $form->field($loginModel, 'password')->passwordInput() ?>

                                <?= $form->field($loginModel, 'rememberMe')->checkbox() ?>

                                <div style="color:#999;margin:1em 0">
                                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                                </div>

                                <div class="form-group">
                                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="message_heading">
                        <h4>Leave a Comment</h4>
                    </div> 
                    <?php $commentForm = ActiveForm::begin(['id' => 'comment-form']); ?>
                        <?= $commentForm->field($commentModel, 'comment')->textArea(['rows' => '6', 'class' => 'form-control', 'required' => 'required']); ?>
                        <div class="form-group">
                            <?= Html::submitButton('Submit Comment', ['class' => 'btn btn-primary btn-lg', 'name' => 'create-comment']); ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                <?php endif; ?>
            </div><!--/#contact-page-->
        </div><!--/.col-md-8-->     
        <?= $this->render('/partials/_sidebar', ['comments' => $comments, 'sidebarCategories' => $sidebarCategories, 'tags' => $tags]); ?>    
    </div><!--/.row-->
</div><!--/.blog-->

