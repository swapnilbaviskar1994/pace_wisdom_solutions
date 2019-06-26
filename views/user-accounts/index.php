<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserAccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-accounts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Accounts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

             ['attribute'=>'First Name',
               'value'=> 'user.first_name',
             ],
            'payable_salary',
            'basic_salary',
            'tax_value',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
