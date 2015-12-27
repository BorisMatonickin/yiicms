<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use common\models\Category;

/**
 * This is the model class for table "page".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $live
 * @property string $title
 * @property string $content
 * @property string $cover_image
 * @property array $avatar
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Comment[] $comments
 * @property User $user
 * @property PageCategory[] $pageCategories
 * @property Category[] $categories
 * @property PageFile[] $pageFiles
 * @property File[] $files
 * @property PageTag[] $pageTags
 * @property Tag[] $tags
 */
class Page extends \yii\db\ActiveRecord
{
    public $avatar;
    public $categoriesFromSelect;
    public $tag_title;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }        
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'live'], 'integer'],
            [['user_id'], 'exist', 'targetClass' => 'common\models\User', 'targetAttribute' => 'id'],
            
            [['content'], 'string'],
            [['content'], 'filter', 'filter' => 'trim'],
            [['content'], 'filter', 'filter' => 'strip_tags'],
            [['content'], 'required', 'on' => 'create'],
            
            [['title'], 'string', 'max' => 100],
            [['title'], 'filter', 'filter' => 'trim'],
            [['title'], 'filter', 'filter' => 'strip_tags'],
            [['title'], 'required', 'on' => 'create'],
            
            [['cover_image'], 'string', 'max' => 60],
            [['cover_image'], 'filter', 'filter' => 'trim'],
            [['cover_image'], 'filter', 'filter' => 'strip_tags'],
            [['cover_image'], 'required', 'on' => 'create'],
            
            [['avatar'], 'file', 'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'], 'extensions' => ['jpg', 'png', 'gif'], 'skipOnEmpty' => false,
                'checkExtensionByMimeType' => true, 'maxSize' => 1024 * 1024 * 2, 'on' => 'create'],
            
            [['avatar'], 'file', 'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'], 'extensions' => ['jpg', 'png', 'gif'], 'skipOnEmpty' => true,
                'checkExtensionByMimeType' => true, 'maxSize' => 1024 * 1024 * 2],
            
            [['categoriesFromSelect'], 'required', 'on' => 'create'],
            
            [['tag_title'], 'string'],
            [['tag_title'], 'filter', 'filter' => 'trim'],
            [['tag_title'], 'filter', 'filter' => 'strip_tags'],
            [['tag_title'], 'required', 'on' => 'create'],
            
            [['live'], 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'categoriesFromSelect' => 'Categories',
            'live' => 'Live',
            'title' => 'Title',
            'content' => 'Content',
            'tag_title' => 'Tags',
            'avatar' => 'Cover Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageCategories()
    {
        return $this->hasMany(PageCategory::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('page_category', ['page_id' => 'id']);
    }
    
    /**
     * Get list of categories as string.
     * @return string
     */
    public function getCategoriesString()
    {
        $string = [];
        foreach ($this->categories as $category) {
            $string[] = $category->category_name;
        }
        return implode(', ', $string);
    }
    
    /**
     * List of categories with belonging id for select tag.
     * It is used in create article form so it should be callable from this model.
     */
    public function listCategories()
    {
        $data = Category::find()->all();
        return ArrayHelper::map($data, 'id', 'category_name');
    }        
    
    /**
     * Get list of tags as string.
     * @return string
     */
    public function getTagsString()
    {
        $string = [];
        foreach ($this->tags as $tag) {
            $string[] = $tag->tag_title;
        }
        return implode(',', $string);
    }        
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageFiles()
    {
        return $this->hasMany(PageFile::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['id' => 'file_id'])->viaTable('page_file', ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageTags()
    {
        return $this->hasMany(PageTag::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('page_tag', ['page_id' => 'id']);
    }
}
