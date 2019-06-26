<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserAccounts */

$this->title = $model->user->first_name." ".$model->user->last_name;
$this->params['breadcrumbs'][] = ['label' => 'User Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-accounts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'user_id',
             ['attribute'=>'First Name',
               'value'=> $model->user->first_name,
             ],
             ['attribute'=>'Last Name',
               'value'=> $model->user->last_name,
             ],
            'payable_salary',
            'basic_salary',
            'tax_value',
            ['attribute'=>'Last Month Deduction',
               'value'=> $model->user->department->last_month_deduction,
            ],
            ['attribute'=>'Employee Type Name',
               'value'=> $model->user->userType->user_type_name,
            ],
            ['attribute'=>'Department Name',
               'value'=> $model->user->department->department_name,
            ],
        ],
    ]) ?>

</div>
