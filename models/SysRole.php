<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys_role".
 *
 * @property int $id
 * @property int|null $code_role
 * @property int|null $sm_id
 * @property int|null $active
 * @property string|null $created_by
 * @property string|null $created_date
 * @property string|null $modified_by
 * @property string|null $modified_date
 * @property int|null $default_menu
 */
class SysRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code_role', 'sm_id', 'active', 'default_menu'], 'integer'],
            [['created_date', 'modified_date'], 'safe'],
            [['created_by', 'modified_by'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code_role' => 'Code Role',
            'sm_id' => 'Sm ID',
            'active' => 'Active',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'modified_by' => 'Modified By',
            'modified_date' => 'Modified Date',
            'default_menu' => 'Default Menu',
        ];
    }
}
