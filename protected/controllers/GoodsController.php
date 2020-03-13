<?php


class GoodsController extends Controller
{

    public function accessRules()
    {
        return [
            ['deny',
                'actions' => ['index', 'update', 'delete'],
                'users' => ['?'],
            ],
            ['allow',
                'actions' => ['index'],
                'roles' => ['staff'],
            ],
            ['allow',
                'actions' => ['index', 'update'],
                'roles' => ['admin', 'manager'],
            ],
            ['allow',
                'actions' => ['delete'],
                'roles' => ['admin'],
            ],
            ['deny',
                'actions' => ['index', 'update', 'delete'],
                'users' => ['*'],
            ],
        ];
    }

    public function filters()
    {
        return [
            'accessControl',
        ];
    }

    public function actionIndex()
    {

        $dataProvider = new CActiveDataProvider('Goods');

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id = null)
    {

        if (!$model = Goods::model()->findByPk($id)) {
            $model = new Goods();
        }

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'update-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['Goods'])) {
            $model->attributes = $_POST['Goods'];
            if ($model->save()) {
                Yii::app()->user->setFlash('goods', 'Update successful');
                $this->redirect(['goods/index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        if ($model = Goods::model()->findByPk($id)) {
            $model->delete();
        }
        $this->redirect($_SERVER['HTTP_REFERER']);
    }

}