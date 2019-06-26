<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_type".
 *
 * @property int $user_type_id
 * @property string $user_type_name
 * @property double $basic_salary
 *
 * @property TblUser[] $tblUsers
 */
class UserType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_type_name', 'basic_salary'], 'required'],
            [['basic_salary'], 'number'],
            [['user_type_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_type_id' => 'User Type ID',
            'user_type_name' => 'User Type Name',
            'basic_salary' => 'Basic Salary',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblUsers()
    {
        return $this->hasMany(TblUser::className(), ['user_type_id' => 'user_type_id']);
    }
    public static function userTypeDetails($user_type_id) {
        $UserTypeModel = UserType::findOne($user_type_id);
        return $UserTypeModel['basic_salary'];
    }
}
