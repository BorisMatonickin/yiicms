<?php

namespace backend\controllers;

use Yii;
use common\models\Page;
use common\models\Tag;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Command;
use yii\helpers\ArrayHelper;

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
        $dataProvider = new ActiveDataProvider([
            'query' => Page::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Page model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Page model. Categories and tags associated with article should 
     *  be inserted in pivot tables. Image file should be uploaded to images folder.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Page();
        $model->scenario = 'create';
        $tagsToArray = [];

        if ($model->load(Yii::$app->request->post())) {
            
            $model->avatar = UploadedFile::getInstance($model, 'avatar');
            
            if ($model->avatar !== null) {
                $model->cover_image = Yii::$app->security->generateRandomString(8) . '.' . $model->avatar->extension;
            }
            $model->user_id = Yii::$app->user->identity->id;           
            
            if ($model->save()) {
                $dest = Yii::getAlias('@frontend/web/images/blog');
                if ($model->avatar !== null) {
                    $model->avatar->saveAs($dest . '/' . $model->cover_image);
                }
                if (Yii::$app->request->post('Page')['categoriesFromSelect']) {
                    $categories = Yii::$app->request->post('Page')['categoriesFromSelect'];
                    $this->insertPageCategories($categories, $model);
                }
                if (Yii::$app->request->post('Page')['tag_title']) {
                    $tagsToArray = explode(',', Yii::$app->request->post('Page')['tag_title']);
                    $this->checkTags($tagsToArray, $model);
                }
                Yii::$app->session->setFlash('message', 'The article has been created successfully.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }   
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dest = Yii::getAlias('@frontend/web/images/blog');
        $tagsToArray = [];
        
        if ($model->load(Yii::$app->request->post())) {
            
            $model->avatar = UploadedFile::getInstance($model, 'avatar');
            
            if ($model->avatar !== null) {
                unlink($dest . '/' . $model->cover_image);
                $model->cover_image = Yii::$app->security->generateRandomString(8) . '.' . $model->avatar->extension;
            }
            $model->user_id = Yii::$app->user->identity->id;           
            
            if ($model->save()) {
                if ($model->avatar !== null) {
                    $model->avatar->saveAs($dest . '/' . $model->cover_image);
                }
                if (Yii::$app->request->post('Page')['categoriesFromSelect']) {
                    $categories = Yii::$app->request->post('Page')['categoriesFromSelect'];
                    $this->insertPageCategories($categories, $model);
                }
                if (Yii::$app->request->post('Page')['tag_title']) {
                    $tagsToArray = explode(',', Yii::$app->request->post('Page')['tag_title']);
                    $this->checkTags($tagsToArray, $model);
                }
                Yii::$app->session->setFlash('message', 'The article has been updated successfully.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }     
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
    
    /**
     * Insert page categories into pivot table. 
     * @param array $categories
     * @param $model
     */
    protected function insertPageCategories($categories, $model)
    {
        $query1 = "DELETE FROM page_category WHERE page_id = {$model->id}";
        $cmd1 = Yii::$app->createCommand($query1);
        $cmd1->execute();
        
        $query = "INSERT INTO page_category (page_id, category_id) VALUES ({$model->id}, :category_id)";
        $cmd = Yii::$app->db->createCommand($query);
        foreach ($categories as $catId) {
            $cmd->bindValues([':category_id' => [$catId, \PDO::PARAM_INT]]);
            $cmd->execute();
        }
    }        
    
    /**
     * 
     * @param array $tags
     * @param $model
     */
    protected function checkTags($tags, $model)
    {
        $tagsSaved = Tag::find()->all();
        $tagsArray = ArrayHelper::map($tagsSaved, 'id', 'tag_title');
        $newTags = array_diff($tags, $tagsArray);
        
        if (!empty(array_filter($newTags))) {
            $query = "INSERT INTO tag (tag_title) VALUES (:tag_title)";
            $cmd = Yii::$app->db->createCommand($query);
            foreach ($newTags as $tag) {
                $cmd->bindValues([':tag_title' => [$tag, \PDO::PARAM_STR]]);
                $cmd->execute();
            }
        }
        
        $tagsSaved2 = Tag::find()->all();
        $tagsArray2 = ArrayHelper::map($tagsSaved2, 'id', 'tag_title');
        $tagIds = array_intersect($tagsArray2, $tags);
        
        $query2 = "DELETE FROM page_tag WHERE page_id = {$model->id}";
        $cmd2 = Yii::$app->db->createCommand($query2);
        $cmd2->execute();
        
        $query3 = "INSERT INTO page_tag (page_id, tag_id) VALUES ({$model->id}, :tag_id)";
        $cmd3 = Yii::$app->db->createCommand($query3);
        foreach ($tagIds as $key => $tag) {
            $cmd3->bindValues([':tag_id' => [$key, \PDO::PARAM_INT]]);
            $cmd3->execute();
        }
    }
}
