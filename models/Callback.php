<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "callback".
 *
 * @property int $id
 * @property string|null $callback
 * @property string $timestamp
 * @property string|null $get
 */
class Callback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'callback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['callback', 'get'], 'string'],
            [['timestamp'], 'required'],
            [['timestamp'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'callback' => 'Callback',
            'timestamp' => 'Timestamp',
            'get' => 'Get',
        ];
    }
}
