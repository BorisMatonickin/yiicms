<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $category_name
 *
 * @property PageCategory[] $pageCategories
 * @property Page[] $pages
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name'], 'required', 'on' => 'create'],
            [['category_name'], 'filter', 'filter' => 'trim'],
            [['category_name'], 'filter', 'filter' => 'strip_tags'],
            [['category_name'], 'match', 'pattern' => '/^[a-z0-9\s\-]{2,50}$/i'],
            [['category_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_name' => 'Category Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageCategories()
    {
        return $this->hasMany(PageCategory::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['id' => 'page_id'])
                ->andOnCondition(['live' => '1'])
                ->viaTable('page_category', ['category_id' => 'id']);
    }
    
    /*
     * Get categories for sidebar
     */
    public static function getSidebarCategories()
    {
        return self::find()
                ->orderBy('RAND()')
                ->limit(4)
                ->all();
    }
}
