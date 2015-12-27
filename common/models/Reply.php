<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "reply".
 *
 * @property integer $id
 * @property integer $comment_id
 * @property integer user_id
 * @property string $reply
 * @property string $created_at
 *
 * @property Comment $comment
 */
class Reply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reply';
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
            [['comment_id', 'user_id', 'reply'], 'required'],
            [['comment_id', 'user_id'], 'integer'],
            [['comment_id'], 'exist', 'targetClass' => '\common\models\Comment', 'targetAttribute' => 'id'],
            [['user_id'], 'exist', 'targetClass' => '\common\models\User', 'targetAttribute' => 'id'],
            [['reply'], 'string'],
            [['reply'], 'filter', 'filter' => 'strip_tags'],
            [['reply'], 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment_id' => 'Comment ID',
            'reply' => 'Reply',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComment()
    {
        return $this->hasOne(Comment::className(), ['id' => 'comment_id']);
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }        
}
