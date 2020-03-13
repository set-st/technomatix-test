<?php
$this->pageTitle = Yii::app()->name . ' - Update Goods';
$this->breadcrumbs = [
    'Update Goods',
];

/* @var $model Goods */
?>

<h1>Update Goods</h1>

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
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->getIsNewRecord() ? 'Save' : 'Update'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>