<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys_user".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $password
 * @property string|null $su_name
 * @property string|null $su_email
 * @property int|null $code_division
 * @property int|null $code_role
 * @property int|null $su_active
 * @property int|null $su_locked
 * @property int|null $su_login_attempt
 * @property string|null $su_login_date
 * @property string|null $su_last_login
 * @property string|null $created_by
 * @property string|null $created_date
 * @property string|null $modified_by
 * @property string|null $modified_date
 * @property int|null $sqc_id
 * @property string|null $su_phone_no
 * @property string|null $authKey
 * @property string|null $accessToken
 * @property string|null $ws_no
 * @property string|null $subscription
 */
class SysUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code_role', 'su_active', 'su_locked', 'su_login_attempt'], 'integer'],
            [['su_login_date', 'su_last_login', 'created_date', 'modified_date', 'subscription'], 'safe'],
            [['username', 'password', 'su_name', 'su_email'], 'string', 'max' => 100],
            [['created_by', 'modified_by'], 'string', 'max' => 30],
            [['su_phone_no','ws_no'], 'string', 'max' => 20],
            [['authKey', 'accessToken'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'su_name' => 'Su Name',
            'su_email' => 'Su Email',
            'code_role' => 'Code Role',
            'su_active' => 'Su Active',
            'su_locked' => 'Su Locked',
            'su_login_attempt' => 'Su Login Attempt',
            'su_login_date' => 'Su Login Date',
            'su_last_login' => 'Su Last Login',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'modified_by' => 'Modified By',
            'modified_date' => 'Modified Date',
            'su_phone_no' => 'Su Phone No',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'subscription' => 'Subscription'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id) {
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = self::find()->select('id, username, password')->where(['username' => $username,  'su_active' => 1])->one();
        
        $arr['id'] = $user->id;
        $arr['username'] = $user->username;
        $arr['password'] = $user->password;
        
        if($user) {
            return new static($arr);
        }
        
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    ################# End Validation ###################3

    public function getClient(){
        $arr[] = '--Please Select--';

        $list = self::find()->where(['su_active' => 1, 'code_role' => 2])->all();

        foreach($list as $row){
            $arr[$row->id] = $row->su_name;
        }

        return $arr;
    }
}
