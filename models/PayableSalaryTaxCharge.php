<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "payable_salary_tax_charge".
 *
 * @property int $payable_tax_charge_id
 * @property int $payable_salary_upto
 * @property double $tax_pecentage_value
 */
class PayableSalaryTaxCharge extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payable_salary_tax_charge';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payable_salary_upto', 'tax_pecentage_value'], 'required'],
            [['payable_salary_upto'], 'integer'],
            [['tax_pecentage_value'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'payable_tax_charge_id' => 'Payable Tax Charge ID',
            'payable_salary_upto' => 'Payable Salary Upto',
            'tax_pecentage_value' => 'Tax Pecentage Value',
        ];
    }
    public static function payableSalaryDetails($payable_salary) {
        $payable_salary = round($payable_salary);
        $tax = Yii::$app->db->createCommand("SELECT tax_pecentage_value FROM payable_salary_tax_charge WHERE payable_salary_upto <= $payable_salary ORDER BY abs(payable_salary_upto - $payable_salary) limit 1")->queryOne(); 
        return $tax['tax_pecentage_value'];
    }
}
