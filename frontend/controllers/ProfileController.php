<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\Comment;
use common\models\Category;
use common\models\Tag;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ProfileController extends \yii\web\Controller
{
    /*
     * View the user profile.
     * @param int $id - id of the user
     */
    public function actionIndex($id)
    {
        $user = User::findIdentity($id);
        $comments = Comment::getRecentComments();
        $sidebarCategories = Category::getSidebarCategories();
        $tags = Tag::getTagList();
        
        return $this->render('index', [
            'user' => $user,
            'comments' => $comments,
            'sidebarCategories' => $sidebarCategories,
            'tags' => $tags,
        ]);
    }
    
    /**
     * Update user profile. User can update profile image so it's necessary to check 
     *  if already uploaded file exists in database, and then replace it with new one.
     * @param int $id - id of the user
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()))
        {    
            $model->avatar = UploadedFile::getInstance($model, 'avatar');
            if ($model->avatar !== null) 
            {
                $model->profile_image = $model->id . '.' . $model->avatar->extension;
            }
            else
            {
                $model->profile_image = User::findOne($model->id)->profile_image;
            }    
            
            if ($model->save())
            {
                $dest = Yii::getAlias('@webroot/images/blog');
                if ($model->avatar !== null)
                {    
                    $model->avatar->saveAs($dest . '/' . $model->id . '.' . $model->avatar->extension);
                }
                
                Yii::$app->session->setFlash('updateMessage', 'Your profile has been updated.');
                return $this->redirect(['/profile', 'id' => $id]);
            }
            else
            {
                Yii::$app->session->setFlash('updateMessage', 'Your profile has not been updated.');
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        else
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }    
    }
    
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }    
    }        
}
