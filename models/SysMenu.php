<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys_menu".
 *
 * @property int $id
 * @property int|null $sm_parent_id
 * @property string|null $sm_menu
 * @property string|null $sm_url
 * @property int|null $active
 * @property string|null $created_by
 * @property string|null $created_date
 * @property string|null $modified_by
 * @property string|null $modified_date
 * @property string|null $sm_icon
 * @property int|null $sort
 */
class SysMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sm_parent_id', 'active', 'sort'], 'integer'],
            [['created_date', 'modified_date'], 'safe'],
            [['sm_menu', 'sm_url'], 'string', 'max' => 100],
            [['created_by', 'modified_by', 'sm_icon'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sm_parent_id' => 'Sm Parent ID',
            'sm_menu' => 'Sm Menu',
            'sm_url' => 'Sm Url',
            'active' => 'Active',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'modified_by' => 'Modified By',
            'modified_date' => 'Modified Date',
            'sm_icon' => 'Sm Icon',
            'sort' => 'Sort',
        ];
    }
}
