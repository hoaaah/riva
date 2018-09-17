<?php

namespace app\modules\tindak\controllers;

use Yii;
use app\models\RefSubUnsur;
use app\models\TaRencanaTindak;
use app\modules\tindak\models\RefSubUnsurSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * RencanaController implements the CRUD actions for RefSubUnsur model.
 */
class RencanaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        // your custom code here, if you want the code to run before action filters,
        // which are triggered on the [[EVENT_BEFORE_ACTION]] event, e.g. PageCache or AccessControl

        $kdUser = [
            \app\models\User::KD_USER_ADMINISTRATOR,
            \app\models\User::KD_USER_BPKP
        ];

        if(!(\yii\helpers\ArrayHelper::isIn(Yii::$app->user->identity->kd_user, $kdUser))) {
            Yii::$app->getSession()->addFlash('warning', 'Anda tidak memiliki hak akses!');
            $this->redirect(['/site']);
            return false;
        }

        if (!parent::beforeAction($action)) {
            return false;
        }

        // other custom code here

        return true; // or false to not run the action
    }  

    /**
     * Lists all RefSubUnsur models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefSubUnsurSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 0;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RefSubUnsur model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefSubUnsur #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        
        $rencanaTindak = $this->findRencanaTindak($id);
        if(!$rencanaTindak) $rencanaTindak = new TaRencanaTindak;
        $rencanaTindak->tahun = 2018;
        $rencanaTindak->sub_unsur_id = $id;

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Rencana Tindak Sub Unsur #$id $model->name",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'rencanaTindak' => $rencanaTindak,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($rencanaTindak->load($request->post())){
                if($rencanaTindak->save()){
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Sub Unsur #$id $model->name",
                        'content'=> $this->renderAjax('view', [
                            'model' => $model,
                            'rencanaTindak' => $rencanaTindak,
                        ]),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];
                }
            }else{
                 return [
                    'title'=> "Rencana Tindak Sub Unsur #$id $model->name",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'rencanaTindak' => $rencanaTindak,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($rencanaTindak->load($request->post())) {
                if($rencanaTindak->save())
                {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'rencanaTindak' => $rencanaTindak,
                ]);
            }
        }
    }

    /**
     * Finds the RefSubUnsur model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefSubUnsur the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefSubUnsur::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findRencanaTindak($id)
    {
        $tahun = \app\models\TaTh::find()->select("max(tahun) as tahun")->one()['tahun'];
        $model = TaRencanaTindak::findOne(['sub_unsur_id' => $id, 'tahun' => $tahun ? $tahun : date('Y')]);
        return $model;
    }


}
