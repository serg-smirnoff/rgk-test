<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;
//use yii\db\Command;
use frontend\models\Authors;

use yii\widgets\ActiveField;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
        
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

    <div>Просмотр и редактирование списка книг доступно только зарегистрированным пользователям. Пройдите авторизацию или <a href="/site/signup">зарегистрируйтесь</a></div>
    
    <?php 
        list($controller) = Yii::$app->createController('site');
        echo $controller->actionLogin($partial = true);
    ?>
    
    <?php } else { ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<!--
        //$image = (new Query)->select('id','preview')->from('books');
-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'filter'    => false
            ],
            [
                'attribute' => 'name',
                'filter'    => false
            ],
            [
                'attribute' => 'date_create',
                'value'     => 'date_create',
                'format'    => 'raw',
                'filter'    => DatePicker::widget(
                                [
                                    'model'      => $searchModel,
                                    'attribute'  => 'date_create',
                                    'dateFormat' => 'yyyy-MM-dd',
                                ]
                )
            ],
            [
                'attribute' => 'date_update',
                'value'     => 'date_update',
                'format'    => 'raw',
                'filter'    => DatePicker::widget(
                                [
                                    'model'      => $searchModel,
                                    'attribute'  => 'date_update',
                                    'dateFormat' => 'yyyy-MM-dd',
                                ]
                )
            ],
            'preview' => [
                'attribute' => 'preview',
                'label'     => 'Превью',
                'format'    => 'raw',
                'value'     => function($model){
                                return '<a href="http://test.onlysites.ru/yii-advanced/frontend'.$model->preview.'" class="fancybox"><img src="http://test.onlysites.ru/yii-advanced/frontend'.$model->preview.'" width="150" /></a>';
                            },
                'filter'    => false
            ],
            [
                'attribute' => 'date',
                'value'     => 'date',
                'format'    => 'raw',
                'filter'    => DatePicker::widget(
                                [
                                    'model'      => $searchModel,
                                    'attribute'  => 'date',
                                    'dateFormat' => 'yyyy-MM-dd',
                                ]
                )
            ],
            [
                'format'    => 'raw',
                'attribute' => 'author_id',
                'value'     => function($model){
                                    $author = Authors::find()->where(['id' => $model->author_id])->one();
                                    $author = $author->lastname." ".$author->firstname;
                                    return $author;
                                },
                'filter' => Html::activeDropDownList($searchModel, 'author_id', ArrayHelper::map(Authors::find()->asArray()->all(), 'id','firstname'),['class'=>'form-control','prompt' => ' Выберите автора ']),
            ],                    
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php }?>
</div>
