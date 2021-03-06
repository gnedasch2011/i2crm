<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<?= $form->field($searchModel, 'name')->checkboxList(\app\models\Department::getForSelectDepartment()) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Поиск по отделу', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>

<?php if ($dataProvider): ?>
    <?php foreach ($dataProvider as $department): ?>
        Отдел: <?= $department->name; ?>
        <ul>
            <?php foreach ($department->userDepartment as $user): ?>
                <li><?= $user->name; ?>    </li>
            <?php endforeach; ?>
        </ul>

    <?php endforeach; ?>
<?php else: ?>

<?php endif; ?>