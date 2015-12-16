<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Authors;
use frontend\models\Books;
use frontend\models\BooksSearch;

use frontend\controlers\SiteController;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]                
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BooksSearch();
        
        $model = new Books();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //$author = Authors::find()->where(['id' => $model->id])->one();
        //echo $author = $author->lastname." ".$author->firstname;die();
                
        // id автора
        //$book = Books::find()->where(['id' => $id])->one();
        //$author_id = $book->author_id;
        
        // ФИО автора по id 
        //$author = Authors::find()->where(['id' => $author_id])->one();
        //$author = $author->lastname." ".$author->firstname;

        return $this->render('index', [
        //    'id'          => $id,
        //    'author'        => $author,
            'model'         => $model,
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
        ]);
    }

    /**
     * Displays a single Books model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        // id автора
        $book = Books::find()->where(['id' => $id])->one();
        $author_id = $book->author_id;
        
        // ФИО автора по id 
        $author = Authors::find()->where(['id' => $author_id])->one();
        $author = $author->lastname." ".$author->firstname;
                        
        return $this->render('view', [
            'author'    => $author,
            'model'     => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Books();
        
        $model->date_create = date("Y-m-d");
        $model->date_update = date("Y-m-d");
        
        if ($model->load(Yii::$app->request->post())) {
            
            $model->file = UploadedFile::getInstance($model, 'file');
            
            if ($model->file && $model->validate()) {
                $model->file->saveAs( Yii::$app->basePath . '/web/uploads/' . $model->file->baseName . '.' . $model->file->extension );
            }
            
            $model->preview = '/web/uploads/' . $model->file->baseName . '.' . $model->file->extension;
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $model->date_update = date("Y-m-d");
        
        if ($model->load(Yii::$app->request->post())) {
           
            $model->file = UploadedFile::getInstance($model, 'file');
            
            if ($model->file && $model->validate()) {
                $model->file->saveAs( Yii::$app->basePath . '/web/uploads/' . $model->file->baseName . '.' . $model->file->extension );
            }
            
            if($model->file->baseName != '') $model->preview = '/web/uploads/' . $model->file->baseName . '.' . $model->file->extension;
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
