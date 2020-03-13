<?php

if (Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('manager')) {
    echo CHtml::link('Create new', $this->createUrl('goods/update'));
}

$this->widget('zii.widgets.grid.CGridView', [
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
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