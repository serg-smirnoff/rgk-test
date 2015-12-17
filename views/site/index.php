<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Книги</h1>

        <p class="lead">Тестовое приложение реализующее CRUD с фильтрацией для авторизированных пользователей.</p>

        <p>
            <a class="btn btn-lg btn-success" href="<?= Url::to(['site/login']); ?>">Войдите</a>
            <a class="btn btn-lg btn-success" href="<?= Url::to(['site/signup']); ?>">Зарегистрируйтесь</a>
        </p>
        
    </div>
    
</div>
