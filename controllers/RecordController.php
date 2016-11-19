<?php

namespace app\controllers;

use Yii;
use app\models\Gardu;
use app\models\RecordPhasa;
use app\models\Log;
use app\models\Phasa;
use app\models\StatusUnbalance;
use app\models\Pelanggan;
use kartik\mpdf\Pdf;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RecordController implements the CRUD actions for RecordPhasa model.
 */
class RecordController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','create','update','delete','print'],
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete','print'],
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
        $dataProvider = new ActiveDataProvider([
            'query' => Gardu::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RecordPhasa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id='')
    {
        $param = Yii::$app->request->get();
        if(!isset($param['kode'])) {
            $param['kode']=1;
        }
        if($param['kode']==1) {
            $phasa_r = new SqlDataProvider([
                    'sql' => 'SELECT * FROM record_phasa WHERE phasa = (SELECT phasa.id_phasa FROM phasa JOIN phasa_type ON phasa.phasa_type=phasa_type.id_phasa_type WHERE phasa.gardu=:id AND phasa_type.nama=:type) AND DATE(record_phasa.date)=CURDATE() ORDER BY record_phasa.date ASC',
                    'params' => [':id' => $id, 'type' => 'R'],
            ]);

            $phasa_s = new SqlDataProvider([
                    'sql' => 'SELECT * FROM record_phasa WHERE phasa = (SELECT phasa.id_phasa FROM phasa JOIN phasa_type ON phasa.phasa_type=phasa_type.id_phasa_type WHERE phasa.gardu=:id AND phasa_type.nama=:type) AND DATE(record_phasa.date)=CURDATE() ORDER BY record_phasa.date ASC',
                    'params' => [':id' => $id, 'type' => 'S'],
            ]);

            $phasa_t = new SqlDataProvider([
                    'sql' => 'SELECT * FROM record_phasa WHERE phasa = (SELECT phasa.id_phasa FROM phasa JOIN phasa_type ON phasa.phasa_type=phasa_type.id_phasa_type WHERE phasa.gardu=:id AND phasa_type.nama=:type) AND DATE(record_phasa.date)=CURDATE() ORDER BY record_phasa.date ASC',
                    'params' => [':id' => $id, 'type' => 'T'],
            ]);

            $phasa = new SqlDataProvider([
                    'sql' => 'SELECT distinct(record_phasa.date) FROM record_phasa WHERE phasa IN (SELECT phasa.id_phasa FROM phasa JOIN phasa_type ON phasa.phasa_type=phasa_type.id_phasa_type WHERE phasa.gardu=:id) AND DATE(record_phasa.date)=CURDATE() ORDER BY record_phasa.date ASC',
                    'params' => [':id' => $id],
            ]);

            $id_records = new SqlDataProvider([
                    'sql' => 'SELECT id_record_phasa FROM record_phasa WHERE phasa IN (SELECT phasa.id_phasa FROM phasa JOIN phasa_type ON phasa.phasa_type=phasa_type.id_phasa_type WHERE phasa.gardu=:id) AND DATE(record_phasa.date)=CURDATE() ORDER BY record_phasa.date ASC',
                    'params' => [':id' => $id],
            ]);
        } else if($param['kode']==2) {
            $phasa_r = new SqlDataProvider([
                    'sql' => 'SELECT * FROM record_phasa WHERE phasa = (SELECT phasa.id_phasa FROM phasa JOIN phasa_type ON phasa.phasa_type=phasa_type.id_phasa_type WHERE phasa.gardu=:id AND phasa_type.nama=:type) AND EXTRACT(MONTH FROM record_phasa.date)=EXTRACT(MONTH FROM NOW()) ORDER BY record_phasa.date ASC',
                    'params' => [':id' => $id, 'type' => 'R'],
            ]);

            $phasa_s = new SqlDataProvider([
                    'sql' => 'SELECT * FROM record_phasa WHERE phasa = (SELECT phasa.id_phasa FROM phasa JOIN phasa_type ON phasa.phasa_type=phasa_type.id_phasa_type WHERE phasa.gardu=:id AND phasa_type.nama=:type) AND EXTRACT(MONTH FROM record_phasa.date)=EXTRACT(MONTH FROM NOW()) ORDER BY record_phasa.date ASC',
                    'params' => [':id' => $id, 'type' => 'S'],
            ]);

            $phasa_t = new SqlDataProvider([
                    'sql' => 'SELECT * FROM record_phasa WHERE phasa = (SELECT phasa.id_phasa FROM phasa JOIN phasa_type ON phasa.phasa_type=phasa_type.id_phasa_type WHERE phasa.gardu=:id AND phasa_type.nama=:type) AND EXTRACT(MONTH FROM record_phasa.date)=EXTRACT(MONTH FROM NOW()) ORDER BY record_phasa.date ASC',
                    'params' => [':id' => $id, 'type' => 'T'],
            ]);

            $phasa = new SqlDataProvider([
                    'sql' => 'SELECT distinct(record_phasa.date) FROM record_phasa WHERE phasa IN (SELECT phasa.id_phasa FROM phasa JOIN phasa_type ON phasa.phasa_type=phasa_type.id_phasa_type WHERE phasa.gardu=:id) AND EXTRACT(MONTH FROM record_phasa.date)=EXTRACT(MONTH FROM NOW()) ORDER BY record_phasa.date ASC',
                    'params' => [':id' => $id],
            ]);

            $id_records = new SqlDataProvider([
                    'sql' => 'SELECT id_record_phasa FROM record_phasa WHERE phasa IN (SELECT phasa.id_phasa FROM phasa JOIN phasa_type ON phasa.phasa_type=phasa_type.id_phasa_type WHERE phasa.gardu=:id) AND EXTRACT(MONTH FROM record_phasa.date)=EXTRACT(MONTH FROM NOW()) ORDER BY record_phasa.date ASC',
                    'params' => [':id' => $id],
            ]);
        }

        $phasa_r = $phasa_r->getModels();
        $phasa_s = $phasa_s->getModels();
        $phasa_t = $phasa_t->getModels();
        $phasa = $phasa->getModels();
        $id_records = $id_records->getModels();

        $r = array();
        $s = array();
        $t = array();
        $date = array();
        $id_record = array();

        foreach ($phasa_r as $key => $value) {
            array_push($r,intval($value['p']));
        }

        foreach ($phasa_s as $key => $value) {
            array_push($s, intval($value['p']));
        }

        foreach ($phasa_t as $key => $value) {
            array_push($t, intval($value['p']));
        }

        foreach ($phasa as $key => $value) {
            array_push($date, $value['date']);
        }

        foreach ($id_records as $key => $value) {
            array_push($id_record, $value['id_record_phasa']);
        }

        $id_min = reset($id_record);
        $id_max = end($id_record);

        return $this->render('view', [
            'gardu' => $id,
            'r' => $r,
            's' => $s,
            't' => $t,
            'date' => $date,
            'id_min' => $id_min,
            'id_max' => $id_max,
        ]);
    }

    public function actionReport()
    {
        // $this->layout = 'blank';
        $data = Yii::$app->request->get();
        $data['date_min'] = RecordPhasa::find()->where(['id_record_phasa'=>$data['id_min']])->one()->getAttribute('date');
        $data['date_min'] = new \DateTime($data['date_min']);
        $data['date_min'] = $data['date_min']->format('d/m/Y');
        $data['date_max'] = RecordPhasa::find()->where(['id_record_phasa'=>$data['id_max']])->one()->getAttribute('date');
        $data['date_max'] = new \DateTime($data['date_max']);
        $data['date_max'] = $data['date_max']->format('d/m/Y');

        $data['gardu_v'] = Phasa::find()->Where(['gardu'=>$data['id_gardu']])->sum('v');
        $data['gardu_i'] = Phasa::find()->Where(['gardu'=>$data['id_gardu']])->sum('i');
        $data['gardu_p'] = Phasa::find()->Where(['gardu'=>$data['id_gardu']])->sum('p');
        $data['status_unbalance'] = Gardu::find()->Where(['id_gardu'=>$data['id_gardu']])->one()->getAttribute('status_unbalance');

        $data['phasa_r'] = Phasa::find()->Where(['gardu'=>$data['id_gardu']])->andWhere(['phasa_type'=>1])->one();
        $data['phasa_s'] = Phasa::find()->Where(['gardu'=>$data['id_gardu']])->andWhere(['phasa_type'=>2])->one();
        $data['phasa_t'] = Phasa::find()->Where(['gardu'=>$data['id_gardu']])->andWhere(['phasa_type'=>3])->one();

        $data['r_locking'] = Pelanggan::find()->Where(['phasa'=>$data['phasa_r']['id_phasa']])->andWhere(['status'=>0])->count();
        $data['s_locking'] = Pelanggan::find()->Where(['phasa'=>$data['phasa_s']['id_phasa']])->andWhere(['status'=>0])->count();
        $data['t_locking'] = Pelanggan::find()->Where(['phasa'=>$data['phasa_t']['id_phasa']])->andWhere(['status'=>0])->count();

        $data['status_locking'] = 0;
        if($data['r_locking'] > 0) $data['status_locking']++;
        if($data['s_locking'] > 0) $data['status_locking']++;
        if($data['t_locking'] > 0) $data['status_locking']++;

        $pdf = new Pdf([
            // your html content input
            'content' => $this->renderPartial('report', array('data' => $data)),  
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
            // set mPDF properties on the fly
            'options' => ['title' => 'Laporan Gardu '.$data['id_gardu']],
            // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Laporan Gardu '.$data['id_gardu']], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        return $pdf->render(); 
    }

    /**
     * Creates a new RecordPhasa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RecordPhasa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_record_phasa]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RecordPhasa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_record_phasa]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RecordPhasa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RecordPhasa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RecordPhasa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RecordPhasa::findOne($id)) !== null) {
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
