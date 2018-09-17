<?php

namespace app\modules\parameter\controllers;

use Yii;
use app\models\RefBobotSubUnsur;
use app\models\RefSubUnsur;
use app\modules\parameter\models\RefSubUnsurSearch;
use app\modules\parameter\models\RefBobotSubUnsurSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * BobotController implements the CRUD actions for RefBobotSubUnsur model.
 */
class BobotController extends Controller
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
            \app\models\User::KD_USER_ADMINISTRATOR
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
     * Lists all RefBobotSubUnsur models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new RefSubUnsurSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "RefBobotSubUnsur #".$id,
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
        if(!$model) $model = new RefBobotSubUnsur();
        $model->sub_unsur_id = $id;

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update RefBobotSubUnsur #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return $this->redirect(Yii::$app->request->referrer);
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "RefBobotSubUnsur #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ])
                ];    
            }else{
                 return [
                    'title'=> "Update RefBobotSubUnsur #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }


    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }


    protected function findModel($id)
    {
        $model = RefBobotSubUnsur::findOne(['sub_unsur_id' => $id]);
        // if (($model = RefBobotSubUnsur::findOne(['sub_unsur_id' => $id])) !== null) {
            return $model;
        // } else {
        //     throw new NotFoundHttpException('The requested page does not exist.');
        // }
    }

    protected function findSubUnsur()
    {
        return RefSubUnsur::find()->all();
    }
}
