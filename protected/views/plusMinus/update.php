<?php
$this->pageTitle = Yii::app()->name . ' - Update Приход/Расход';
$this->breadcrumbs = [
    'Приход/Расход',
];

/* @var $model PlusMinus */
?>

<h1>Приход/Расход</h1>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', [
        'id' => 'update-form',
        'enableClientValidation' => true,
        'clientOptions' => [
            'validateOnSubmit' => true,
        ],
    ]);
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <div class="row">
        <?php echo $form->labelEx($model, 'goodId'); ?>
        <?php echo $form->dropDownList($model, 'goodId', $goods); ?>
        <?php echo $form->error($model, 'goodId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'operationId'); ?>
        <?php echo $form->dropDownList($model, 'operationId', [
            PlusMinus::OPERATION_PLUS => 'Plus',
            PlusMinus::OPERATION_MINUS => 'Minus',
        ]); ?>
        <?php echo $form->error($model, 'operationId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'value'); ?>
        <?php echo $form->textField($model, 'value'); ?>
        <?php echo $form->error($model, 'value'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'dateTime'); ?>
        <?php echo $form->textField($model, 'dateTime'); ?>
        <?php echo $form->error($model, 'dateTime'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->getIsNewRecord() ? 'Save' : 'Update'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>