<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;
//use yii\db\Command;
use frontend\models\Authors;

/* @var $this yii\web\View */
/* @var $model frontend\models\Books */
/* @var $searchModel frontend\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;

$script = <<< JS
jQuery.noConflict();
jQuery('a.fancybox').fancybox();
JS;

$this->registerJs($script, yii\web\View::POS_READY);
//$this->registerJsFile("js/script.js", ['position' => yii\web\View::POS_READY]);

?>
<div class="books-index">
    <?php if (Yii::$app->user->isGuest) {?>

    <div>Просмотр и редактирование списка позиций доступно только пользователям. Пройдите авторизацию</div>
    
    <?php 
        
        list($controller) = Yii::$app->createController('site');
        echo $controller->actionLogin();
        
    ?>
    
    <?php } else { ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<!--
        //$image = (new Query)->select('id','preview')->from('books'); die();
        //var_dump($image);die(); 
-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'date_create:date',
            'date_update:date',
            'preview' => [
                'attribute' => 'preview',
                'label'     => 'Превью',
                'format'    => 'raw',
                'value'     => function($model){
                                return '<a href="http://test.onlysites.ru/yii-advanced/frontend'.$model->preview.'" class="fancybox"><img src="http://test.onlysites.ru/yii-advanced/frontend'.$model->preview.'" width="150" /></a>';
                            }  
            ],
            'date:date',
            'author_id' => [
                'attribute' => 'author_id',
                //'format'    => 'text',
                'value'     => function($model){
                                    $author = Authors::find()->where(['id' => $model->author_id])->one();
                                    $author = $author->lastname." ".$author->firstname;
                                    return $author;
                                }  
            ],
              ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php }?>
</div>
