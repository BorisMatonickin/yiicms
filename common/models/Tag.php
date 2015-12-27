<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property string $id
 * @property string $tag_title
 *
 * @property PageTag[] $pageTags
 * @property Page[] $pages
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_title'], 'required'],
            [['tag_title'], 'string', 'max' => 50],
            [['tag_title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_title' => 'Tag Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageTags()
    {
        return $this->hasMany(PageTag::className(), ['tag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['id' => 'page_id'])->viaTable('page_tag', ['tag_id' => 'id']);
    }
    
    /*
     * Get tag list
     */
    public static function getTagList()
    {
        return self::find()
                ->limit(14)
                ->all();
    }
}
