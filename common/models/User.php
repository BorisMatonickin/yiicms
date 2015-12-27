<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string profile_image
 * @property array avatar
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const ROLE_USER = 10;
    const ROLE_ADMIN = 20;
    
    public $avatar;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
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
            [['username'], 'filter', 'filter' => 'trim'],
            [['username'], 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            [['username'], 'string', 'min' => 2, 'max' => 45],
            [['username'], 'filter', 'filter' => 'strip_tags'],
            
            [['first_name'], 'filter', 'filter' => 'trim'],
            [['first_name'], 'string', 'min' => 2, 'max' => 60],
            [['first_name'], 'match', 'pattern' => '/^[A-Za-z\'\.\-]{2,60}$/i'],
            [['first_name'], 'filter', 'filter' => 'strip_tags'],
            
            [['last_name'], 'filter', 'filter' => 'trim'],
            [['last_name'], 'string', 'min' => 2, 'max' => 80],
            [['last_name'], 'match', 'pattern' => '/^[A-Za-z\'\.\-]{2,80}$/i'],
            [['last_name'], 'filter', 'filter' => 'strip_tags'],
            
            [['profile_image'], 'string', 'min' => 1, 'max' => 60],
            [['profile_image'], 'filter', 'filter' => 'trim'],
            [['profile_image'], 'filter', 'filter' => 'strip_tags'],
            [['profile_image'], 'default', 'value' => null],
            
            [['avatar'], 'file', 'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'], 'extensions' => ['png', 'gif', 'jpg'], 'skipOnEmpty' => true, 
                'checkExtensionByMimeType' => true, 'maxSize' => 1024 * 1024 * 2],
            
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['status'], 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['role'], 'default', 'value' => 10],
            [['role'], 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN]],
        ];
    }       
    
    /**
     * @inheritdocs
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'User Name',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'profile_image' => 'Profile Image',
            'avatar' => 'Profile Avatar',
            'status' => 'Status',
            'role' => 'Role',
            'created_at' => 'Created At',
        ];
    }        
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['user_id' => 'id'])
                    ->andOnCondition(['live' => '1']);
    }
    
    /**
     * Creates full name.
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    /*
     * Check if user is admin.
     * @param string $username
     * @return boolean
     */
    public static function isUserAdmin($username)
    {
        if (static::findOne(['username' => $username, 'role' => self::ROLE_ADMIN]))
        {
            return true;
        }
        else
        {
            return false;
        }    
    }
}

