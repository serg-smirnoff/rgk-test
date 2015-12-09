<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Books;
use frontend\models\Author;

class AuthorsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
}
