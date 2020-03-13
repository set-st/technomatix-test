<?php


class PlusMinusController extends Controller
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
                'roles' => ['admin', 'manager', 'staff'],
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

        $dataProvider = new CActiveDataProvider('PlusMinus');

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id = null)
    {

        if (!$model = PlusMinus::model()->findByPk($id)) {
            $model = new PlusMinus();
            $model->dateTime = date('Y-m-d H:i:s');
        }

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'update-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['PlusMinus'])) {
            $model->attributes = $_POST['PlusMinus'];
            if ($model->save()) {
                Yii::app()->user->setFlash('plusMinus', 'Update successful');
                $this->redirect(['plusMinus/index']);
            }
        }

        $goods = Goods::model()->findAll();
        $goods = array_column($goods, 'name', 'id');

        return $this->render('update', [
            'model' => $model,
            'goods' => $goods,
        ]);
    }

    public function actionDelete($id)
    {
        if ($model = PlusMinus::model()->findByPk($id)) {
            $model->delete();
        }
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}