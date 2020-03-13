<?php

$this->widget('zii.widgets.grid.CGridView', [
    'ajaxUpdate' => 'false',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
        'id',
        [
            'name' => 'userId',
            'value' => '$data->user->name',
            'filter' => CHtml::listData($users, 'id', 'name'),
        ],
        [
            'name' => 'operationId',
            'value' => '$data->getOperation()',
            'filter' => [
                PlusMinus::OPERATION_PLUS => 'Plus',
                PlusMinus::OPERATION_MINUS => 'Minus',
                PlusMinus::OPERATION_DELETE => 'Delete',
            ],
        ],
        [
            'name' => 'value',
            'filter' => false,
        ],
        [
            'name' => 'goodId',
            'value' => '$data->good->name',
            'filter' => CHtml::listData($goods, 'id', 'name'),
        ],
        [
            'name' => 'isUpdate',
            'filter' => false,
            'value' => '$data->isUpdate()',
        ],
        [
            'name' => 'dateTime',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', [
                    'model' => $model,
                    'attribute' => 'dateTime_1',
                    'options' => ['firstDay' => 1, 'dateFormat' => 'yy-mm-dd'],
                    'htmlOptions' => ['style' => 'width: 100px;', 'placeHolder' => 'From:', 'id' => 'from_date'],
                ], true) . $this->widget('zii.widgets.jui.CJuiDatePicker', [
                    'model' => $model,
                    'attribute' => 'dateTime_2',
                    'options' => ['firstDay' => 1, 'dateFormat' => 'yy-mm-dd'],
                    'htmlOptions' => ['style' => 'width: 100px;', 'placeHolder' => 'To:', 'id' => 'to_date'],
                ], true),
        ],
    ],
]);