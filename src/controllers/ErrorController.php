<?php

namespace bedezign\yii2\audit\controllers;

use bedezign\yii2\audit\components\web\Controller;
use bedezign\yii2\audit\models\AuditError;
use bedezign\yii2\audit\models\AuditErrorSearch;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * ErrorController
 * @package bedezign\yii2\audit\controllers
 */
class ErrorController extends Controller
{
    public function behaviors()
{
    return [
        'access' => [
            'class' => \yii\filters\AccessControl::className(),
            'only' => ['*'],
            'rules' => [                
                // allow authenticated users
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
                // everything else is denied
            ],
        ],
    ];
}
    /**
     * Lists all AuditError models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuditErrorSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $this->layout='/main.php';
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }

    /**
     * Displays a single AuditError model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = AuditError::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('The requested error does not exist.');
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
