<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys_ref".
 *
 * @property int $id
 * @property int|null $parentid
 * @property string|null $code_name
 * @property string|null $code
 * @property string|null $sr_name
 * @property int|null $sort
 * @property int|null $active
 * @property string|null $created_by
 * @property string|null $created_date
 * @property string|null $modified_by
 * @property string|null $modified_date
 * @property string|null $addr1
 * @property string|null $addr2
 * @property string|null $addr3
 * @property string|null $addr_postcode
 * @property int|null $code_state
 * @property int|null $old_id
 */
class Ref extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_ref';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parentid', 'sort', 'active', 'code_state', 'old_id'], 'integer'],
            [['created_date', 'modified_date'], 'safe'],
            [['code_name', 'code', 'created_by', 'modified_by'], 'string', 'max' => 30],
            [['sr_name', 'addr1', 'addr2', 'addr3'], 'string', 'max' => 100],
            [['addr_postcode'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parentid' => 'Parentid',
            'code_name' => 'Code Name',
            'code' => 'Code',
            'sr_name' => 'Sr Name',
            'sort' => 'Sort',
            'active' => 'Active',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'modified_by' => 'Modified By',
            'modified_date' => 'Modified Date',
            'addr1' => 'Addr1',
            'addr2' => 'Addr2',
            'addr3' => 'Addr3',
            'addr_postcode' => 'Addr Postcode',
            'code_state' => 'Code State',
            'old_id' => 'Old ID',
        ];
    }

    public function getList($codename){
        $arr[] = '--Please Select--';

        $list = self::find()->where(['code_name' => $codename, 'active' => 1])->all();

        foreach($list as $row){
            $arr[$row->code] = $row->sr_name;
        }

        return $arr;
    }
}
