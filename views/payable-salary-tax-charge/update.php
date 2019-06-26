<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PayableSalaryTaxCharge */

$this->title = 'Update Payable Salary Tax Charge: ' . $model->payable_tax_charge_id;
$this->params['breadcrumbs'][] = ['label' => 'Payable Salary Tax Charges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->payable_tax_charge_id, 'url' => ['view', 'id' => $model->payable_tax_charge_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="payable-salary-tax-charge-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
