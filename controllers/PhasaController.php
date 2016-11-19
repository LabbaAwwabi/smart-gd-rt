<?php

namespace app\controllers;

use Yii;
use app\models\Phasa;
use app\models\Pelanggan;
use app\models\Log;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PhasaController implements the CRUD actions for Phasa model.
 */
class PhasaController extends Controller
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
     * Lists all Phasa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->createLog('Melihat data Phasa');
        $dataProvider = new ActiveDataProvider([
            'query' => Phasa::find(),
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
    public function actionList($id_gardu)
    {
        $this->createLog('Melihat data Phasa yang berada pada Gardu '.$id_gardu);
        $gardu = $id_gardu;
        $dataProvider = new ActiveDataProvider([
            'query' => Phasa::find()->where(['gardu' => $gardu]),
        ]);

        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Phasa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->createLog('Melihat data Phasa '.$id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Phasa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Phasa();

        if ($model->load(Yii::$app->request->post())) {
            $model['i'] = 0;
            $model['p'] = $model['v'] * $model['i'];
            $model['loses'] = 0;
            $model['status_voltage'] = $this->setStatusVolatage($model['v']);
            $model->save();
            $this->createLog('Membuat data Phasa '.$model['id_phasa']);
            return $this->redirect(['view', 'id' => $model->id_phasa]);
        } else {
            $this->createLog('Akan membuat data Phasa');
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Phasa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model['p'] = $model['v'] * $model['i'];
            $model['loses'] = $this->setLoses($model['id_phasa'],$model['p']);
            $model['status_voltage'] = $this->setStatusVolatage($model['v']);
            $model->save();
            $this->createLog('Mengupdate data Phasa '.$model['id_phasa']);
            return $this->redirect(['view', 'id' => $model->id_phasa]);
        } else {
            $this->createLog('Akan mengupdate data Phasa '.$model['id_phasa']);
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Phasa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->createLog('Menghapus data Phasa '.$model['id_phasa']);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Phasa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Phasa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Phasa::findOne($id)) !== null) {
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

    public function setStatusVolatage($v)
    {
        $standart_voltage = 220;
        if($v < ($standart_voltage - (0.1 * $standart_voltage))) {
            return 2; //2 == undervoltage -> cari di table status_voltage
        } else if($v > ($standart_voltage + (0.05 * $standart_voltage))) {
            return 3; //3 == overvoltage -> cari di table status_voltage
        } else {
            return 1; //normal
        }
    }

    public function setLoses($id,$p_phasa)
    {
        $p_pelanggan = Pelanggan::find()->where(['phasa'=>$id])->sum('p');
        if($p_phasa-$p_pelanggan<0) return 0;
        return $p_phasa - $p_pelanggan;
    }
}
