<?php

namespace app\controllers;

use app\models\Country;
use app\models\States;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class StatesController extends Controller{
      /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex(){
        $model = new States();
        return $this->render('index',['model'=>$model]);
    }

    public function actionLists($id){
        $states = new States();

        $states = $states::find()
        ->where(['country_id'=> $id])
        ->orderBy('id DESC')
        ->all();

        if(!empty($states)){
            foreach($states as $state){
                echo "<option value='".$state->id."'>".$state->name."</option>";
            }
        }
        else{
            echo "<option>----</option>";
        }
    }
}