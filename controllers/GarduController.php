<?php

namespace app\controllers;

use Yii;
use app\models\Gardu;
use app\models\Log;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GarduController implements the CRUD actions for Gardu model.
 */
class GarduController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','create','update','delete'],
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Gardu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->createLog('Melihat data Gardu');
        $dataProvider = new ActiveDataProvider([
            'query' => Gardu::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);        

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gardu model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->createLog('Melihat data Gardu '.$id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Gardu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gardu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->createLog('Membuat data Gardu '.$model['id_gardu']);
            return $this->redirect(['view', 'id' => $model->id_gardu]);
        } else {
            $this->createLog('Akan membuat data Gardu baru');
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Gardu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->createLog('Mengupdate data Gardu '.$id);
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_gardu]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Gardu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->createLog('Melihat data Gardu '.$id);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gardu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Gardu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gardu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function createLog($activity)
    {
        $session = Yii::$app->session;
        $log = new Log();
        $log['user'] = $session['session.user']['id_user'];
        $log['activity'] = $activity;
        $log->save();
    }
}
