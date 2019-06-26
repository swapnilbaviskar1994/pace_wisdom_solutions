<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_type_id',
            'user_type_name',
            'basic_salary',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
