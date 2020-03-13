<?php

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('manager') || Yii::app()->user->checkAccess('staff')) {
    echo CHtml::link('Create new', $this->createUrl('plusMinus/update'));
}

$this->widget('zii.widgets.grid.CGridView', [
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'good.name',
        [
            'name' => 'operationId',
            'value' => '$data->getOperation()',
        ],
        'value',
        'dateTime',
        [
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => [
                'update' => [
                    'visible' => '$data->checkAccessEdit()',
                ],
                'delete' => [
                    'visible' => '$data->checkAccessDelete()',
                ],
            ],
        ],
    ],
]);