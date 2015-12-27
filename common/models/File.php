<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property string $type
 * @property string $size
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 * @property PageFile[] $pageFiles
 * @property Page[] $pages
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'type', 'size', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'size'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 80],
            [['type'], 'string', 'max' => 45]
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
            'name' => 'Name',
            'type' => 'Type',
            'size' => 'Size',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
    public function getPageFiles()
    {
        return $this->hasMany(PageFile::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['id' => 'page_id'])->viaTable('page_file', ['file_id' => 'id']);
    }
}
