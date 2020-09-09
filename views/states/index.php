<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'states';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="states">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form =  ActiveForm::begin()?>
    <div class="row">
    <div class="col-md-12">      
        <?php $countryData = ArrayHelper::map(\app\models\Country::find()->asArray()->all(),'id','country_name'); ?>
        <?= $form->field($model,'country_id')->dropDownList($countryData,[
             'prompt' =>'--Select a country--',
             'onchange'=>'
             $.get("'.Url::toRoute('states/lists').'", { id: $(this).val() })
             .done(function( data ) {
                 $( "#'.Html::getInputId($model,'name').'").html(data);
             });
             ' ]);
          ?>
    </div>

    <div class="col-md-12">          
          <?= $form->field($model,'name')->dropDownList(['Prompt'=>'--Select--']);
          ?>
    </div>
    </div>
    <?php $form =  ActiveForm::end()?>

</div>
