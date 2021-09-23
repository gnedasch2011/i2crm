<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'userDepartmetns')->checkboxList(
        $model->forSelectDepartment
        , [
            'item' => function ($index, $label, $name, $checked, $value) {

                $checkedVal = \app\models\User::checkedDepartment($_GET['id'], $value);
                $checked = ($checkedVal) ? 'checked' : '';

                return "<label class='checkbox col-md-4' style='font-weight: normal;'><input type='checkbox' {$checked} name='{$name}' value='{$value}'>{$label}</label>";
            }
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
