<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use common\models\Page;
use common\models\Comment;
use common\models\Reply;
use common\models\Category;
use common\models\Tag;
use common\models\PageSearch;
use frontend\models\CommentForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $categories = Category::find()->all();
        $comments = Comment::getRecentComments();
        $sidebarCategories = Category::getSidebarCategories();
        $tags = Tag::getTagList();
                
        return $this->render('index', [
            'comments' => $comments,
            'sidebarCategories' => $sidebarCategories,
            'tags' => $tags,
            'categories' => $categories,
        ]);
    }

    /**
     * Displays a single Page model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $loginModel = new LoginForm();       
        $commentModel = new Comment();
        $replyModel = new Reply();
        $comments = Comment::getRecentComments();       
        $sidebarCategories = Category::getSidebarCategories();       
        $tags = Tag::getTagList();
        
        if ($loginModel->load(Yii::$app->request->post()) && $loginModel->login())
        {
            return $this->refresh();
        }
        elseif ($commentModel->load(Yii::$app->request->post()))
        {
            $commentModel->page_id = $id;
            $commentModel->user_id = Yii::$app->user->identity->id;
            
            if ($commentModel->save())
            {
                Yii::$app->session->setFlash('commentMessage', 'The comment has been saved.');
                return $this->refresh();
            }
            else
            {
                Yii::$app->session->setFlash('commentMessage', 'Please try again.');
                return $this->refresh();
            }    
        }
        elseif ($replyModel->load(Yii::$app->request->post()))
        {
            $replyModel->user_id = Yii::$app->user->identity->id;
            
            if ($replyModel->save())
            {
                Yii::$app->session->setFlash('commentMessage', 'The reply has been saved.');
                return $this->refresh();
            }
            else
            {
                Yii::$app->session->setFlash('commentMessage', 'Please try again.');
                return $this->refresh();
            }    
        }    
        else
        {    
            return $this->render('view', [
                'model' => $this->findModel($id),
                'loginModel' => $loginModel,
                'commentModel' => $commentModel,
                'replyModel' => $replyModel,
                'comments' => $comments,
                'sidebarCategories' => $sidebarCategories,
                'tags' => $tags,
            ]);
        } 
    }       
    
    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
