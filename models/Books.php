<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property string $preview
 * @property string $date
 * @property integer $author_id
 */
class Books extends \yii\db\ActiveRecord
{
    public $file;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'date', 'author_id'], 'required'],
            [['id', 'author_id'], 'integer'],
            [['date', 'date_create', 'date_update'], 'safe'],
            [['file'], 'file'],
            [['name', 'preview'], 'string', 'max' => 255],
            [['date_create', 'date_update', 'date'], 'default', 'value' => null]            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'preview' => 'Превью',
            'author_id' => 'Автор',
            'date_create' => 'Дата создания записи',
            'date_update' => 'Дата обновления записи',
            'date' => 'Дата выхода книги'
        ];
    }
}
