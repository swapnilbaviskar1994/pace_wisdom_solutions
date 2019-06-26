<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_type_id')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\UserType::find()->all(), 'user_type_id', 'user_type_name'),
        ['prompt'=>'Select']
        );
    ?>
    <?= $form->field($model, 'department_id')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Department::find()->all(), 'department_id', 'department_name'),
        ['prompt'=>'Select']
        );
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
