<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;
//use yii\db\Command;

/* @var $this yii\web\View */
/* @var $model frontend\models\Books */
/* @var $searchModel frontend\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="books-index">

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
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'date_create:date',
            'date_update:date',
            'preview',
            //'preview' => function ($image) {return Html::img($image,['width' => '60px']);},
            'date:date',
            'author_id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
