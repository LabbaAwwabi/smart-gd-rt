<?php

namespace app\controllers;

use Yii;
use app\models\Pelanggan;
use app\models\Log;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PelangganController implements the CRUD actions for Pelanggan model.
 */
class PelangganController extends Controller
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
     * Lists all Pelanggan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->createLog('Melihat data Pelanggan');
        $dataProvider = new ActiveDataProvider([
            'query' => Pelanggan::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Phasa models.
     * @return mixed
     */
    public function actionList($id_phasa)
    {
        $this->createLog('Melihat data Pelanggan dengan id phasa '.$id_phasa);
        $phasa = $id_phasa;
        $dataProvider = new ActiveDataProvider([
            'query' => Pelanggan::find()->where(['phasa' => $phasa]),
        ]);

        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pelanggan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $this->createLog('Melihat data Pelanggan '.$model['kode_registrasi']);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Pelanggan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pelanggan();

        if ($model->load(Yii::$app->request->post())) {
            $model['kode_registrasi'] = 'SMTGD-'.date('Y-m-d').'-'.$model['kode_registrasi'];
            $model->save();
            $this->createLog('Membuat data Pelanggan '.$model['kode_registrasi']);
            return $this->redirect(['view', 'id' => $model->id_pelanggan]);
        } else {
            $this->createLog('Akan membuat data Pelanggan');
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pelanggan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->createLog('Mengupdate data Pelanggan '.$model['kode_registrasi']);
            return $this->redirect(['view', 'id' => $model->id_pelanggan]);
        } else {
            $this->createLog('Akan mengupdate data Pelanggan '.$model['kode_registrasi']);
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionLock($id)
    {
        $model = $this->findModel($id);
        $this->createLog('Mengelock data Pelanggan '.$model['kode_registrasi']);

        $model->status = 0;
        $model->save();

        return $this->render('view', [
                'model' => $model,
            ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionUnlock($id)
    {
        $model = $this->findModel($id);
        $this->createLog('Mengunlock data Pelanggan '.$model['kode_registrasi']);

        $model->status = 1;
        $model->save();

        return $this->render('view', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing Pelanggan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->createLog('Menghapus data Pelanggan '.$model['kode_registrasi']);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pelanggan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pelanggan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pelanggan::findOne($id)) !== null) {
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
