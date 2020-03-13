<?php


class LogController extends Controller
{
    public function accessRules()
    {
        return [
            ['deny',
                'actions' => ['index'],
                'users' => ['?'],
            ],
            ['allow',
                'actions' => ['index'],
                'roles' => ['admin', 'manager'],
            ],
            ['deny',
                'actions' => ['index'],
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

        $model = new Log('search');

        if (isset($_GET['Log'])) {
            $model->attributes = $_GET['Log'];
        }

        $users = User::model()->findAll();
        $goods = Goods::model()->findAll();

        return $this->render('index', [
            'model' => $model,
            'users' => $users,
            'goods' => $goods,
        ]);
    }

}