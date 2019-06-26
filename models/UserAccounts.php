<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_accounts".
 *
 * @property int $user_id
 * @property double $payable_salary
 * @property double $basic_salary
 * @property double $tax_value
 *
 * @property TblUser $user
 */
class UserAccounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_accounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'payable_salary', 'basic_salary', 'tax_value'], 'required'],
            [['user_id'], 'integer'],
            [['payable_salary', 'basic_salary', 'tax_value'], 'number'],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblUser::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'payable_salary' => 'Payable Salary',
            'basic_salary' => 'Basic Salary',
            'tax_value' => 'Tax Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TblUser::className(), ['user_id' => 'user_id']);
    }
}
