<?php

namespace common\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $page_id
 * @property string $comment
 * @property string $created_at
 *
 * @property Page $page
 * @property User $user
 * @property Reply[] $replies
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
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
            [['user_id', 'page_id', 'comment'], 'required'],
            [['user_id', 'page_id'], 'integer'],
            [['user_id'], 'exist', 'targetClass' => '\common\models\User', 'targetAttribute' => 'id'],
            [['page_id'], 'exist', 'targetClass' => '\common\models\Page', 'targetAttribute' => 'id'],
            [['comment'], 'string'],
            [['comment'], 'filter', 'filter' => 'strip_tags'],
            [['comment'], 'trim'],
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
            'page_id' => 'Page ID',
            'comment' => 'Comment',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
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
    public function getReplies()
    {
        return $this->hasMany(Reply::className(), ['comment_id' => 'id']);
    }
    
    /*
     * Get recent 3 comments - used in sidebar
     */
    public static function getRecentComments()
    {
        return self::find()
                ->orderBy(['created_at' => SORT_DESC])
                ->limit(3)
                ->all();
    }
}
