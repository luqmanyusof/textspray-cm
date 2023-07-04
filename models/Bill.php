<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bill".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $month
 * @property float|null $amount
 * @property int|null $status
 * @property string|null $last_pay_date
 * @property string|null $hash_id
 */
class Bill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
            [['amount'], 'number'],
            [['last_pay_date'], 'safe'],
            [['month', 'hash_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Client',
            'month' => 'Month',
            'amount' => 'Amount',
            'status' => 'Status',
            'last_pay_date' => 'Last Pay Date',
            'hash_id' => 'Hash ID',
        ];
    }
}
