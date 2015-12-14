<?php

use yii\helpers\Html;
use yii\helpers\BaseHtml;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
#use yii\widgets\FileInput;
use yii\file\FileInput;
use yii\jui\DatePicker;

use frontend\models\Authors

/* @var $this yii\web\View */
/* @var $model frontend\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_id')->textInput() ?>
    
    <!--
    $form->field($model, 'author_id')->dropDownList(
    ArrayHelper::map(Authors::find()->all(),'id','firstname'),['prompt'=>'[ Выберите имя автора ]']
    -->

    <?= $form->field($model, 'file')->fileInput() ?>
    <?= $form->field($model, 'date')->widget( DatePicker::className(),['dateFormat' => 'yyyy-MM-dd'] ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



