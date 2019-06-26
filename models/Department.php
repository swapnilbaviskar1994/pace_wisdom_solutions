<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $department_id
 * @property string $department_name
 * @property int $commission_percentage
 * @property double $allowance_payable
 * @property double $last_month_deduction
 *
 * @property TblUser[] $tblUsers
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_name', 'commission_percentage', 'allowance_payable', 'last_month_deduction'], 'required'],
            [['commission_percentage'], 'integer'],
            [['allowance_payable', 'last_month_deduction'], 'number'],
            [['department_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'department_name' => 'Department Name',
            'commission_percentage' => 'Commission Percentage',
            'allowance_payable' => 'Allowance Payable',
            'last_month_deduction' => 'Last Month Deduction',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblUsers()
    {
        return $this->hasMany(TblUser::className(), ['department_id' => 'department_id']);
    }
    public static function departmentDetails($department_id,$basic_salary) {
        $departmentModel  = Department::findOne($department_id);
        $payableSalary = $basic_salary + ($basic_salary * $departmentModel->commission_percentage/100) + $departmentModel->allowance_payable - $departmentModel->last_month_deduction;
        return $payableSalary;
    }
}
